<?php

namespace AideTravaux\CEE\Res\Tests\Utils;

use PHPUnit\Framework\TestCase;
use AideTravaux\CEE\Res\Model\DataInterface;
use AideTravaux\CEE\Res\Model\ConditionInterface;
use AideTravaux\CEE\Res\Utils\DataFormater;

class DataFormaterTest extends TestCase
{
    public function testGetBase()
    {
        $this->assertTrue(\is_array(DataFormater::get()));
    }

    public function testGetData()
    {
        $stub = $this->createMock(DataInterface::class);
        $this->assertTrue(\is_array(DataFormater::get($stub)));
    }

    public function testGetCondition()
    {
        $stub = $this->createMock(ConditionInterface::class);
        $this->assertTrue(\is_array(DataFormater::get($stub)));
    }
}
