<?php

namespace App\Request;

use App\Request\Constraint as CustomAssert;
use Symfony\Component\Validator\Constraints as Assert;
class RegisterRequest extends BaseRequest
{

    #[Assert\Email(
        message: 'The email {{ value }} is not a valid email.',
    )]
    public $email;

    #[Assert\Type('string')]
    #[Assert\Length(min: 1, max: 50)]
    public $name;

    #[Assert\Type('string')]
    #[Assert\Length(min: 1, max: 50)]
    public $password;

    #[Assert\Type('string')]
//    #[CustomAssert\EqualToDifferentProperty(comparedProperty: $this->password)]
    public $confirmed_password;
}