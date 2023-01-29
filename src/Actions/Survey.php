<?php

declare(strict_types=1);

namespace Src\Actions;

use Src\Interfaces\SurveyRepositoryInterface;

class Survey extends Controller
{
    public function __construct(private SurveyRepositoryInterface $repository)
    {
        if(!isset($_SESSION['admin'])) redirectToIndexPage();
    }

    public function index(): mixed
    {
        $this->preventRepeatedAlert();

        return view ('admin.php');
    }

    public function create():mixed
    {
        return view ('createSurvey.php');
    }

    public function store(): mixed
    {
        $this->checkCsrf();

        $validationErrors = $this->checkValidationError();

        if (!empty($validationErrors)) return view ('createSurvey.php', ['errors' => $validationErrors ]);

        $jsons = $this->getResponsesWithVotes();

        if($this->repository->store($jsons))  return view ('admin.php', ['message' => 'A new Survey was created', 'level' =>'success']);

        return view ('createSurvey.php', ['message' => 'creation of new Survay is failed' ]);
    }

    public function allByUser(): void
    {
        echo json_encode($this->repository->getByUserId());
    }

    public function delete(): bool
    {
        $this->checkCsrf();
        
        if ($this->repository->delete()) return true;

        return false;
    }

    public function edit():mixed
    {
        $survey = $this->repository->getSurvey(); 

        return view ('editSurvey.php', ['survey' => $survey]);
    }

    public function update()
    {
        $this->checkCsrf();

        $validationErrors = $this->checkValidationError();

        if (!empty($validationErrors)){
            $survey = $this->repository->getSurvey();
            return view ('editSurvey.php', ['survey' => $survey, 'errors' => $validationErrors ]);
        } 

        $jsons = $this->getResponsesWithVotes();

        if($this->repository->update($jsons))  return view ('admin.php', [
            'message' => 'the Survey#'.$_POST['id'] .' was updated', 'level' =>'success'
        ]);

        return view ('editSurvey.php', ['message' => 'update of  Survay is failed' ]);
    }

    private function checkValidationError(): array
    {

        $header = $_POST['header'];
        $responses = array_filter($_POST['response']);

        $validationErrors = [];

        if (empty($header)) {
            $validationErrors['header'] = 'Input required';
        }
        if (empty($responses)) {
            $validationErrors['response'] = 'Input required';
        }
        if (!$this->checkOnlyNumber()) {
                $validationErrors['vote']= 'Only integers ere required'; 
            }
        
        return $validationErrors;    
    }

    private function getResponsesWithVotes()
    {
        $responseArr = [];
        foreach ($_POST['response'] as $key => $value) {
            if(strlen($value) > 0) $responseArr[$key] = $value;
        }
        $keys = array_keys($responseArr);

        $voteArr = [];
        foreach ($_POST['vote'] as $key => $value) {
            if(in_array($key, $keys)) $voteArr[$key] = (int)$value;
        }
        $responseArr = array_values($responseArr);
        $voteArr = array_values($voteArr);

        $arr = [];
        $arr['responses'] = json_encode($responseArr, JSON_FORCE_OBJECT);
        $arr['votes'] = json_encode($voteArr, JSON_FORCE_OBJECT);

        return $arr;
    }

    private function checkOnlyNumber(): bool
    {
        foreach ($_POST['vote'] as $vote) {
            if(strlen($vote) < 1)  $vote = 0; 
            if(!is_int((int)$vote)) return false;
        }

        return true;
    }

    private function preventRepeatedAlert(): mixed
    {
        if(isset($_SESSION['id']) AND isset($_GET['id']) AND $_SESSION['id'] == $_GET['id']) return view ('admin.php');
        if(isset($_GET['delete']))  { 
            $_SESSION['id'] = $_GET['id'];
            return view ('admin.php', [
                'message'=> 'The Survey#'.$_GET['id'].' was deleted!',
                'level' => 'success'
            ]);
        }
        return view ('admin.php');
    }
}