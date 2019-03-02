<?php
declare(strict_types=1);

namespace Blabot\Library;

class Catalogue
{
    /**
     * @var array $records
     */
    private $records = [];

    /**
     * @param string $id
     * @param string $language
     * @param string $name
     * @param string $localName
     * @param array $other
     * @return bool
     */
    public function addRecord(string $id, string $language, string $name, string $localName, array $other = []): bool
    {
        $this->records[$id] = new CatalogueRecord($id, $language, $name, $localName, $other);
        return true;
    }

    /**
     * @return array
     */
    public function listAll(): array
    {
        return $this->records;
    }

    /**
     * @param string $language
     * @return array
     */
    public function findByLanguage(string $language): array
    {
        $result = [];
        foreach ($this->records as $id => $record){
            if ($record->language === $language)
                $result[$id] = $record;
        }
        return $result;
    }

    /**
     * @param $id
     * @return CatalogueRecord
     */
    public function findById($id): CatalogueRecord
    {
        return $this->records[$id];
    }

    /**
     * @param $id
     * @return bool
     */
    public function isValidId($id): bool
    {
        return array_key_exists($id, $this->records);
    }
}