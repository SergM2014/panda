<?php

declare(strict_types=1);

namespace Src\Repositories;

use Src\DataBase;
use Src\Interfaces\AuthentificationInterface;

class User extends DataBase implements AuthentificationInterface
{
    public function uniqueEmail(string $email): bool
    {
        if (strlen($email) < 1) return true;

        try {
            $sql = "SELECT `email`  FROM `users` WHERE `email`= ? ";
            $stmt = self::conn()->prepare($sql);
            $stmt->bindValue(1, $email, \PDO::PARAM_STR);
            $stmt->execute();
            $password = $stmt->fetch();
        } catch (\PDOException $ex) { 
            $this->prozessException($ex->getMessage());
        }
        
        return !$password;
    }

    public function store(): bool
    {
        $password= password_hash($_POST['password'], PASSWORD_DEFAULT);
        try{
            $sql = "INSERT `users` SET  `email`= ?, `password` = ?";
            $stmt =self::conn()->prepare($sql);
            $stmt->bindValue(1, $_POST['email'], \PDO::PARAM_STR);
            $stmt->bindValue(2, $password, \PDO::PARAM_STR);
            if(!$stmt->execute()) return  false;
        } catch (\PDOException $ex) { 
            $this->prozessException($ex->getMessage());
        }
       
        return true;
    }

    public  function getUser(): mixed
    {
        try {
            $sql = "SELECT `email`, `password` FROM `users` WHERE `email`= ? ";
            $stmt = self::conn()->prepare($sql);
            $stmt->bindValue(1, $_POST['email'], \PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch();
        } catch (\PDOException $ex) { 
            $this->prozessException($ex->getMessage());
        }
        if(!$user) return null;

        if (password_verify($_POST['password'], @$user->password)) return $user;

        return null;  
    }
}