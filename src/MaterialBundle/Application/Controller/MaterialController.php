<?php

namespace MaterialBundle\Application\Controller;

use MaterialBundle\Core\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class MaterialController extends AbstractController
{
    public function getMaterialAction(string $uuid)
    {
        return $this->getAction($uuid, 'material');
    }

    public function getMaterialsAction()
    {
        return $this->getAllAction('material');
    }

    public function postMaterialAction(Request $request)
    {
        return $this->postAction($request, 'material');
    }

    public function patchMaterialAction(Request $request, string $uuid)
    {
        return $this->patchAction($request, $uuid, 'material');
    }

    public function deleteMaterialAction(string $uuid)
    {
        return $this->deleteAction($uuid, 'material');
    }
}
