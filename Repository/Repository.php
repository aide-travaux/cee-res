<?php

namespace AideTravaux\CEE\Res\Repository;

use AideTravaux\CEE\OS\Database\Database;

abstract class Repository extends Database
{
    /**
     * Retourne les classes BAR uniquement
     */
    public static function getAll(): array
    {
        return array_filter(self::DB, function($class) {
            return \substr($class::CODE, 0, 3) === 'BAR';
        });
    }

    /**
     * Retourne la classe correspondante au code en paramètre
     * @param string
     * @return string|null
     */
    public static function getOneOrNull(string $code): ?string
    {
        $result = array_filter(self::getAll(), function($class) use ($code) {
            return $code === $class::CODE;
        });

        return ($result) ? current($result) : null;
    }
}
