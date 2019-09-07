<?php

namespace MaterialBundle\Application\Builder;

use MaterialBundle\Core\Builder\BuilderInterface;
use MaterialBundle\Core\Model\WriteModel;
use MaterialBundle\Core\Validator\ValidatorInterface;
use MaterialBundle\Entity\Material;

class MaterialBuilder implements BuilderInterface
{
    /** @var ValidatorInterface */
    private $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function build(array $data): WriteModel
    {
        $data = $this->validator->validate($data);
        $material = new Material();
        $material->setName($data['name']);
        $material->setCode($data['code']);
        $material->setMaterialGroup($data['materialGroup']);
        $material->setUnitMeasure($data['unitMeasure']);

        return $material;
    }
}
