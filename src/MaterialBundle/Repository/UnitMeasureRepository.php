<?php

namespace MaterialBundle\Repository;

use MaterialBundle\Core\Repository\AbstractRepository;
use MaterialBundle\Entity\UnitMeasure;

class UnitMeasureRepository extends AbstractRepository
{
    protected function getClass(): string
    {
        return UnitMeasure::class;
    }
}
