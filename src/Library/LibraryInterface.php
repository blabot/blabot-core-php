<?php

namespace Blabot\Library;

use Blabot\Dictionary\Dictionary;

interface LibraryInterface
{
    public function getCatalogue(): Catalogue;
    public function getDictionary(string $id): Dictionary;
}