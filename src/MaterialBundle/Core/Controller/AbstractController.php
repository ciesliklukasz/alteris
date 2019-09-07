<?php

namespace MaterialBundle\Core\Controller;

use Exception;
use FOS\RestBundle\Controller\FOSRestController;
use MaterialBundle\Core\Builder\BuilderInterface;
use MaterialBundle\Core\Model\WriteModel;
use MaterialBundle\Core\Repository\AbstractRepository;
use MaterialBundle\Core\Updater\UpdaterInterface;
use MaterialBundle\Repository\UnitMeasureRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AbstractController extends FOSRestController
{
    protected function getAction(string $uuid, string $resourceType)
    {
        $repositoryName = sprintf('%s_repository', $resourceType);
        /** @var AbstractRepository $repository */
        $repository = $this->container->get($repositoryName);
        $object = $repository->findOneByUuid($uuid);

        if (null === $object)
        {
            return new JsonResponse(array(
                'status' => 'failed',
                'message' => 'Object not found: ' . $uuid
            ), 404);
        }

        return $object;
    }

    protected function getAllAction(string $resourceType)
    {
        $repositoryName = sprintf('%s_repository', $resourceType);
        $repository = $this->container->get($repositoryName);
        return $repository->findAll();
    }

    protected function postAction(Request $request, string $resourceType)
    {
        $builderName = sprintf('%s_builder', $resourceType);
        $repositoryName = sprintf('%s_repository', $resourceType);

        try
        {
            $params = $request->request->all();
            /** @var BuilderInterface $builder */
            $builder = $this->container->get($builderName);
            /** @var WriteModel $object */
            $object = $builder->build($params);
            $repository = $this->container->get($repositoryName);
            $repository->save($object);

            return $object;
        }
        catch (Exception $e)
        {
            return new JsonResponse(array(
                'status' => 'failed',
                'message' => $e->getMessage()
            ), 400);
        }
    }

    protected function patchAction(Request $request, string $uuid, string $resourceType)
    {
        $updaterName = sprintf('%s_updater', $resourceType);

        try
        {
            $params = $request->request->all();
            /** @var UpdaterInterface $updater */
            $updater = $this->container->get($updaterName);
            /** @var WriteModel $object */
            $object = $updater->update($uuid, $params);

            return $object;
        }
        catch (Exception $e)
        {
            return new JsonResponse(array(
                'status' => 'failed',
                'message' => $e->getMessage()
            ), 400);
        }
    }

    protected function deleteAction(string $uuid, string $resourceType)
    {
        $repositoryName = sprintf('%s_repository', $resourceType);

        /** @var UnitMeasureRepository $repository */
        $repository = $this->container->get($repositoryName);
        $object = $repository->findOneByUuid($uuid);

        if (null === $object)
        {
            return new JsonResponse(array(
                'status' => 'failed',
                'message' => 'Object not found: ' . $uuid
            ), 404);
        }

        $repository->delete($object);

        if (null === $repository->findOneByUuid($uuid))
        {
            return new JsonResponse(array(
                'status' => 'ok',
                'message' => 'Object deleted: ' . $uuid
            ), 200);
        }
    }
}
