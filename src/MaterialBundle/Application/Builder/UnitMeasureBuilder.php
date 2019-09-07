<?php

namespace MaterialBundle\Application\Builder;

use MaterialBundle\Core\Builder\BuilderInterface;
use MaterialBundle\Core\Model\WriteModel;
use MaterialBundle\Core\Validator\ValidatorInterface;
use MaterialBundle\Entity\UnitMeasure;

class UnitMeasureBuilder implements BuilderInterface
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
        $unitMeasure = new UnitMeasure();
        $unitMeasure->setName($data['name']);
        $unitMeasure->setShortName($data['shortName']);

        return $unitMeasure;
    }
}
