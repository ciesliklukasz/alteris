<?php

namespace MaterialBundle\Application\Builder;

use MaterialBundle\Core\Builder\BuilderInterface;
use MaterialBundle\Core\Model\WriteModel;
use MaterialBundle\Core\Validator\ValidatorInterface;
use MaterialBundle\Entity\MaterialGroup;

class MaterialGroupBuilder implements BuilderInterface
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
        $material = new MaterialGroup();
        $material->setName($data['name']);

        if (array_key_exists('parent', $data))
        {
            $material->setParent($data['parent']);
        }

        if (array_key_exists('children', $data))
        {
            $material->setParent($data['children']);
        }

        return $material;
    }
}
