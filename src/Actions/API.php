<?php

declare(strict_types=1);

namespace Src\Actions;

use Src\Interfaces\SurveyRepositoryInterface;

class API 
{
    public function __construct(private SurveyRepositoryInterface $repository){}

    public function all(): void
    {
        echo json_encode(value: $this->repository->all());
    }

    public function get(mixed $id): void
    {
        echo json_encode(value: $this->repository->get(id: (int)$id));
    }

    public function getByUserId(int $id): void
    {
        echo json_encode(value: $this->repository->getByUserId(id: $id));
    }
}