<?php

namespace AideTravaux\CEE\Res;

use AideTravaux\CEE\Categorie\Utils\HelperCategorie;
use AideTravaux\CEE\Categorie\Utils\HelperPlafondGrandePrecarite;
use AideTravaux\CEE\Categorie\Utils\HelperPlafondPrecarite;
use AideTravaux\CEE\Res\Data\Entries;
use AideTravaux\CEE\Res\Model\DataInterface;
use AideTravaux\CEE\Res\Model\ConditionInterface;
use AideTravaux\CEE\Res\Repository\Repository;
use AideTravaux\CEE\Res\Utils\ConditionsResolver;

abstract class CEERes
{
    /**
     * @property string
     */
    const NOM = 'Certificats d\'économies d\'énergie';

    /**
     * @property string
     */
    const DESCRIPTION = 'Le dispositif certificats d\'économies d\'énergie finance les travaux d\'amélioration
                        de la performance énergétique par le versement d\'une prime financière';
    
    /**
     * @property string
     */
    const DELAI = 'Sur présentation des factures';
    
    /**
     * @property string
     */
    const DISTRIBUTEUR = 'Entreprises partenaires';
    
    /**
     * @property array
     */
    const REFERENCES = [
        'https://www.ecologique-solidaire.gouv.fr/politiques/certificats-economies-denergie',
        'https://www.legifrance.gouv.fr/jo_pdf.do?id=JORFTEXT000029953752'
    ];

    /**
     * @property array
     */
    const CONDITIONS = [
        'Les travaux sont éligibles',
        'Les travaux n\'ont pas encore commencé',
        'Les travaux sont réalisés par une entreprise qualifiée RGE'
    ];

    /**
     * Retourne le montant de l'aide financière
     * @param DataInterface
     * @return float
     */
    public static function get(DataInterface $model): float
    {
        return (float) 
            self::getCeeClassique($model) 
            + self::getCeePrecarite($model) 
            + self::getCeeGrandePrecarite($model)
        ;
    }

    /**
     * Retourne le barême de la fiche d'opération standardisée
     * @param DataInterface
     * @return array|null
     */
    public static function getBareme(DataInterface $model): ?array
    {
        $base = Repository::getOneOrNull( $model->getCeeCodeTravaux() );

        return ($base) ? $base::toArray($model) : null;
    }

    /**
     * Retourne le volume de certificats Classique
     * @param DataInterface
     * @return float
     */
    public static function getCeeClassique(DataInterface $model): float
    {
        $base = Repository::getOneOrNull( $model->getCeeCodeTravaux() );
        $base = ($base) ? $base::get($model) : 0;

        return 
            ( $model->getCategorieCee() === Entries::CATEGORIES_CEE['categorie_cee_1'] ) 
            ? (float) $base 
            : (float) 0
        ;
    }

    /**
     * Retourne le volume de certificats Précarité énergétique
     * @param DataInterface
     * @return float
     */
    public static function getCeePrecarite(DataInterface $model): float
    {
        $base = Repository::getOneOrNull( $model->getCeeCodeTravaux() );
        $base = ($base) ? $base::get($model) : 0;

        return 
            ( $model->getCategorieCee() === Entries::CATEGORIES_CEE['categorie_cee_2'] ) 
            ? (float) $base 
            : (float) 0
        ;
    }

    /**
     * Retourne le volume de certificats Grande précarité énergétique
     * @param DataInterface
     * @return float
     */
    public static function getCeeGrandePrecarite(DataInterface $model): float
    {
        $base = Repository::getOneOrNull( $model->getCeeCodeTravaux() );
        $base = ($base) ? $base::get($model) : 0;

        return 
            ( $model->getCategorieCee() === Entries::CATEGORIES_CEE['categorie_cee_3'] ) 
            ? (float) $base * 2
            : (float) 0
        ;
    }

    /**
     * @see ConditionsResolver
     */
    public static function resolveConditions(ConditionInterface $model): array
    {
        return ConditionsResolver::resolveConditions($model);
    }

    /**
     * @see ConditionsResolver
     */
    public static function isEligible(ConditionInterface $model): bool
    {
        return ConditionsResolver::isEligible($model);
    }

    /**
     * @return array
     */
    public static function toArray(): array
    {
        return [
            'nom' => self::NOM,
            'description' => self::DESCRIPTION,
            'delai' => self::DELAI,
            'distributeur' => self::DISTRIBUTEUR,
            'references' => self::REFERENCES,
            'conditions' => self::CONDITIONS
        ];
    }
}
