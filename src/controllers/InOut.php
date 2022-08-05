<?php
namespace App;
use Dao\User as User;
use Dao\WorkingHours as WorkingHours;
use Lib\Carregador as Carregador;
use Lib\Utils as Utils;
use Lib\Session as Session;

Session::sessionIsValid();

class InOut
{
  
  private $registros;
  public function registra()
  {
    $user = $_SESSION['user'];
    $userWw = WorkingHours::loadFromUserAndDate($user->id, date('Y-m-d'));
    try {
      $currentTime = strftime('%H:%M:%S',time());
  
      if(isset($_POST['forcedTime'])){
        $currentTime = $_POST['forcedTime'];
      }
  
      $userWw->innout($currentTime);
      
      Utils::addSuccessMsg('Ponto inserido com sucesso!');
    } catch (AppException $e) {
      Utils::addErrorMsg($e->getMessage());
    }
    header('Location: '.route('urecords'));
  }
  
}