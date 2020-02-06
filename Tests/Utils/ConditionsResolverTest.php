<?php

namespace AideTravaux\CEE\Res\Tests\Utils;

use PHPUnit\Framework\TestCase;
use AideTravaux\CEE\Res\CEERes;
use AideTravaux\CEE\Res\Data\Entries;
use AideTravaux\CEE\Res\Model\ConditionInterface;
use AideTravaux\CEE\Res\Utils\ConditionsResolver;

class ConditionsResolverTest extends TestCase
{
    /**
     * @dataProvider modelProvider
     */
    public function testResolveConditions($model)
    {
        $stub = $this->buildMock($model);
    
        $this->assertTrue(\is_array(ConditionsResolver::resolveConditions($stub)));
    }

    /**
     * @depends testResolveConditions
     * @dataProvider modelProvider
     */
    public function testResolveConditionsStructure($model)
    {
        $stub = $this->buildMock($model);

        foreach (ConditionsResolver::resolveConditions($stub) as $condition) {
            $this->assertArrayHasKey('condition', $condition);
            $this->assertArrayHasKey('value', $condition);
        }
    }

    /**
     * @depends testResolveConditionsStructure
     * @dataProvider modelProvider
     */
    public function testResolveConditionsType($model)
    {
        $stub = $this->buildMock($model);

        foreach (ConditionsResolver::resolveConditions($stub) as $condition) {
            $this->assertTrue(\is_string($condition['condition']));
            $this->assertTrue(\is_null($condition['value']) || \is_bool($condition['value']));
        }
    }

    /**
     * @depends testResolveConditionsStructure
     * @dataProvider modelProvider
     */
    public function testIsEligible($model)
    {
        $stub = $this->buildMock($model);
        $this->assertTrue(\is_bool(ConditionsResolver::isEligible($stub)));
    }

    public function buildMock(array $model)
    {
        $stub = $this->createMock(ConditionInterface::class);

        foreach ($model as $key => $value) {
            $stub->method($key)->willReturn($value);
        }
        return $stub;
    }

    public function modelProvider()
    {
        return [ 
            [
                'model' => [
                    'getCeeCodeTravaux' => 'BAR-TH-124',
                    'getAgeLogement' => 1
                ]
            ], [
                'model' => [
                    'getCeeCodeTravaux' => 'BAR-TH-124',
                    'getAgeLogement' => 3
                ]
            ], [
                'model' => [
                    'getCeeCodeTravaux' => 'BAR-EN-101',
                    'getTypeLogement' => Entries::TYPES_LOGEMENT['type_logement_1']
                ]
            ], [
                'model' => [
                    'getCeeCodeTravaux' => 'BAR-TH-121',
                    'getTypeLogement' => Entries::TYPES_LOGEMENT['type_logement_2']
                ]
            ], [
                'model' => [
                    'getCeeCodeTravaux' => 'BAR-TH-124',
                    'getTypeLogement' => Entries::TYPES_LOGEMENT['type_logement_1']
                ]
            ], [
                'model' => [
                    'getCeeCodeTravaux' => 'BAR-TH-163',
                    'getTypeLogement' => Entries::TYPES_LOGEMENT['type_logement_3']
                ]
            ], [
                'model' => [
                    'getCeeCodeTravaux' => 'BAR-TH-124',
                    'getTypeLogement' => Entries::TYPES_LOGEMENT['type_logement_3']
                ]
            ], [
                'model' => [
                    'getCeeCodeTravaux' => 'BAR-EN-101',
                    'getCodeRegion' => ''
                ]
            ], [
                'model' => [
                    'getCeeCodeTravaux' => 'BAR-TH-101',
                    'getCodeRegion' => '01'
                ]
            ], [
                'model' => [
                    'getCeeCodeTravaux' => 'BAR-TH-124',
                    'getCodeRegion' => '11'
                ]
            ], ['model' => []]
        ];
    }
}
