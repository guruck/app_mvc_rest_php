<?php
namespace App;
use Dao\Login as LoginDao;
use Lib\Carregador as Carregador;

class Login
{
  private $exception;

  public function entrar()
  {
    $this->exception = null;

    if(count($_POST)){
      $login = new LoginDao(['email'=>$_POST['email'],'password'=>$_POST['password']]);
      
      try {
        $user = $login->checkLogin();
        unset($user->password);
        $_SESSION['user'] = $user;
        header('location: /');
      } catch (\Exception $th) {
        $this->exception = $th;
      }
    }
    Carregador::loadView('login',$_POST + ['exception' => $this->exception]);
  }

  public function sair(){
    session_destroy();
    header('Location: /login');
  }

}