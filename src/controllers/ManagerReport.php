<?php
namespace App;
use Dao\User as User;
use Dao\WorkingHours as WorkingHours;
use Lib\Carregador as Carregador;
use Lib\DateUtils as DateUtils;
use Lib\Session as Session;
use DateTime;

Session::sessionIsValid();

class ManagerReport
{
  
  private $registros;
  public function index()
  {
    $activeUsersCount = User::getActiveUsersCount();
    $absentUsers = WorkingHours::getAbsentUsers();

    $yearAndMonth = (new DateTime())->format('Y-m');
    $seconds = WorkingHours::getWorkedTimeInMonth($yearAndMonth);
    //$hoursInMonth = explode(':', DateUtils::getTimeStringFromSeconds($seconds))[0];
    $hoursInMonth = DateUtils::getTimeStringFromSeconds($seconds);

    Carregador::loadTemplateView('manager_report', [
        'activeUsersCount' => $activeUsersCount,
        'absentUsers' => $absentUsers,
        'hoursInMonth' => $hoursInMonth,
    ]);
    
  }
}