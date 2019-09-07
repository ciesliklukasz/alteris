<?php

namespace MaterialBundle\Application\Validator;

use MaterialBundle\Core\Exception\InvalidDataException;
use MaterialBundle\Core\Validator\AbstractValidator;
use MaterialBundle\Repository\MaterialGroupRepository;
use MaterialBundle\Repository\UnitMeasureRepository;

class MaterialDataValidator extends AbstractValidator
{
    /** @var array */
    protected $required = [
        'name',
        'code',
        'materialGroup',
        'unitMeasure'
    ];

    /** @var MaterialGroupRepository */
    private $materialGroupRepository;
    /** @var UnitMeasureRepository */
    private $unitMeasureRepository;


    /**
     * @param MaterialGroupRepository $materialGroupRepository
     * @param UnitMeasureRepository $unitMeasureRepository
     */
    public function __construct(
        MaterialGroupRepository $materialGroupRepository,
        UnitMeasureRepository $unitMeasureRepository
    ) {
        $this->materialGroupRepository = $materialGroupRepository;
        $this->unitMeasureRepository = $unitMeasureRepository;
    }

    protected function validateForPost(array $data): array
    {
        $data = parent::validateForPost($data);

        $materialGroup = $this->materialGroupRepository->findOneByUuid($data['materialGroup']);
        $unitMeasure = $this->unitMeasureRepository->findOneByUuid($data['unitMeasure']);

        if (null === $materialGroup || null === $unitMeasure)
        {
            throw new InvalidDataException('Related objects MaterialGroup not found!');
        }

        $data['materialGroup'] = $materialGroup;
        $data['unitMeasure'] = $unitMeasure;

        return $data;
    }

    protected function validateForPatch(array $data): array
    {
        $data = parent::validateForPatch($data);

        if (array_key_exists('materialGroup', $data))
        {
            $materialGroup = $this->materialGroupRepository->findOneByUuid($data['materialGroup']);
            null === $materialGroup ?
                $this->throwNotFoundException('Material group not found!') :
                $data['materialGroup'] = $materialGroup;
        }

        if (array_key_exists('unitMeasure', $data))
        {
            $unitMeasure = $this->unitMeasureRepository->findOneByUuid($data['unitMeasure']);
            null === $unitMeasure ?
                $this->throwNotFoundException('Unit measure not found!') :
                $data['unitMeasure'] = $unitMeasure;
        }

        return $data;

    }
}
