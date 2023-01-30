<?php
require_once "templates/header.php";
?>
<h1 class="text-center">Register Form</h1>

<?php require_once "partials/alert.php" ?>

<?php  if(@$_POST['email']) $encodedPostEmail = htmlspecialchars($_POST['email'], ENT_QUOTES, "UTF-8"); ?>

<form action="/register" method="POST">
  <input type="hidden" value="<?= $_SESSION['token'] ?>" name="token" >
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="text" class="form-control <?= @$errors['email']? 'is-invalid' : '' ?>" id="email" name="email"
      placeholder="email"  maxlength="25" autofocus value="<?= @$encodedPostEmail ?>">
      <div class="invalid-feedback"><?= @$errors['email'] ?> </div>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control <?= @$errors['password']? 'is-invalid' : '' ?>" id="password" name="password"
       maxlength="25" placeholder="password" autofocus >
       <div class="invalid-feedback"><?= @$errors['password'] ?> </div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
require_once "templates/footer.php";

