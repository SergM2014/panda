<?php

declare(strict_types=1);

namespace Src;

/**
 *
 * establish DB connection
 *
 * Class DataBase
 * @package App\Core
 */
class DataBase {

    use ExceptionHandler;
    
    private static $connection;

    public static function conn(): mixed
    {

        if(is_object(value: self::$connection))  return self::$connection;

        try{
            self::$connection = new \PDO(dsn: 'mysql:dbname='.NAME_BD.';host='.HOST.'', username: USER,
                password: PASSWORD, options: [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);

            self::$connection->setAttribute(attribute: \PDO::ATTR_DEFAULT_FETCH_MODE, value: \PDO::FETCH_OBJ);

            self::$connection ->exec(statement: "SET time_zone = 'Europe/Kiev'");
            self::$connection ->exec(statement: "SET sql_mode = ''");

            if(DEBUG_MODE){
                //на время разработки
                self::$connection->setAttribute(attribute: \PDO::ATTR_ERRMODE, value: \PDO::ERRMODE_WARNING);
            }

            return self::$connection;


        }catch(\PDOException $e) {die("Ошибка соединения с базой или хостом:".$e->getMessage());}


    }


}

?>