<?php

$routes = [
    '/' => [ \Src\Actions\User::class, 'index'],
    '/register' => [ \Src\Actions\User::class, 'registerForm'],
    '/addUser' => [ \Src\Actions\User::class, 'addUser'],
    '/login' => [ \Src\Actions\User::class, 'loginForm'],
    '/getUser' => [ \Src\Actions\User::class, 'getUser'],
    '/logout' => [ \Src\Actions\User::class, 'logout'],

    '/admin' => [ \Src\Actions\Survey::class, 'index'],
    '/admin/survey/create' => [ \Src\Actions\Survey::class, 'create'],
    '/admin/survey/store' => [ \Src\Actions\Survey::class, 'store'],
    '/admin/user/survey' => [ \Src\Actions\Survey::class, 'allByUser'],
    '/admin/survey/delete' => [ \Src\Actions\Survey::class, 'delete'],
    '/admin/survey/edit' => [ \Src\Actions\Survey::class, 'edit'], 
    '/admin/survey/update' => [ \Src\Actions\Survey::class, 'update'], 

    '/api/survey/{argument}' => [ \Src\Actions\API::class, 'get'],
    '/api/surveys' => [ \Src\Actions\API::class, 'all'],
    '/api/user/{argument}/survey' => [ \Src\Actions\API::class, 'getByUserId'],
];