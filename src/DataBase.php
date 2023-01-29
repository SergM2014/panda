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

    public static function conn()
    {

        if(is_object(self::$connection))  return self::$connection;

        try{
            self::$connection = new \PDO('mysql:dbname='.NAME_BD.';host='.HOST.'', USER,
                PASSWORD, [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);

            self::$connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);

            self::$connection ->exec("SET time_zone = 'Europe/Kiev'");
            self::$connection ->exec("SET sql_mode = ''");

            if(DEBUG_MODE){
                //на время разработки
                self::$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
            }

            return self::$connection;


        }catch(\PDOException $e) {die("Ошибка соединения с базой или хостом:".$e->getMessage());}


    }


}

?>