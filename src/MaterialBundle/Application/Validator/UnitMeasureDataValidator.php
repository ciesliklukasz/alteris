<?php

namespace MaterialBundle\Application\Validator;

use MaterialBundle\Core\Validator\AbstractValidator;

class UnitMeasureDataValidator extends AbstractValidator
{
    /** @var array */
    protected $required = [
        'name',
        'shortName',
    ];
}
