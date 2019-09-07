<?php

namespace MaterialBundle\Core\Validator;

use MaterialBundle\Core\Exception\InvalidDataException;

interface ValidatorInterface
{
    /**
     * @throws InvalidDataException
     */
    public function validate(array $data, string $mathod = 'POST'): array ;
}
