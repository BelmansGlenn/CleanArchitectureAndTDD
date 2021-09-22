<?php

namespace Gbelmans\CodeChallenge\Domain\Security\Response;

use Gbelmans\CodeChallenge\Domain\Security\Entity\User;

/**
* Class RegistrationResponse
* @package Gbelmans\CodeChallenge\Domain\Security\Response
*/
class RegistrationResponse
{
    /**
     * @var User
     */
    private User $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}