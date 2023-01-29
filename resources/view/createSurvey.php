<?php
require_once "templates/header.php";
?>
<h1 class="text-center">Admin</h1>
<h2><?= @$message ?></h2>

<?php require_once "partials/alert.php" ?>

<?php  
   if(@$_POST['header']) $encodedPostHeader = htmlspecialchars($_POST['header'], ENT_QUOTES, "UTF-8");
   if(@$_POST['response']) $encodedPostResponse = array_map('htmlspecialchars', $_POST['response']);
   if(@$_POST['vote']) $encodedPostVote = array_map('htmlspecialchars', $_POST['vote']);
?>

<form action="/admin/survey/store" method="POST">
  <input type="hidden" value="<?= $_SESSION['token'] ?>" name="token" >
  <div class="mb-3">
    <input type="hidden" value="">
    <label for="header" class="form-label">Header</label>
    <input type="text" class="form-control <?= @$errors['header']? 'is-invalid' : '' ?>" id="header" name="header"
       maxlength="25" placeholder="header" autofocus  value="<?= @$encodedPostHeader?>">
       <div class="invalid-feedback"><?= @$errors['header'] ?> </div>
       
  </div>
  <div class="row">
    <div class="col-9">
      <label  class="form-label">Response</label>
    
          <input type="text" name="response[]" class="form-control <?= @$errors['response']? 'is-invalid' : '' ?>"
          placeholder="Response" value="<?= @$encodedPostResponse[0] ?>" >
          <div class="invalid-feedback"><?= @$errors['response'] ?> </div>
    </div>
    <div class="col-3">
    <label  class="form-label">Votes</label>
          <input type="text" name="vote[]" class="form-control <?= @$errors['vote']? 'is-invalid' : '' ?>" 
          placeholder="Votes" value="<?= @$encodedPostVote[0] ?>">
      
      <div class="invalid-feedback"><?= @$errors['vote'] ?> </div>
    </div>
  </div>
  <div class="row">
    <div class="col-9">
      <label  class="form-label">Response</label>
    
          <input type="text" name="response[]" class="form-control <?= @$errors['response']? 'is-invalid' : '' ?>"
          placeholder="Response" value="<?= @$encodedPostResponse[1] ?>" >
          <div class="invalid-feedback"><?= @$errors['response'] ?> </div>
    </div>
    <div class="col-3">
    <label  class="form-label">Votes</label>
          <input type="text" name="vote[]" class="form-control <?= @$errors['vote']? 'is-invalid' : '' ?>" 
          placeholder="Votes" value="<?= @$encodedPostVote[1] ?>">
      
      <div class="invalid-feedback"><?= @$errors['vote'] ?> </div>
    </div>
  </div>
  <div class="row">
    <div class="col-9">
      <label  class="form-label">Response</label>
    
          <input type="text" name="response[]" class="form-control <?= @$errors['response']? 'is-invalid' : '' ?>"
          placeholder="Response" value="<?= @$encodedPostResponse[2] ?>" >
          <div class="invalid-feedback"><?= @$errors['response'] ?> </div>
    </div>
    <div class="col-3">
    <label  class="form-label">Votes</label>
          <input type="text" name="vote[]" class="form-control <?= @$errors['vote']? 'is-invalid' : '' ?>" 
          placeholder="Votes" value="<?= @$encodedPostVote[2] ?>">
      
      <div class="invalid-feedback"><?= @$errors['vote'] ?> </div>
    </div>
  </div>
  <div class="row">
    <div class="col-9">
      <label  class="form-label">Response</label>
    
          <input type="text" name="response[]" class="form-control <?= @$errors['response']? 'is-invalid' : '' ?>"
          placeholder="Response" value="<?= @$encodedPostResponse[3] ?>" >
          <div class="invalid-feedback"><?= @$errors['response'] ?> </div>
    </div>
    <div class="col-3">
    <label  class="form-label">Votes</label>
          <input type="text" name="vote[]" class="form-control <?= @$errors['vote']? 'is-invalid' : '' ?>" 
          placeholder="Votes" value="<?= @$encodedPostVote[3] ?>">
      
      <div class="invalid-feedback"><?= @$errors['vote'] ?> </div>
    </div>
  </div>
  <div class="row">
    <div class="col-9">
      <label  class="form-label">Response</label>
    
          <input type="text" name="response[]" class="form-control <?= @$errors['response']? 'is-invalid' : '' ?>"
          placeholder="Response" value="<?= @$encodedPostResponse[4] ?>" >
          <div class="invalid-feedback"><?= @$errors['response'] ?> </div>
    </div>
    <div class="col-3">
    <label  class="form-label">Votes</label>
          <input type="text" name="vote[]" class="form-control <?= @$errors['vote']? 'is-invalid' : '' ?>" 
          placeholder="Votes" value="<?= @$encodedPostVote[4] ?>">
      
      <div class="invalid-feedback"><?= @$errors['vote'] ?> </div>
    </div>
  </div>
  <div class="row">
    <div class="col-9">
      <label  class="form-label">Response</label>
    
          <input type="text" name="response[]" class="form-control <?= @$errors['response']? 'is-invalid' : '' ?>"
          placeholder="Response" value="<?= @$encodedPostResponse[5] ?>" >
          <div class="invalid-feedback"><?= @$errors['response'] ?> </div>
    </div>
    <div class="col-3">
    <label  class="form-label">Votes</label>
          <input type="text" name="vote[]" class="form-control <?= @$errors['vote']? 'is-invalid' : '' ?>" 
          placeholder="Votes" value="<?= @$encodedPostVote[5] ?>">
      
      <div class="invalid-feedback"><?= @$errors['vote'] ?> </div>
    </div>
  </div>
  <div class="row">
    <div class="col-9">
      <label  class="form-label">Response</label>
    
          <input type="text" name="response[]" class="form-control <?= @$errors['response']? 'is-invalid' : '' ?>"
          placeholder="Response" value="<?= @$encodedPostResponse[6] ?>" >
          <div class="invalid-feedback"><?= @$errors['response'] ?> </div>
    </div>
    <div class="col-3">
    <label  class="form-label">Votes</label>
          <input type="text" name="vote[]" class="form-control <?= @$errors['vote']? 'is-invalid' : '' ?>" 
          placeholder="Votes" value="<?= @$encodedPostVote[6] ?>">
      
      <div class="invalid-feedback"><?= @$errors['vote'] ?> </div>
    </div>
  </div>

  <?php  $status = $_POST['status']?? 'draft' ?>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="status" id="statusField" value="draft" 
    <?= $status == 'draft'? 'checked': '' ?> >
    <label class="form-check-label" for="flexRadioDefault1">
        Draft
  </label>
    </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="status" id="statusField" value="published"
    <?= $status == 'published'? 'checked': '' ?> >
    <label class="form-check-label" for="flexRadioDefault2">
    Published
    </label>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php
require_once "templates/footer.php";
