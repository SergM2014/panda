<?php

declare(strict_types=1);

namespace Src\Repositories;

use Src\DataBase;
use Src\Interfaces\AuthentificationInterface;

class User extends DataBase implements AuthentificationInterface
{
    public function uniqueEmail(string $email): bool
    {
        if (strlen(string: $email) < 1) return true;

        try {
            $sql = "SELECT `email`  FROM `users` WHERE `email`= ? ";
            $stmt = self::conn()->prepare($sql);
            $stmt->bindValue(1, $email, \PDO::PARAM_STR);
            $stmt->execute();
            $password = $stmt->fetch();
        } catch (\PDOException $ex) { 
            $this->prozessException(messageToLog: $ex->getMessage());
        }
        
        return !$password;
    }

    public function store(): bool
    {
        $password= password_hash(password: $_POST['password'], algo: PASSWORD_DEFAULT);
        try{
            $sql = "INSERT `users` SET  `email`= ?, `password` = ?";
            $stmt =self::conn()->prepare($sql);
            $stmt->bindValue(1, $_POST['email'], \PDO::PARAM_STR);
            $stmt->bindValue(2, $password, \PDO::PARAM_STR);
            if(!$stmt->execute()) return  false;
        } catch (\PDOException $ex) { 
            $this->prozessException(messageToLog: $ex->getMessage());
        }
       
        return true;
    }

    public  function getUser(): null|object 
    {
        try {
            $sql = "SELECT `email`, `password` FROM `users` WHERE `email`= ? ";
            $stmt = self::conn()->prepare($sql);
            $stmt->bindValue(1, $_POST['email'], \PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch();
        } catch (\PDOException $ex) { 
            $this->prozessException(messageToLog: $ex->getMessage());
        }
        if(!$user) return null;

        if (password_verify(password: $_POST['password'], hash: @$user->password)) return $user;

        return null;  
    }
}