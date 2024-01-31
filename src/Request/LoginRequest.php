<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;
class LoginRequest extends BaseRequest
{

    #[Assert\Email(
        message: 'The email {{ value }} is not a valid email.',
    )]
    protected $email;

    #[Assert\Type('string')]
    #[Assert\Length(min: 1, max: 50)]
    protected $password;
}