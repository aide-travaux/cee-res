<?php

namespace AideTravaux\CEE\Res\Utils;

use AideTravaux\CEE\Res\CEERes;
use AideTravaux\CEE\Res\Data\Entries;
use AideTravaux\CEE\Res\Model\ConditionInterface;
use AideTravaux\CEE\Res\Repository\Repository;

abstract class ConditionsResolver
{
    /**
     * Retourne les conditions d'accès satisfaites ou non
     * @param ConditionInterface
     * @return array
     */
    public static function resolveConditions(ConditionInterface $model): array
    {
        $conditions = [
            [
                'condition' => CEERes::CONDITIONS[0],
                'value' => !empty( Repository::getOneOrNull( $model->getCeeCodeTravaux() ) )
            ], [
                'condition' => CEERes::CONDITIONS[1],
                'value' => null
            ], [
                'condition' => CEERes::CONDITIONS[2],
                'value' => null
            ], 
            self::getAncienneteCondition($model), 
            self::getTypeBatimentCondition($model), 
            self::getZoneGeographiqueCondition($model)
        ];

        return array_filter($conditions, function($row) {
            return !empty($row);
        });
    }

    /**
     * Retourne l'éligibilité à l'aide financière
     * @param ConditionInterface
     * @return bool
     */
    public static function isEligible(ConditionInterface $model): bool
    {
        foreach (self::resolveConditions($model) as $condition) {
            if ($condition['value'] === false)  {
                return false;
            }
        }
        return true;
    }

    /**
     * @param ConditionInterface
     * @return array
     */
    private static function getAncienneteCondition(ConditionInterface $model): array
    {
        $base = Repository::getOneOrNull( $model->getCeeCodeTravaux() );

        if ($base && $base::TYPE_BATIMENT !== Entries::OS_TYPES_BATIMENT['os_type_batiment_4']) {
            return [
                'condition' => 'Le bâtiment achevé depuis plus de deux ans à la date de début des travaux et prestations',
                'value' => $model->getAgeLogement() > 2
            ];
        }
        return [];
    }

    /**
     * @param ConditionInterface
     * @return array
     */
    private static function getTypeBatimentCondition(ConditionInterface $model): array
    {
        $base = Repository::getOneOrNull( $model->getCeeCodeTravaux() );

        if ($base) {
            switch ($base::TYPE_BATIMENT) {
                case Entries::OS_TYPES_BATIMENT['os_type_batiment_2']:
                    return [
                        'condition' => 'Le bâtiment est une maison individuelle',
                        'value' => $model->getTypeLogement() > Entries::TYPES_LOGEMENT['type_logement_1']
                    ];
                case Entries::OS_TYPES_BATIMENT['os_type_batiment_3']:
                    return [
                        'condition' => 'Le bâtiment est un appartement',
                        'value' => $model->getTypeLogement() > Entries::TYPES_LOGEMENT['type_logement_2']
                    ];
                case Entries::OS_TYPES_BATIMENT['os_type_batiment_4']:
                    return [
                        'condition' => 'Le bâtiment est une maison individuelle',
                        'value' => $model->getTypeLogement() > Entries::TYPES_LOGEMENT['type_logement_1']
                    ];
                case Entries::OS_TYPES_BATIMENT['os_type_batiment_5']:
                    return [
                        'condition' => 'Le bâtiment est un bâtiment résidentiel collectif',
                        'value' => $model->getTypeLogement() > Entries::TYPES_LOGEMENT['type_logement_3']
                    ];
                default:
                    return [];
            }
        }
        return [];
    }

    /**
     * @param ConditionInterface
     * @return array
     */
    private static function getZoneGeographiqueCondition(ConditionInterface $model): array
    {
        $base = Repository::getOneOrNull( $model->getCeeCodeTravaux() );

        if ($base) {
            switch ($base::ZONE_GEOGRAPHIQUE) {
                case Entries::OS_ZONES_GEOGRAPHIQUES['os_zone_geographique_2']:
                    return [
                        'condition' => 'Le bâtiment est situé en France d\'outre-mer',
                        'value' => \in_array($model->getCodeRegion(), [
                            '01', '02', '03', '04', '06'
                        ])
                    ];
                case Entries::OS_ZONES_GEOGRAPHIQUES['os_zone_geographique_3']:
                    return [
                        'condition' => 'Le bâtiment est situé en France métropolitaine',
                        'value' => !\in_array($model->getCodeRegion(), [
                            '01', '02', '03', '04', '06'
                        ])
                    ];
                default:
                    return [];
            }
        }
        return [];
    }
}
