<?php

declare(strict_types=1);

namespace Src\Actions;

use Src\Interfaces\ActionsInterface;
use Src\Interfaces\ReportInterface;

class NotFound implements ReportInterface
{     
    /**
     * report
     *
     * @param  mixed $report
     * @return void
     */
    public function report(mixed $report = 'not found action or controller'): void
    {
        echo $report;
    }
}
