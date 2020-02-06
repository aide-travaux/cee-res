<?php

namespace AideTravaux\CEE\Res\Model;

interface ConditionInterface
{
    public function getCeeCodeTravaux(): string;

    public function getCodeRegion(): string;

    public function getTypeLogement(): string;

    public function getAgeLogement(): int;

}
