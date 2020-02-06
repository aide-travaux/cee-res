<?php

namespace AideTravaux\CEE\Res\Model;

use AideTravaux\CEE\Categorie\Model\DataInterface as CategorieInterface;
use AideTravaux\CEE\OS\Model\BARInterface;

interface DataInterface extends BARInterface, CategorieInterface
{
    /**
     * Retourne la catégorie de ressources selon le dispositif certificats d'économies d'énergie
     * @return string
     */
    public function getCategorieCee(): string;

    /**
     * Retourne le code travaux certificats d'économies d'énergie
     * @return string
     */
    public function getCeeCodeTravaux(): string;
}
