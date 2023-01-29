<?php

declare(strict_types=1);

namespace Src\Interfaces;

interface ReportInterface
{
    public function report(mixed $report): void;
}