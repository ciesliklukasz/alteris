<?php

namespace MaterialBundle\Application\Updater;

use MaterialBundle\Core\Model\WriteModel;
use MaterialBundle\Core\Repository\AbstractRepository;
use MaterialBundle\Core\Updater\UpdaterInterface;
use MaterialBundle\Core\Validator\ValidatorInterface;

class Updater implements UpdaterInterface
{
    /** @var AbstractRepository */
    private $repository;
    /** @var ValidatorInterface */
    private $validator;

    public function __construct(AbstractRepository $repository, ValidatorInterface $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function update(string $uuid, array $data): WriteModel
    {
        $object = $this->repository->findOneByUuid($uuid);
        $data = $this->validator->validate($data, 'PATCH');
        $object = $this->fillMaterialWithData($object, $data);
        $this->repository->save($object);

        return $object;
    }

    private function fillMaterialWithData(WriteModel $object, array $data): WriteModel
    {
        foreach ($data as $key => $value)
        {
            $getMethod = sprintf('get%s', ucfirst($key));

            if (method_exists($object, $getMethod))
            {
                $getValue = $object->{$getMethod}();

                $persistedValueHash = is_object($getValue) ? spl_object_hash($getValue) : md5($getValue);
                $newValueHash = is_object($value) ? spl_object_hash($value) : md5($value);

                if ($persistedValueHash !== $newValueHash)
                {
                    $setMethod = sprintf('set%s', ucfirst($key));

                    if (method_exists($object, $setMethod))
                    {
                        $object->{$setMethod}($value);
                    }
                }
            }
        }

        return $object;
    }
}
