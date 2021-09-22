<?php

namespace Gbelmans\CodeChallenge\Domain\Security\Entity;

use Gbelmans\CodeChallenge\Domain\Security\Request\RegistrationRequest;

/**
 * Class User
 * @package Gbelmans\CodeChallenge\Domain\Security\Entity
 */
class User
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
    private string $password;

    /**
     * @param RegistrationRequest $request
     * @return static
     */
    public static function fromRegistration(RegistrationRequest $request): self
    {
        return new self($request->getEmail(),
                        $request->getUsername(),
                        $request->getPlainPassword()
        );
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
        $this->password = password_hash($plainPassword, PASSWORD_ARGON2I);
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
    public function getPassword(): string
    {
        return $this->password;
    }

}