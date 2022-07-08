<?php
  $message = null;
  $errors = [];
  if (isset($_SESSION['message'])){
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
  }elseif (isset($exception)){
    
    $message = [
      'type' => 'error',
      'message' => $exception->getMessage()
    ];
    
    if  (get_class($exception) === 'Errors\ValidationException') {
      $errors = $exception->getErrors();
    }; 
  }
  $alertType = '';
  if ($message['type'] === 'error'){
    $alertType = 'danger';
  } else {
    $alertType = 'success';
  }

  
?>
<?php if(isset($message)): ?>
  <div id="alert" class="my-3 alert alert-<?= $alertType ?>" role="alert">
    <?=  $message['message'] ?>
  </div>
<?php endif ?>