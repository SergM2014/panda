<?php if(@$message): ?>
  <div class="alert alert-<?= @$level?? 'danger' ?> alert-dismissible fade show" role="alert">
    <?= @$message ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>