<?php
namespace Lib;

class Session{
  function sessionIsValid($requiresAdmin = false){
    $user = $_SESSION['user'];
    if(!isset($user)) {
        header('Location: /login');
        exit();
    } elseif($requiresAdmin && !$user->is_admin) {
        Utils::addErrorMsg('Acesso negado!');
        header('Location: /');
        exit();
    }
  }
}