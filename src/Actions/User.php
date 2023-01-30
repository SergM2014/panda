<?php

declare(strict_types=1);

namespace Src\Actions;

use Src\Interfaces\AuthentificationInterface;

class User extends Controller
{
    public function __construct(private AuthentificationInterface $userRepository) {}

    public function index(): mixed
    {
        return view('index.php');
    }

    public function registerForm(): mixed
    {
        return view('registerForm.php');
    }

    public function loginForm(): mixed
    {
        return view('loginForm.php');
    }

    public function addUser(): mixed
    {     
        $this->checkCsrf();
        
        $validationErrors = $this->checkValidationError();

        if (!$this->userRepository->uniqueEmail($_POST['email'])) $validationErrors['email'] = 'Email is already used!';

        if ($validationErrors) return view ('registerForm.php', ['errors' => $validationErrors ]);
        
        $this-> userRepository->store();

        $_SESSION['admin'] = $_POST['email'];

        return view ('admin.php', ['message' => 'Greetings you are registered', 'level' => 'success' ]);
    }

    public function login(): mixed
    {
        $this->checkCsrf();
        
        $validationErrors = $this->checkValidationError();
        if ($validationErrors) return view ('loginForm.php', ['errors' => $validationErrors ]);

        $user = $this->userRepository->getUser();

        if ($user) {
            $_SESSION['admin'] = $user->email;
            return view ('admin.php', ['message' => 'Greetings you are loged in', 'level' => 'success' ]);
        }

        return view ('loginForm.php', ['message' => 'wrong credentials']);
    }

    private function checkValidationError(): array
    {
        $password = $_POST['password'];
        $email = $_POST['email'];

        $validationErrors = [];

        if (empty($email)) {
            $validationErrors['email'] = 'Input required';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $validationErrors['email'] = 'email required';
        }

        if (empty($password)) {
            $validationErrors['password'] = 'Input required';
        }
        if (strlen($password) < 6) {
            $validationErrors['password'] = 'Min 6 characters are required';
        }

        if (!empty($validationErrors)) {
            return $validationErrors;
         }

         return [];
    }

    public function logout(): mixed
    {
        unset($_SESSION['admin']);

        return view ('index.php', ['message' => 'Greetings you are logouted' ]);
    }
}