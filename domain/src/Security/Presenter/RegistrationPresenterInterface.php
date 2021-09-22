<?php

namespace Gbelmans\CodeChallenge\Domain\Security\Presenter;

use Gbelmans\CodeChallenge\Domain\Security\Response\RegistrationResponse;

/**
* Interface RegistrationPresenterInterface
* @package Gbelmans\CodeChallenge\Domain\Security\Presenter
*/
interface RegistrationPresenterInterface
{
/**
* @param RegistrationResponse $response
*/
public function present(RegistrationResponse $response): void;
}