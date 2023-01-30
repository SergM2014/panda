<?php

Get('/', [ \Src\Actions\User::class, 'index']);
Get('/register', [ \Src\Actions\User::class, 'registerForm']);
Post('/register', [ \Src\Actions\User::class, 'addUser']);
Get('/login', [ \Src\Actions\User::class, 'loginForm']);
Post('/login', [ \Src\Actions\User::class, 'login']);
Get('/logout', [ \Src\Actions\User::class, 'logout']);

Get('/admin', [ \Src\Actions\Survey::class, 'index']);
Get('/admin/survey/create', [ \Src\Actions\Survey::class, 'create']);
Post('/admin/survey/store', [ \Src\Actions\Survey::class, 'store']);
Get('/admin/user/survey', [ \Src\Actions\Survey::class, 'allByUser']);
Post('/admin/survey/delete', [ \Src\Actions\Survey::class, 'delete']);
Get('/admin/survey/edit', [ \Src\Actions\Survey::class, 'edit']);
Post('/admin/survey/update', [ \Src\Actions\Survey::class, 'update']);

Any('/api/surveys', [ \Src\Actions\API::class, 'all']);
Any('/api/survey/{argument}', [ \Src\Actions\API::class, 'get']);
Any('/api/user/{argument}/survey', [ \Src\Actions\API::class, 'getByUserId']);