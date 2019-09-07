<?php

namespace MaterialBundle\Core\Validator;

use MaterialBundle\Core\Exception\EmptyDataException;
use MaterialBundle\Core\Exception\InvalidDataException;
use MaterialBundle\Core\Exception\ObjectNotFoundException;

class AbstractValidator implements ValidatorInterface
{
    /** @var array */
    protected $required = [];

    /**
     * @throws InvalidDataException
     */
    public function validate(array $data, string $method = 'POST'): array
    {
        if ($method === 'POST')
        {
            return $this->validateForPost($data);
        }
        if ($method === 'PATCH')
        {
            return $this->validateForPatch($data);
        }
    }

    protected function validateForPost(array $data): array
    {
        $diffExists = array_diff($this->required, array_keys($data));

        if (empty($data) || $diffExists)
        {
            throw new InvalidDataException('Invalid data!');
        }

        $this->checkIsEmpty($data);

        return $data;
    }

    protected function validateForPatch(array $data): array
    {
        $this->checkIsEmpty($data);

        return $data;
    }

    protected function throwNotFoundException($message)
    {
        throw new ObjectNotFoundException($message);
    }

    /**
     * @throws EmptyDataException
     */
    private function checkIsEmpty(array $data): void
    {
        array_filter($data, function ($value, $key)
        {
            if (empty($value))
            {
                throw new EmptyDataException('Data cannot be empty: ' . $key);
            }
        }, ARRAY_FILTER_USE_BOTH);
    }
}
