<?php

namespace AideTravaux\CEE\Res\Tests;

use PHPUnit\Framework\TestCase;
use AideTravaux\CEE\Res\CEERes;
use AideTravaux\CEE\Res\Model\DataInterface;

class CEEResTest extends TestCase
{
    public function testGet()
    {
        $stub = $this->getDefaultMock();
        $this->assertTrue(\is_float(CEERes::get($stub)));

        $stub = $this->getMock();
        $this->assertTrue(\is_float(CEERes::get($stub)));
    }

    public function testGetBareme()
    {
        $stub = $this->getDefaultMock();
        $this->assertNull(CEERes::getBareme($stub));

        $stub = $this->getMock();
        $this->assertTrue(\is_array(CEERes::getBareme($stub)));
    }

    public function testGetCeeClassique()
    {
        $stub = $this->getDefaultMock();
        $this->assertTrue(\is_float(CEERes::getCeeClassique($stub)));

        $stub = $this->getMock();
        $this->assertTrue(\is_float(CEERes::getCeeClassique($stub)));
    }

    public function testGetCeePrecarite()
    {
        $stub = $this->getDefaultMock();
        $this->assertTrue(\is_float(CEERes::getCeePrecarite($stub)));

        $stub = $this->getMock();
        $this->assertTrue(\is_float(CEERes::getCeePrecarite($stub)));
    }

    public function testGetCeeGrandeClassique()
    {
        $stub = $this->getDefaultMock();
        $this->assertTrue(\is_float(CEERes::getCeeGrandePrecarite($stub)));

        $stub = $this->getMock();
        $this->assertTrue(\is_float(CEERes::getCeeGrandePrecarite($stub)));
    }

    public function getDefaultMock()
    {
        return $this->createMock(DataInterface::class);
    }

    public function getMock()
    {
        $stub = $this->getDefaultMock();
        $stub->method('getCeeCodeTravaux')->willReturn('BAR-EN-101');
        $stub->method('getCategorieCee')->willReturn('Classique');
        $stub->method('getCodeDepartement')->willReturn('75');
        $stub->method('getZoneClimatique')->willReturn('H1');
        $stub->method('getSurfaceIsolant')->willReturn((float) 100);

        return $stub;
    }

}
