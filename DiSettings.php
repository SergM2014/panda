<?php

use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Src\Actions\ErrorOutput;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;
use Src\Interfaces\AuthentificationInterface;
use Src\Repositories\User;
use Src\Interfaces\SurveyRepositoryInterface;
use Src\Repositories\Survey;


return [
    LoggerInterface::class => DI\factory(factory: function (): Logger {
        $logger = new Logger(name: 'mylog');
        $fileHandler = new StreamHandler(stream: DATA_LOGS, level: Logger::DEBUG);
        $fileHandler->setFormatter(formatter: new LineFormatter());
        $logger->pushHandler(handler: $fileHandler);

        return $logger;
    }),
    AuthentificationInterface::class => DI\get(entryName: User::class),
    SurveyRepositoryInterface::class => DI\get(entryName: Survey::class),   
];