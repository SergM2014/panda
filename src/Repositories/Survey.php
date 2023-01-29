<?php

declare(strict_types=1);

namespace Src\Repositories;

use Src\DataBase;
use Src\Interfaces\SurveyRepositoryInterface;
use stdClass;

class Survey extends DataBase implements SurveyRepositoryInterface
{
    public function store(array $jsons): bool
    {
        if(!$this->checkUniqueHeader()) return false;

        try {
            $id = $this->getUserId();

            $sql = "INSERT `surveys` SET `user_id` = ?, `header` = ?, `responses` = ?, `results` = ?, `status` = ?, `created_at`= NOW()";
            $stmt = self::conn()->prepare($sql);
            $stmt->bindValue(1, $id, \PDO::PARAM_INT);
            $stmt->bindValue(2, $_POST['header'], \PDO::PARAM_STR);
            $stmt->bindValue(3, $jsons['responses'], \PDO::PARAM_STR);
            $stmt->bindValue(4, $jsons['votes'], \PDO::PARAM_STR);
            $stmt->bindValue(5, $_POST['status'], \PDO::PARAM_STR);

            if(!$stmt->execute()) return  false;
        } catch (\PDOException $ex) { 
            $this->prozessException($ex->getMessage());
        }

        return true;
    }

    //for API end point
    public function all(): array
    {
        try {
            $sql = "SELECT * FROM `surveys` ";
            $stmt = self::conn()->prepare($sql);
            $stmt->execute();
            $surveys = $stmt->fetchAll(\PDO::FETCH_OBJ);
        } catch (\PDOException $ex) { 
            $this->prozessException($ex->getMessage());
        }

        return $surveys;
    }

    public function getByUserId(?int $id = null ): array
    {
        $id??= $this->getUserId();
        try {
            $sql = "SELECT * FROM `surveys` WHERE `user_id`= ? ";
            $stmt = self::conn()->prepare($sql);
            $stmt->bindValue(1, $id, \PDO::PARAM_INT);
            $stmt->execute();
            $surveys = $stmt->fetchAll(\PDO::FETCH_OBJ);
        } catch (\PDOException $ex) { 
            $this->prozessException($ex->getMessage());
        }
        
        return $surveys;
    }

    public function delete(): bool
    {
        try {
            $sql = "DELETE FROM `surveys` WHERE `id`= ? ";
            $stmt = self::conn()->prepare($sql);
            $stmt->bindValue(1, $_POST['id'], \PDO::PARAM_INT);
            if($stmt->execute()) return true;
        } catch (\PDOException $ex) { 
            $this->prozessException($ex->getMessage());
        }
        return false;
    }

    public function getSurvey(): object
    {
        $id = $_GET['id']?? $_POST['id'];
        try {
            $sql = "SELECT `id`, `header`, `responses`, `results`, `status` FROM `surveys` WHERE `id`= ? ";
            $stmt = self::conn()->prepare($sql);
            $stmt->bindValue(1, $id, \PDO::PARAM_INT);
            $stmt->execute();
            $survey = $stmt->fetch();

            $obj = json_decode($survey->responses, true);
            $survey->responses = $obj;
            $obj = json_decode($survey->results, true);
            $survey->results = $obj;
        } catch (\PDOException $ex) { 
            $this->prozessException($ex->getMessage());
        }
        return $survey;  
    }

    public function update(array $jsons): bool
    {  
        try {
            $sql = "UPDATE `surveys` SET `header` = ?, `responses` = ?, `results` = ?, `status` = ? WHERE `id` = ?";
            $stmt = self::conn()->prepare($sql);
            $stmt->bindValue(1, $_POST['header'], \PDO::PARAM_STR);
            $stmt->bindValue(2, $jsons['responses'], \PDO::PARAM_STR);
            $stmt->bindValue(3, $jsons['votes'], \PDO::PARAM_STR);
            $stmt->bindValue(4, $_POST['status'], \PDO::PARAM_STR);
            $stmt->bindValue(5, $_POST['id'], \PDO::PARAM_INT);

            if(!$stmt->execute()) return  false;
        } catch (\PDOException $ex) { 
            $this->prozessException($ex->getMessage());
        }

        return true;
    }

    public function get(int $id): object
    {
        try {
            $sql = "SELECT * FROM `surveys` WHERE `id`= ? ";
            $stmt = self::conn()->prepare($sql);
            $stmt->bindValue(1, $id, \PDO::PARAM_INT);
            $stmt->execute();
            $survey = $stmt->fetch(\PDO::FETCH_OBJ);
        } catch (\PDOException $ex) { 
            $this->prozessException($ex->getMessage());
        }
        if($survey) return $survey;
        
        return new stdClass();
    }

   

    private function getUserId(): int
    {
        try {
            $sql = "SELECT `id` FROM `users` WHERE `email`= ? ";
            $stmt = self::conn()->prepare($sql);
            $stmt->bindValue(1, $_SESSION['admin'], \PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch();
        } catch (\PDOException $ex) { 
            $this->prozessException($ex->getMessage());
        }
        return $user->id;  
    }

    private function checkUniqueHeader(): bool
    {
        try {
            $sql = "SELECT `header` FROM `surveys` WHERE `header`= ? ";
            $stmt = self::conn()->prepare($sql);
            $stmt->bindValue(1, $_POST['header'], \PDO::PARAM_STR);
            $stmt->execute();
            $header = $stmt->fetch();
        } catch (\PDOException $ex) { 
            $this->prozessException($ex->getMessage());
        }
        if ($header) return false;

        return true;
    }
}