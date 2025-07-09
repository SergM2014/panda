<?php

declare(strict_types=1);

namespace Src\Actions;

use Src\Interfaces\AuthentificationInterface;

class User extends Controller
{
    public function __construct(private AuthentificationInterface $userRepository) {}

    public function index(): void
    {
        view(view: 'index.php');
    }

    public function registerForm(): void
    {
        view(view: 'registerForm.php');
    }

    public function loginForm(): void
    {
        view(view: 'loginForm.php');
    }

    public function addUser(): void
    {     
        $this->checkCsrf();
        
        $validationErrors = $this->checkValidationError();

        if (!$this->userRepository->uniqueEmail(email: $_POST['email'])) $validationErrors['email'] = 'Email is already used!';

        if ($validationErrors) {
            view (view: 'registerForm.php', args: ['errors' => $validationErrors ]);
            return;
        }
        $this-> userRepository->store();

        $_SESSION['admin'] = $_POST['email'];

        view (view: 'admin.php', args: ['message' => 'Greetings you are registered', 'level' => 'success' ]);
    }

    public function login(): void
    {
        $this->checkCsrf();
        
        $validationErrors = $this->checkValidationError();
        if ($validationErrors) {
            view (view: 'loginForm.php', args: ['errors' => $validationErrors ]);
            return;
        }
        $user = $this->userRepository->getUser();

        if ($user) {
            $_SESSION['admin'] = $user->email;
            view (view: 'admin.php', args: ['message' => 'Greetings you are loged in', 'level' => 'success' ]);
            return;
        }

        view (view: 'loginForm.php', args: ['message' => 'wrong credentials']);
    }

    private function checkValidationError(): array
    {
        $password = $_POST['password'];
        $email = $_POST['email'];

        $validationErrors = [];

        if (empty($email)) $validationErrors['email'] = 'Input required';
        
        if (!filter_var(value: $email, filter: FILTER_VALIDATE_EMAIL)) $validationErrors['email'] = 'email required';
        
        if (empty($password)) $validationErrors['password'] = 'Input required';
        
        if (strlen(string: $password) < 6) $validationErrors['password'] = 'Min 6 characters are required';

        if (!empty($validationErrors)) return $validationErrors;

        return [];
    }

    public function logout(): void
    {
        unset($_SESSION['admin']);

        view (view: 'index.php', args: ['message' => 'Greetings you are logouted' ]);
    }
}