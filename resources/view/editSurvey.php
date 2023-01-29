<?php
require_once "templates/header.php";
?>
<h1 class="text-center">Admin</h1>
<h2><?= @$message ?></h2>
<h2>Edit form </h2>
<?php require_once "partials/alert.php" ?>

<?php  
   if(@$_POST['header']) $encodedPostHeader = htmlspecialchars($_POST['header'], ENT_QUOTES, "UTF-8");
   if(@$_POST['response']) $encodedPostResponse = array_map('htmlspecialchars', $_POST['response']);
   if(@$_POST['vote']) $encodedPostVote = array_map('htmlspecialchars', $_POST['vote']);
?>

<form action="/admin/survey/update" method="POST">
  <input type="hidden" value="<?= $_SESSION['token'] ?>" name="token" >
  <input type="hidden" name="id" value="<?= $survey->id ?>" >
  <div class="mb-3">
    <label for="header" class="form-label">Header</label>
    <input type="text" class="form-control <?= @$errors['header']? 'is-invalid' : '' ?>" id="header" name="header"
       maxlength="25" placeholder="header" autofocus  value="<?= @$encodedPostHeader?? $survey->header ?>">
       <div class="invalid-feedback"><?= @$errors['header'] ?> </div>
       
  </div>

<?php
   
foreach ($survey->responses as $key => $value ): ?> 
    <div class="row">
    <div class="col-9">
      <label  class="form-label">Response</label>
    
          <input type="text" name="response[]" class="form-control <?= @$errors['response']? 'is-invalid' : '' ?>"
          placeholder="Response" value="<?= @$encodedPostResponse[$key]?? $value ?>" >
          <div class="invalid-feedback"><?= @$errors['response'] ?> </div>
    </div>
    <div class="col-3">
    <label  class="form-label">Votes</label>
          <input type="text" name="vote[]" class="form-control <?= @$errors['vote']? 'is-invalid' : '' ?>" 
          placeholder="Votes" value="<?= @$encodedPostVote[$key]?? $survey->results[$key] ?>">
      
      <div class="invalid-feedback"><?= @$errors['vote'] ?> </div>
    </div>
  </div>

<?php endforeach; ?>

<div class="row">
    <div class="col-9">
      <label  class="form-label">Response</label>
    
          <input type="text" name="response[]" class="form-control <?= @$errors['response']? 'is-invalid' : '' ?>"
          placeholder="Response" value="<?= @$encodedPostResponse[1000] ?>" >
          <div class="invalid-feedback"><?= @$errors['response'] ?> </div>
    </div>
    <div class="col-3">
    <label  class="form-label">Votes</label>
          <input type="text" name="vote[]" class="form-control <?= @$errors['vote']? 'is-invalid' : '' ?>" 
          placeholder="Votes" value="<?= @$encodedPostVote[1000] ?>">
      
      <div class="invalid-feedback"><?= @$errors['vote'] ?> </div>
    </div>
  </div>
  <div class="row">
    <div class="col-9">
      <label  class="form-label">Response</label>
    
          <input type="text" name="response[]" class="form-control <?= @$errors['response']? 'is-invalid' : '' ?>"
          placeholder="Response" value="<?= @$encodedPostResponse[1001] ?>" >
          <div class="invalid-feedback"><?= @$errors['response'] ?> </div>
    </div>
    <div class="col-3">
    <label  class="form-label">Votes</label>
          <input type="text" name="vote[]" class="form-control <?= @$errors['vote']? 'is-invalid' : '' ?>" 
          placeholder="Votes" value="<?= @$encodedPostVote[1002] ?>">
      
      <div class="invalid-feedback"><?= @$errors['vote'] ?> </div>
    </div>
  </div>
  <div class="row">
    <div class="col-9">
      <label  class="form-label">Response</label>
    
          <input type="text" name="response[]" class="form-control <?= @$errors['response']? 'is-invalid' : '' ?>"
          placeholder="Response" value="<?= @$encodedPostResponse[1003] ?>" >
          <div class="invalid-feedback"><?= @$errors['response'] ?> </div>
    </div>
    <div class="col-3">
    <label  class="form-label">Votes</label>
          <input type="text" name="vote[]" class="form-control <?= @$errors['vote']? 'is-invalid' : '' ?>" 
          placeholder="Votes" value="<?= @$encodedPostVote[1003] ?>">
      
      <div class="invalid-feedback"><?= @$errors['vote'] ?> </div>
    </div>
  </div>
  <div class="row">
    <div class="col-9">
      <label  class="form-label">Response</label>
    
          <input type="text" name="response[]" class="form-control <?= @$errors['response']? 'is-invalid' : '' ?>"
          placeholder="Response" value="<?= @$encodedPostResponse[1004] ?>" >
          <div class="invalid-feedback"><?= @$errors['response'] ?> </div>
    </div>
    <div class="col-3">
    <label  class="form-label">Votes</label>
          <input type="text" name="vote[]" class="form-control <?= @$errors['vote']? 'is-invalid' : '' ?>" 
          placeholder="Votes" value="<?= @$encodedPostVote[1004] ?>">
      
      <div class="invalid-feedback"><?= @$errors['vote'] ?> </div>
    </div>
  </div>

  

  
<?php  $status = $_POST['status']?? $survey->status ?>
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

  <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php
require_once "templates/footer.php";
