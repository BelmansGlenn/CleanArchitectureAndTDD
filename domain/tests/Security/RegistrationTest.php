<?php

namespace Gbelmans\CodeChallenge\Domain\Tests\Security;

use Assert\AssertionFailedException;
use Gbelmans\CodeChallenge\Domain\Security\Entity\User;
use Gbelmans\CodeChallenge\Domain\Security\Gateway\UserGateway;
use Gbelmans\CodeChallenge\Domain\Security\Presenter\RegistrationPresenterInterface;
use Gbelmans\CodeChallenge\Domain\Security\Request\RegistrationRequest;
use Gbelmans\CodeChallenge\Domain\Security\Response\RegistrationResponse;
use Gbelmans\CodeChallenge\Domain\Security\UseCase\Registration;
use PHPUnit\Framework\TestCase;

/**
* Class RegistrationTest
* @package Gbelmans\CodeChallenge\Domain\Tests\Security
*/
class RegistrationTest extends TestCase
{
    /**
     * @var Registration
     */
    private Registration $useCase;

    /**
     * @var RegistrationPresenterInterface|__anonymous@835
     */
    private RegistrationPresenterInterface $presenter;

    public function setup():void
    {
        $this->presenter = new class() implements RegistrationPresenterInterface {
            public RegistrationResponse $response;

            public function present(RegistrationResponse $response): void
            {
                $this->response = $response;
            }
        };
        $userGateway = new class() implements UserGateway{

            public function isEmailUnique(string $email): bool
            {
                return $email != "used@email.com";
            }

            public function isUsernameUnique(string $username): bool
            {
                return $username != "used_username";
            }

        };

        $this->useCase = new Registration($userGateway);
    }
    public function testSuccessful(): void
    {
        $request = RegistrationRequest::create("email@email.com", "pseudo", "password");



        $this->useCase->execute($request, $this->presenter);

        $this->assertInstanceOf(RegistrationResponse::class, $this->presenter->response);

        $this->assertInstanceOf(User::class, $this->presenter->response->getUser());

        $this->assertEquals("email@email.com", $this->presenter->response->getUser()->getEmail());

        $this->assertEquals("pseudo", $this->presenter->response->getUser()->getUsername());

        $this->assertTrue(password_verify("password", $this->presenter->response->getUser()->getPassword()));
    }

    /**
     * @dataProvider provideFailedRequestData
     * @param string $email
     * @param string $username
     * @param string $plainPassword
     */
    public function testFailedRequest(string $email, string $username, string $plainPassword): void
    {

        $request = RegistrationRequest::create($email, $username, $plainPassword);
        $this->expectException(AssertionFailedException::class);
        $this->useCase->execute($request, $this->presenter);
    }

    /**
     * @return \Generator
     */
    public function provideFailedRequestData(): \Generator
    {
        yield["", "username", "password"];
        yield["email", "username", "password"];
        yield["email@email.com", "", "password"];
        yield["email@email.com", "username", ""];
        yield["email@email.com", "username", "pass"];
        yield["used@email.com", "username", "password"];
        yield["email@email.com", "used_username", "password"];
    }
}