<?php

namespace App\Request\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class EqualToDifferentPropertyValidator extends ConstraintValidator
{
    public function validate($object, Constraint $constraint)
    {
        var_dump($object);
        var_dump($constraint->comparedProperty);
        die();
        $comparedPropertyValue = $object->{$constraint->comparedProperty};
        $otherPropertyValue = $object->{$constraint->otherProperty};

        if ($comparedPropertyValue !== $otherPropertyValue) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ compared_property }}', $constraint->comparedProperty)
                ->setParameter('{{ other_property }}', $constraint->otherProperty)
                ->addViolation();
        }
    }
}