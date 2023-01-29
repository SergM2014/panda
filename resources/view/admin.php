<?php
require_once "templates/header.php";
?>
<h1 class="text-center">Admin</h1>

<?php require_once "partials/alert.php" ?>

<div class="row mb-3">
    <a class="btn btn-primary" href="/admin/survey/create" class="link-success">Create a new survey</a>
</div>
<table id="table1">
    <thead>
        <tr>
            <th>Id</th>
            <th>Header</th>
            <th>Responses</th>
            <th>Results</th>
            <th>Status</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
</table>

<?php
require_once "templates/footer.php";
