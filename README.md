# Certificats d'économies d'énergie - Secteur résidentiel

## Introduction

La classe CEERes retourne toutes les informations relatives à l'aide financière Certificats d'économies d'énergie

## Constantes

**CEERes::NOM**
Le nom de l'aide financière

**CEERes::DESCRIPTION**
Une description de l'aide financière

**CEERes::DELAI**
Délai de versement de l'aide financière

**CEERes::DISTRIBUTEUR**
Distributeur de l'aide financière

**CEERes::REFERENCES**
Références légales ou institutionnelles de l'aide financière

**CEERes::CONDITIONS**
Conditions d'accès de l'aide financière

## Méthodes

```
CEERes::get(DataInterface $model): float;
```
Retourne le volume calculé de certificats sur la base des informations transmises

```
CEERes::getBareme(DataInterface $model): ?array;
```
Retourne les barêmes en vigueur pour l'ouvrage transmis

```
CEERes::getCeeClassique(DataInterface $model): float;
```
Retourne le volume calculé de certificats "Classique" sur la base des informations transmises

```
CEERes::getCeePrecarite(DataInterface $model): float;
```
Retourne le volume calculé de certificats "Précarité" sur la base des informations transmises

```
CEERes::getCeeGrandePrecarite(DataInterface $model): float;
```
Retourne le volume calculé de certificats "Grande précarité" sur la base des informations transmises

```
CEERes::resolveConditions(ConditionInterface $model): array;
```
Retourne les conditions d'accès à l'aide et, pour chacune, si la condition est satisfaite sur la base des 
informations transmises

```
CEERes::isEligible(ConditionInterface $model): bool;
```
Retourne l'éligibilité du projet à l'aide financière sur la base des informations transmises

## Exemples

use AideTravaux\CEE\Res\Model\DataInterface;
use AideTravaux\CEE\Res\Model\ConditionInterface;
use AideTravaux\CEE\Res\Utils\DataFormater;
use AideTravaux\CEE\Res\CEERes;

class Data implements DataInterface, ConditionInterface
{
    public function getCodeRegion(): string
    {
        return '11';
    }

    public function getCodeDepartement(): string
    {
        return '75';
    }

    public function getZoneClimatique(): string
    {
        return 'H1';
    }

    public function getCompositionMenage(): int
    {
        return 0;
    }

    public function getRessourcesMenage(): float
    {
        return (float) 0;
    }

    public function getCategorieCee(): string
    {
        return 'Grande précarité énergétique';
    }

    public function getCeeCodeTravaux(): string
    {
        return 'BAR-EN-101';
    }

    public function getTypeLogement(): string
    {
        return 'Maison individuelle';
    }

    public function getAncienneteLogement(): string
    {
        return 'Logement existant';
    }

    public function getAgeLogement(): int
    {
        return 30;
    }

    public function getEnergieChauffage(): string
    {
        return 'Combustible';
    }

    public function getTypeChauffage(): string
    {
         return '';
    }

    public function getSurfaceCapteurs(): float
    {
        return (float) 0;
    }

    public function getSurfaceChauffee(): float
    {
        return (float) 0;
    }

    public function getSurfaceHabitable(): float
    {
        return (float) 0;
    }

    public function getSurfaceIsolant(): float
    {
        return (float) 100;
    }

    public function getSurfaceToitureProtegee(): float
    {
        return (float) 0;
    }

    public function getEfficaciteSaisonniere(): int
    {
        return 0;
    }

    public function getScop(): float
    {
        return (float) 0;
    }

    public function getNombreAppartements(): int
    {
        return 0;
    }

    public function getNombreChaudieres(): int
    {
        return 0;
    }

    public function getNombreRadiateurs(): int
    {
        return 0;
    }

    public function getNombreRobinetsThermostatiques(): int
    {
        return 0;
    }

    public function getNombreFenetres(): int
    {
        return 0;
    }

