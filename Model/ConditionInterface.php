<?php

namespace AideTravaux\CEE\Res\Model;

interface ConditionInterface
{
    /**
     * Retourne le code travaux certificats d'économies d'énergie
     * @return string
     */
    public function getCeeCodeTravaux(): string;

    /**
     * Retourne le code administratif de la région
     * @return string
     */
    public function getCodeRegion(): string;

    /**
     * Retourne le type de logement
     * @return string
     */
    public function getTypeLogement(): string;

    /**
     * Retourne l'âge du logement
     * @return int
     */
    public function getAgeLogement(): int;

}
