<?php
declare(strict_types=1);

namespace Blabot\Library;

use PHPUnit\Framework\TestCase;

class CatalogueTest extends TestCase
{
    /**
     * @var Catalogue $catalog
     */
    private $catalog;

    protected function setUp()
    {
        parent::setUp();
        $this->catalog = new Catalogue();
    }

    public function testCatalogueClassExists(): void
    {
        $this->assertInstanceOf(Catalogue::class, $this->catalog);
    }

    public function testWhenEmptyReturnsEmptyArray(): void
    {
        $list = $this->catalog->listAll();
        $this->assertIsArray($list);
        $this->assertEmpty($list);
    }

    public function testAcceptNewCatalogueRecord(): void
    {
        $result = $this->catalog->addRecord('ID', "Language", "FileName", "Name", ["fileName" => "FileName"]);
        $this->assertTrue($result);
    }

    public function testGivenOneRecordReturnsCatalogueWithOneRecord(): void
    {
        $this->catalog->addRecord('ID', "Language", "Name", "LocalName", ["fileName" => "FileName"]);
        $actual = $this->catalog->listAll();
        $this->assertIsArray($actual);
        $this->assertNotEmpty($actual);
        $this->assertInstanceOf(CatalogueRecord::class, $actual['ID']);

        /**
         * @var CatalogueRecord $record
         */
        $record = $actual['ID'];
        $this->assertEquals($record->id, "ID");
        $this->assertEquals($record->language, "Language");
        $this->assertEquals($record->name, "Name");
        $this->assertEquals($record->localName, "LocalName");
        $this->assertEquals($record->other, ["fileName" => "FileName"]);
    }

    public function testFindsRecordsByLanguage(): void
    {
        $this->catalog->addRecord('C1', "cs", "Name C1", "LocalName C1");
        $this->catalog->addRecord('E1', "en", "Name E1", "LocalName E1");
        $this->catalog->addRecord('D1', "de", "Name D1", "LocalName D1");
        $this->catalog->addRecord('C2', "cs", "Name C2", "LocalName C2");
        $this->catalog->addRecord('D2', "de", "Name D2", "LocalName D2");
        $this->catalog->addRecord('D3', "de", "Name D3", "LocalName D3");
        $actual = $this->catalog->findByLanguage("cs");
        $this->assertIsArray($actual);
        $this->assertNotEmpty($actual);
        $this->assertEquals(2, count($actual));
        $this->assertEquals("Name C1", $actual['C1']->name);
        $this->assertEquals("Name C2", $actual['C2']->name);

        $actual = $this->catalog->findByLanguage("en");
        $this->assertIsArray($actual);
        $this->assertNotEmpty($actual);
        $this->assertEquals(1, count($actual));
        $this->assertEquals("Name E1", $actual['E1']->name);

        $actual = $this->catalog->findByLanguage("de");
        $this->assertIsArray($actual);
        $this->assertNotEmpty($actual);
        $this->assertEquals(3, count($actual));
    }

    public function testFindsRecordsById(): void
    {
        $this->catalog->addRecord('D1', "de", "Name D1", "LocalName D1");
        $this->catalog->addRecord('C2', "cs", "Name C2", "LocalName C2");
        $this->catalog->addRecord('D3', "de", "Name D3", "LocalName D3");
        $actual = $this->catalog->findById("C2");
        $this->assertInstanceOf(CatalogueRecord::class, $actual);
        $this->assertEquals("Name C2", $actual->name);
    }

    public function testCheckValidId(): void
    {
        $this->catalog->addRecord('D1', "de", "Name D1", "LocalName D1");
        $this->catalog->addRecord('C2', "cs", "Name C2", "LocalName C2");
        $this->assertFalse($this->catalog->isValidId("XYZ"));
        $this->assertTrue($this->catalog->isValidId("C2"));
    }
}
