<?php

namespace AideTravaux\CEE\Res\Utils;

use AideTravaux\CEE\Res\CEERes;
use AideTravaux\CEE\Res\Model\DataInterface;
use AideTravaux\CEE\Res\Model\ConditionInterface;

abstract class DataFormater
{
    /**
     * @param mixed|null
     * @return array
     */
    public static function get($model = null): array
    {
        $array = CEERes::toArray();

        if ($model instanceof DataInterface) {
            $array = \array_merge($array, [
                'montant' => CEERes::get($model),
                'bareme' => CEERes::getBareme($model),
                'cee_classique' => CEERes::getCeeClassique($model),
                'cee_precarite' => CEERes::getCeePrecarite($model),
                'cee_grande_precarite' => CEERes::getCeeGrandePrecarite($model)
            ]);
        }

        if ($model instanceof ConditionInterface) {
            $array = \array_merge($array, [
                'conditions' => CEERes::resolveConditions($model),
                'isEligible' => CEERes::isEligible($model)
            ]);
        }

        return $array;
    }
}
