<?php

namespace App\Validator\Constraints;

use App\Validator\HasValidPositionValidator;
use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute]
class HasValidPosition extends Constraint
{
    public string $message = 'has_valid_position.message';

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }

    public function validatedBy(): string
    {
        return HasValidPositionValidator::class;
    }
}
