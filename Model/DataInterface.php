<?php

namespace AideTravaux\CEE\Res\Model;

use AideTravaux\CEE\OS\Model\BARInterface;

interface DataInterface extends BARInterface
{
    public function getCategorieCee(): string;

    public function getCeeCodeTravaux(): string;
}
