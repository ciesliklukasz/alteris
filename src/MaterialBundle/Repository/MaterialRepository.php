<?php

namespace MaterialBundle\Repository;

use MaterialBundle\Core\Repository\AbstractRepository;
use MaterialBundle\Entity\Material;

class MaterialRepository extends AbstractRepository
{
    protected function getClass(): string
    {
        return Material::class;
    }
}
