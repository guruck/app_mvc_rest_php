<?php
namespace App;
use Dao\User as User;
use Lib\Carregador as Carregador;
use Lib\Utils as Utils;
use Lib\Session as Session;

Session::sessionIsValid();

class Usuarios
{
  private $exception;
  private $userData = [];

  public function index()
  {
    $this->exception = null;
    $users = User::get();
    Carregador::loadTemplateView('users', ['users' => $users,'exception' => $this->exception]);
  }

  public function novo()
  {
      $this->atualiza(0);
  }

  public function delete($id)
  {
    $this->exception = null;
    Utils::addErrorMsg('Não é possível excluir o usuario.');
    // try {
    //   User::deleteById($id);
    //   Utils::addSuccessMsg('Usuario excluído com sucesso.');
    // } catch(\Exception $e) {
    //   if(stripos($e->getMessage(), 'FOREIGN KEY')) {
    //     Utils::addErrorMsg('Não é possível excluir o usuario.');
    //   } else {
    //     $this->exception = $e;
    //   }
    // }
    header('location: /accounts');
  }

  function atualiza($id)
  {
    $this->exception = null;
    $userData = [];

    $oper = explode('/', $_GET['uri']);
    $oper = $oper[count($oper) -1] ;
    if(count($_POST) === 0 && $oper === 'edit') {
      $user = User::getOne(['id' => $id]);
      $userData = $user->getValues();
      $userData['password'] = null;
    } elseif(count($_POST) > 0) {
      try {
        $dbUser = new User($_POST);
        if($dbUser->id) {
          $dbUser->update();
          Utils::addSuccessMsg('Usuário alterado com sucesso!');
        }else {
          $dbUser->insert();
          Utils::addSuccessMsg('Usuário cadastrado com sucesso!');
        }
        header('Location: /accounts');
        exit();
        $_POST = [];
      } catch(\Exception $e) {
        $_SESSION['errors'] = $e->getErrors();
        $this->exception = $e;
        
      } finally {
        $userData = $_POST;
      }
    }
  
    Carregador::loadTemplateView('save_user', $userData + ['exception' => $this->exception ]);
  }

  public function selfpassword($id){
    if ($_SESSION['user']->id === $id) {
      $this->exception = null;
      $userData = [];
      $user = User::getOne(['id' => $id]);
      $userData = $user->getValues();
      Carregador::loadTemplateView('self_passwd',$userData + ['exception' => $this->exception ]);
    }else{
      Utils::addErrorMsg('Não tenta fazer merda...');
      header('Location: /lista');
    }
  }

  public function updateSelfPassword(){
    if ($_SESSION['user']->id === $_POST['id']) {
      $user = User::getOne(['id' => $_POST['id']]);
      $userData = $user->getValues();
      $userData['password'] = $_POST['password'];
      $userData['confirm_password'] = $_POST['confirm_password'];
      try {
        $dbUser = new User($userData);
        $dbUser->update();
        Utils::addSuccessMsg('Senha alterada com sucesso!');
        header('Location: /lista');
        exit();
        $_POST = [];
      } catch(\Exception $e) {
        $_SESSION['errors'] = $e->getErrors();
        $this->exception = $e;
      }
      Carregador::loadTemplateView('self_passwd',$userData + ['exception' => $this->exception ]);
    }else{
      Utils::addErrorMsg('Não tenta fazer merda...');
      header('Location: /lista');
    }
  }

}