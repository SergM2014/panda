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

    public function index(): void
    {
        $this->preventRepeatedAlert();
        view (view: 'admin.php');
    }

    public function create(): void
    {
         view (view: 'createSurvey.php');
    }

    public function store(): void
    {
        $this->checkCsrf();

        $validationErrors = $this->checkValidationError();

        if (!empty($validationErrors)) {
            view (view: 'createSurvey.php', args: ['errors' => $validationErrors ]);
            return;
        }

        $jsons = $this->getResponsesWithVotes();

        if($this->repository->store(jsons: $jsons)) { 
            view (view: 'admin.php', args: ['message' => 'A new Survey was created', 'level' =>'success']);
            return;
        }

        view (view: 'createSurvey.php', args: ['message' => 'creation of new Survay is failed' ]);
    }

    public function allByUser(): void
    {
        echo json_encode(value: $this->repository->getByUserId());
    }

    public function delete(): bool
    {
        $this->checkCsrf();
        
        if ($this->repository->delete()) return true;

        return false;
    }

    public function edit(): void
    {
        $survey = $this->repository->getSurvey(); 

        view (view: 'editSurvey.php', args: ['survey' => $survey]);
    }

    public function update(): void
    {
        $this->checkCsrf();

        $validationErrors = $this->checkValidationError();

        if (!empty($validationErrors)) {
            $survey = $this->repository->getSurvey();
            view (view: 'editSurvey.php', args: ['survey' => $survey, 'errors' => $validationErrors ]);
            return;
        } 

        $jsons = $this->getResponsesWithVotes();

        if($this->repository->update(jsons: $jsons)) { 
            view (view: 'admin.php', args: [
            'message' => 'the Survey#'.$_POST['id'] .' was updated', 'level' =>'success'
            ]);
        return;
        }

        view (view: 'editSurvey.php', args: ['message' => 'update of  Survay is failed' ]);
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

    private function getResponsesWithVotes(): array
    {
        $responseArr = [];
        foreach ($_POST['response'] as $key => $value) {
            if(strlen(string: $value) > 0) $responseArr[$key] = $value;
        }
        $keys = array_keys(array: $responseArr);

        $voteArr = [];
        foreach ($_POST['vote'] as $key => $value) {
            if(in_array(needle: $key, haystack: $keys)) $voteArr[$key] = (int)$value;
        }
        $responseArr = array_values(array: $responseArr);
        $voteArr = array_values(array: $voteArr);

        $arr = [];
        $arr['responses'] = json_encode(value: $responseArr, flags: JSON_FORCE_OBJECT);
        $arr['votes'] = json_encode(value: $voteArr, flags: JSON_FORCE_OBJECT);

        return $arr;
    }

    private function checkOnlyNumber(): bool
    {
        foreach ($_POST['vote'] as $vote) {
            if(strlen(string: $vote) < 1)  $vote = 0; 
            if(!is_int(value: (int)$vote)) return false;
        }

        return true;
    }

    private function preventRepeatedAlert(): void
    {
        if(isset($_SESSION['id']) AND isset($_GET['id']) AND $_SESSION['id'] == $_GET['id']) {
            view (view: 'admin.php');
            return;
            }

        if(isset($_GET['delete']))  { 
            $_SESSION['id'] = $_GET['id'];
            view (view: 'admin.php', args: [
                'message'=> 'The Survey#'.$_GET['id'].' was deleted!',
                'level' => 'success'
            ]);
            return;
        }
        view (view: 'admin.php');
    }
}