<?php

Get(key: '/', arg: [ \Src\Actions\User::class, 'index']);
Get(key: '/register', arg: [ \Src\Actions\User::class, 'registerForm']);
Post(key: '/register', arg: [ \Src\Actions\User::class, 'addUser']);
Get(key: '/login', arg: [ \Src\Actions\User::class, 'loginForm']);
Post(key: '/login', arg: [ \Src\Actions\User::class, 'login']);
Get(key: '/logout', arg: [ \Src\Actions\User::class, 'logout']);

Get(key: '/admin', arg: [ \Src\Actions\Survey::class, 'index']);
Get(key: '/admin/survey/create', arg: [ \Src\Actions\Survey::class, 'create']);
Post(key: '/admin/survey/store', arg: [ \Src\Actions\Survey::class, 'store']);
Get(key: '/admin/user/survey', arg: [ \Src\Actions\Survey::class, 'allByUser']);
Post(key: '/admin/survey/delete', arg: [ \Src\Actions\Survey::class, 'delete']);
Get(key: '/admin/survey/edit', arg: [ \Src\Actions\Survey::class, 'edit']);
Post(key: '/admin/survey/update', arg: [ \Src\Actions\Survey::class, 'update']);

Any(key: '/api/surveys', arg: [ \Src\Actions\API::class, 'all']);
Any(key: '/api/survey/{argument}', arg: [ \Src\Actions\API::class, 'get']);
Any(key: '/api/user/{argument}/survey', arg: [ \Src\Actions\API::class, 'getByUserId']);