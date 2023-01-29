<?php

declare(strict_types=1);

namespace Src\Actions;

use Src\Interfaces\ReportInterface;

class ErrorOutput implements ReportInterface
{        
    /**
     * report
     *
     * @param  mixed $ex
     * @return void
     */
    public function report(mixed $ex): void
    {
        // var_dump($ex);
    }
}
