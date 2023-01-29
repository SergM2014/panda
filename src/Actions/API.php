<?php

declare(strict_types=1);

namespace Src\Actions;

use Src\Interfaces\SurveyRepositoryInterface;

class API 
{
    public function __construct(private SurveyRepositoryInterface $repository){}

    public function all(): void
    {
        echo json_encode($this->repository->all());
    }

    public function get(mixed $id): void
    {
        echo json_encode($this->repository->get((int)$id));
    }

    public function getByUserId(int $id): void
    {
        echo json_encode($this->repository->getByUserId($id));
    }
}