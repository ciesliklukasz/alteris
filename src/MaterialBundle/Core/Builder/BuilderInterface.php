<?php

namespace MaterialBundle\Core\Builder;

use MaterialBundle\Core\Model\WriteModel;

interface BuilderInterface
{
    public function build(array $data): WriteModel;
}
