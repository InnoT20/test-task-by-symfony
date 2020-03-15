<?php


namespace App\Request;


use Symfony\Component\Validator\Constraints as Assert;

class RegistrationRequest
{
    /**
     * @Assert\NotBlank()
     * @var string
     */
    public $username;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=6, minMessage="Your password should be at least {{ limit }} characters", max=50)
     * @var string
     */
    public $password;
}