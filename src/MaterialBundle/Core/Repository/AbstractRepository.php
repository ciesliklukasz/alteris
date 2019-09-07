<?php

namespace MaterialBundle\Core\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use MaterialBundle\Core\Model\WriteModel;

abstract class AbstractRepository extends EntityRepository
{
    public function __construct(EntityManager $entityManager)
    {
        $classMetadata = $entityManager->getClassMetadata($this->getClass());
        parent::__construct($entityManager, $classMetadata);
    }

    public function findOneByUuid(string $uuid):? WriteModel
    {
        return $this->findOneBy(array('uuid' => $uuid));
    }

    public function save(WriteModel $model): void
    {
        $this->getEntityManager()->persist($model);
        $this->getEntityManager()->flush();
    }

    public function delete(WriteModel $model): void
    {
        $this->getEntityManager()->remove($model);
        $this->getEntityManager()->flush();
    }

    abstract protected function getClass(): string;
}
