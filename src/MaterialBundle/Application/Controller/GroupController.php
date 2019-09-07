<?php

namespace MaterialBundle\Application\Controller;

use MaterialBundle\Core\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GroupController extends AbstractController
{
    public function getMaterialGroupAction(string $uuid)
    {
        return $this->getAction($uuid, 'material_group');
    }

    public function getMaterialGroupsAction()
    {
        return $this->getAllAction('material_group');
    }

    public function postMaterialGroupAction(Request $request)
    {
        return $this->postAction($request, 'material_group');
    }

    public function patchMaterialGroupAction(Request $request, string $uuid)
    {
        return $this->patchAction($request, $uuid, 'material_group');
    }

    public function deleteMaterialGroupAction(string $uuid)
    {
        return $this->deleteAction($uuid, 'material_group');
    }
}
