<?php

declare(strict_types=1);

namespace Src\Interfaces;

interface SurveyRepositoryInterface
{
    public function store(array $jsons): bool;

    public function all(): array;

    public function delete(): bool;

    public function getSurvey(): object;

    public function update(array $jsons): bool;

    public function get(int $id): object;

    public function getByUserId(?int $id = null): array;
}