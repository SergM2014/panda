<?php

namespace Src;

use Src\Actions\ErrorOutput;
use Psr\Log\LoggerInterface;

trait ExceptionHandler
{
    public function __construct(
        private LoggerInterface $logger,
        private ErrorOutput $errorOutput
    ) { }
    
    /**
     * prozessException
     *
     * @param  mixed $messageToLog
     * @return void
     */
    public function prozessException(string $messageToLog): void
    {
        try {
            $this->errorOutput->report('something went wrong');
            throw new \Exception();
        } catch (\Exception $ex) {
            $this->logger->info($messageToLog);
        }
    }
}