<?php

namespace Gbelmans\CodeChallenge\Domain\Security\Request;

use Assert\InvalidArgumentException;
use Gbelmans\CodeChallenge\Domain\Security\Assert\Assertion;
use Gbelmans\CodeChallenge\Domain\Security\Exception\NonUniqueEmailException;
use Gbelmans\CodeChallenge\Domain\Security\Gateway\UserGateway;

/**
* Class RegistrationRequest
* @package Gbelmans\CodeChallenge\Domain\Security\Request
*/
class RegistrationRequest
{
    /**
     * @var string
     */
    private string $email;
    /**
     * @var string
     */
    private string $username;
    /**
     * @var string
     */
    private string $plainPassword;

    /**
     * @param string $email
     * @param string $username
     * @param string $plainPassword
     * @return static
     */
    public static function create(string $email, string $username, string $plainPassword):self
    {
        return new self($email, $username, $plainPassword);
    }

    /**
     * @param string $email
     * @param string $username
     * @param string $plainPassword
     */
    public function __construct(string $email, string $username, string $plainPassword)
    {
        $this->email = $email;
        $this->username = $username;
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPlainPassword(): string
    {
        return $this->plainPassword;
    }


    /**
     * @param UserGateway $userGateway
     * @throws \Assert\AssertionFailedException
     */
    public function validate(UserGateway $userGateway): void
    {
        Assertion::notBlank($this->email);
        Assertion::email($this->email);
        Assertion::nonUniqueEmail($this->email, $userGateway);
        Assertion::notBlank($this->username);
        Assertion::nonUniqueUSERNAME($this->username, $userGateway);
        Assertion::notBlank($this->plainPassword);
        Assertion::minLength($this->plainPassword, 6);
    }

}