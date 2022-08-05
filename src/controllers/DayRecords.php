<?php
namespace App;
use Dao\User as User;
use Lib\Carregador as Carregador;
use Lib\Utils as Utils;
use Lib\Session as Session;

Session::sessionIsValid();

class DayRecords
{
  
  private $registros;
  public function index()
  {
    $date = (new \Datetime())->getTimestamp();
    $today = strftime('%d de %B de %Y',$date);
    Carregador::loadTemplateView('day_records', ['today'=>$today]);
  }
  
}