    public function getNombreFermetures(): int
    {
        return 0;
    }

    public function getTypeVmcDoubleFlux(): string
    {
         return '';
    }

    public function getTypeEchangeurVentilation(): string
    {
         return '';
    }

    public function getTypeVmcSimpleFlux(): string
    {
         return '';
    }

    public function getTypeCaissonVentilation(): string
    {
         return '';
    }

    public function getTypeVentilationHybride(): string
    {
         return '';
    }

    public function getTypeExtracteurVentilation(): string
    {
         return '';
    }

    public function getLongueurReseauIsolee(): float
    {
        return (float) 0;
    }

}

$data = new Data();

var_dump(CEERes::get($data));
var_dump(DataFormater::get($data));

## Base de données

| Code | Travaux |
| ---- | ------- |
| BAR-EN-101 | Isolation de combles ou de toiture |
| BAR-EN-102 | Isolation des murs |
| BAR-EN-103 | Isolation d'un plancher |
| BAR-EN-104 | Fenêtre ou porte-fenêtre complète avec vitrage isolant |
| BAR-EN-105 | Isolation des toitures terrasses |
| BAR-EN-106 | Isolation de combles ou de toitures - (France d'outre-mer) |
| BAR-EN-108 | Fermeture isolante |
| BAR-EN-109 | Réduction des apports solaires par la toiture - (France d'outre-mer) |
| BAR-TH-101 | Chauffe-eau solaire individuel (France métropolitaine) |
| BAR-TH-104 | Pompe à chaleur de type air/eau ou eau/eau |
| BAR-TH-106 | Chaudière individuelle à haute performance énergétique |
| BAR-TH-110 | Radiateur basse température pour un chauffage central |
| BAR-TH-111 | Régulation par sonde de température extérieure |
| BAR-TH-112 | Appareil indépendant de chauffage au bois |
| BAR-TH-113 | Chaudière biomasse individuelle |
| BAR-TH-116 | Plancher chauffant hydraulique à basse température |
| BAR-TH-117 | Robinet thermostatique |
| BAR-TH-118 | Système de régulation par programmation d'intermittence |
| BAR-TH-121 | Système de comptage individuel d'énergie de chauffage |
| BAR-TH-123 | Optimiseur de relance en chauffage collectif |
| BAR-TH-124 | Chauffe-eau solaire individuel (France d'outre-mer) |
| BAR-TH-125 | Système de ventilation double flux autoréglable ou modulé à haute performance (France métropolitaine) |
| BAR-TH-127 | Ventilation Mécanique Contrôlée simple flux hygroréglable (France métropolitaine) |
| BAR-TH-129 | Pompe à chaleur de type air/air |
| BAR-TH-137 | Raccordement d'un bâtiment résidentiel à un réseau de chaleur |
| BAR-TH-143 | Système solaire combinée (France métropolitaine) |
| BAR-TH-148 | Chauffe-eau thermodynamique à accumulation |
| BAR-TH-155 | Ventilation hybride hygroréglable (France métropolitaine) |
| BAR-TH-158 | Émetteur électrique à régulation électronique à fonctions avancées |
| BAR-TH-159 | Pompe à chaleur hybride individuelleu |
| BAR-TH-160 | Isolation d'un réseau hydraulique de chauffage ou d'eau chaude sanitaire |
| BAR-TH-162 | Système énergétique comportant des capteurs solaires photovoltaïques et thermiques à circulation d'eau (France métropolitaine) |
| BAR-TH-163 | Conduit d'évacuation des produits de combustion |

## Sources

- [Arrêté du 29 décembre 2014 relatif aux modalités d'application du dispositif des certificats d'économies d'énergi](https://www.legifrance.gouv.fr/affichTexte.do?cidTexte=JORFTEXT000030001603)

- [Liste des fiches d'opérations standardisées pour la 4ème période d'engagement](http://atee.fr/c2e/operations-standardisees-4eme-periode)
