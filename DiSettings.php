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
    LoggerInterface::class => DI\factory(function () {
        $logger = new Logger('mylog');
        $fileHandler = new StreamHandler(DATA_LOGS, Logger::DEBUG);
        $fileHandler->setFormatter(new LineFormatter());
        $logger->pushHandler($fileHandler);

        return $logger;
    }),
    AuthentificationInterface::class => DI\get(User::class),
    SurveyRepositoryInterface::class => DI\get(Survey::class),   
];