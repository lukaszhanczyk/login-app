<?php

namespace App\Request\Constraint;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class EqualToDifferentProperty extends Constraint
{
    public $message = 'The value of "{{ compared_property }}" must be equal to "{{ other_property }}"';
    public $comparedProperty;
    public $otherProperty;

    public function __construct(string $comparedProperty = null, string $otherProperty = null, string $message = null, array $groups = null, $payload = null)
    {
        parent::__construct([], $groups, $payload);

        $this->comparedProperty = $comparedProperty ?? $this->comparedProperty;
        $this->otherProperty = $otherProperty ?? $this->otherProperty;
        $this->message = $message ?? $this->message;
    }

    public function validatedBy(): string
    {
        return 'App\Request\Validator\EqualToDifferentPropertyValidator';
    }
}