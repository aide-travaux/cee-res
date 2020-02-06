<?php

namespace AideTravaux\CEE\Res\Data;

use AideTravaux\CEE\Categorie\Data\Entries as CategorieEntries;
use AideTravaux\CEE\OS\Data\Entries as BaseEntries;

abstract class Entries extends BaseEntries
{
    /**
     * @property array
     */
    const CODES_REGION = CategorieEntries::CODES_REGION;

    /**
     * @property array
     */
    const CATEGORIES_ANAH = CategorieEntries::CATEGORIES_ANAH;
}
