<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <meta name="csrf-token" content="<?= @$_SESSION['token'] ?>">
    <title>Fake Survey</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">

</head>
<body>

    <div id="app" class="container">
        <div class="list-group list-group-horizontal">
            <?php if (isset($_SESSION['admin'])) : ?>
                <a class="ms-2" href="/logout">Logout</a>
                <a class="ms-2" href="/admin">Back to main admin page</a>
            <?php else: ?>
                <a class="ms-2" href="/register">Register</a>
                <a class="ms-2" href="/login">Login</a>
            <?php endif; ?>
        </div>