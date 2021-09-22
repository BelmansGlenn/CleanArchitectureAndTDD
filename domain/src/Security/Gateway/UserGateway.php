<?php

namespace Gbelmans\CodeChallenge\Domain\Security\Gateway;


/**
 * interface UserGateway
 * @package Gbelmans\CodeChallenge\Domain\Security\Gateway
 */
interface UserGateway
{
    /**
     * @param string $email
     * @return bool
     */
    public function isEmailUnique(string $email):bool;

    /**
     * @param string $username
     * @return bool
     */
    public function isUsernameUnique(string $username):bool;
}