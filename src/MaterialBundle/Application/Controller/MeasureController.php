<?php

namespace MaterialBundle\Application\Controller;

use MaterialBundle\Core\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class MeasureController extends AbstractController
{
    public function getUnitMeasureAction(string $uuid)
    {
        return $this->getAction($uuid, 'unit_measure');
    }

    public function getUnitMeasuresAction()
    {
        return $this->getAllAction('unit_measure');
    }

    public function postUnitMeasureAction(Request $request)
    {
        return $this->postAction($request, 'unit_measure');
    }

    public function patchUnitMeasureAction(Request $request, string $uuid)
    {
        return $this->patchAction($request, $uuid, 'unit_measure');
    }

    public function deleteUnitMeasureAction(string $uuid)
    {
        return $this->deleteAction($uuid, 'unit_measure');
    }
}
