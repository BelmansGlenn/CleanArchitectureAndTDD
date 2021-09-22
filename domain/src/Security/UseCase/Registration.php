<?php

namespace Gbelmans\CodeChallenge\Domain\Security\UseCase;

use Gbelmans\CodeChallenge\Domain\Security\Entity\User;
use Gbelmans\CodeChallenge\Domain\Security\Gateway\UserGateway;
use Gbelmans\CodeChallenge\Domain\Security\Request\RegistrationRequest;
use Gbelmans\CodeChallenge\Domain\Security\Response\RegistrationResponse;
use Gbelmans\CodeChallenge\Domain\Security\Presenter\RegistrationPresenterInterface;

/**
* Class Registration
* @package Gbelmans\CodeChallenge\Domain\Security\UseCase
*/
class Registration
{
    /**
     * @var UserGateway
     */
    private UserGateway $userGateway;

    /**
     * @param UserGateway $userGateway
     */
    public function __construct(UserGateway $userGateway)
    {
        $this->userGateway = $userGateway;
    }

    /**
    * @param RegistrationRequest $request
    * @param RegistrationPresenterInterface $presenter
    */
    public function execute(RegistrationRequest $request, RegistrationPresenterInterface $presenter)
    {
        $request->validate($this->userGateway);
        $user = User::fromRegistration($request);
        $presenter->present(new RegistrationResponse($user));
    }
}