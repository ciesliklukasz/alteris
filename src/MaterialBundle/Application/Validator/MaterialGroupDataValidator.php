<?php

namespace MaterialBundle\Application\Validator;

use MaterialBundle\Core\Validator\AbstractValidator;
use MaterialBundle\Repository\MaterialGroupRepository;

class MaterialGroupDataValidator extends AbstractValidator
{
    /** @var array */
    protected $required = ['name'];

    /** @var MaterialGroupRepository */
    private $repository;

    /**
     * @param MaterialGroupRepository $materialGroupRepository
     */
    public function __construct(MaterialGroupRepository $materialGroupRepository)
    {
        $this->repository = $materialGroupRepository;
    }

    protected function validateForPost(array $data): array
    {
        $data = parent::validateForPost($data);
        $data = $this->validateForPatch($data);

        return $data;
    }

    protected function validateForPatch(array $data): array
    {
        $data = parent::validateForPatch($data);

        if (array_key_exists('parent', $data))
        {
            $parent = $this->repository->findOneByUuid($data['parent']);
            null === $parent ?
                $this->throwNotFoundException('Parent group not found!') :
                $data['parent'] = $parent;
        }

        if (array_key_exists('children', $data))
        {
            $children = $this->repository->findOneByUuid($data['children']);
            null === $children ?
                $this->throwNotFoundException('Children group not found!') :
                $data['children'] = $children;
        }

        return $data;

    }
}
