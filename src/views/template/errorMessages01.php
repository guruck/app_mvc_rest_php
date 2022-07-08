
<?php if(isset($_SESSION['error'])): ?>
  <div class="erros">
      <p><?= $_SESSION['error'] ?></p>
  </div>
<?php endif ?>