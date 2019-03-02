<?php
declare(strict_types=1);

namespace Blabot\Library;


class CatalogueRecord
{
    /**
     * @var string $id
     */
    public $id;

    /**
     * @var string $language
     */
    public $language;

    /**
     * @var string $name
     */
    public $name;

    /**
     * @var string $localName
     */
    public $localName;

    /**
     * @var array $other
     */
    public $other = [];

    /**
     * CatalogueRecord constructor.
     *
     * @param string $id
     * @param string $language
     * @param string $name
     * @param string $localName
     * @param array $other
     */
    public function __construct(string $id, string $language, string $name, string $localName, array $other = [])
    {
        $this->language = $language;
        $this->name = $name;
        $this->localName = $localName;
        $this->other = $other;
        $this->id = $id;
    }


}