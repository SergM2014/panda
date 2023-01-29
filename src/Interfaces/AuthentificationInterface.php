<?php

declare(strict_types=1);

namespace Src\Interfaces;

interface AuthentificationInterface
{     
    public function uniqueEmail(string $email): bool;

    public function store(): bool;

    public function getUser(): mixed;
}