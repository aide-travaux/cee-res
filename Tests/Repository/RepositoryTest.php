<?php

namespace AideTravaux\CEE\Res\Tests\Repository;

use PHPUnit\Framework\TestCase;
use AideTravaux\CEE\Res\Repository\Repository;

class RepositoryTest extends TestCase
{
    public function testGetAll()
    {
        $this->assertTrue(\is_array(Repository::getAll()));
    }

    public function testGetOneOrNull()
    {
        $this->assertTrue(\is_string(Repository::getOneOrNull('BAR-EN-101')));
        $this->assertNull(Repository::getOneOrNull(''));
    }
}
