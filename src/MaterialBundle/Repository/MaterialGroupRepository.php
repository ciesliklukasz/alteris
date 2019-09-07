<?php

namespace MaterialBundle\Repository;

use MaterialBundle\Core\Repository\AbstractRepository;
use MaterialBundle\Entity\MaterialGroup;

class MaterialGroupRepository extends AbstractRepository
{
    protected function getClass(): string
    {
        return MaterialGroup::class;
    }
}
