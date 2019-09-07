<?php

namespace MaterialBundle\Core\Updater;

use MaterialBundle\Core\Model\WriteModel;

interface UpdaterInterface
{
    public function update(string $uuid, array $data): WriteModel;
}
