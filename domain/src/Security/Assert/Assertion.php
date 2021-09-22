<?php

namespace Gbelmans\CodeChallenge\Domain\Security\Assert;

use Assert\Assertion as BaseAssertion;
use Gbelmans\CodeChallenge\Domain\Security\Exception\NonUniqueEmailException;
use Gbelmans\CodeChallenge\Domain\Security\Exception\NonUniqueUsername;
use Gbelmans\CodeChallenge\Domain\Security\Gateway\UserGateway;

/**
 * Class Assertion
 * @package Gbelmans\CodeChallenge\Domain\Security\Assert
 */
class Assertion extends BaseAssertion
{
    public const EXISTING_EMAIL = 500;
    public const EXISTING_USERNAME = 501;


    /**
     * @param string $email
     * @param UserGateway $userGateway
     */
    public static function nonUniqueEmail(string $email, UserGateway $userGateway): void
    {
        if (!$userGateway->isEmailUnique($email)){
            throw new NonUniqueEmailException("This email is already used.", self::EXISTING_EMAIL);
        }
    }

    /**
     * @param string $username
     * @param UserGateway $userGateway
     */
    public static function nonUniqueUSERNAME(string $username, UserGateway $userGateway): void
    {
        if (!$userGateway->isUsernameUnique($username)){
            throw new NonUniqueUsername("This username is already used.", self::EXISTING_USERNAME);
        }
    }
}