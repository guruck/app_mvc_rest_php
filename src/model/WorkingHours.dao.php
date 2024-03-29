<?php
namespace Dao;
use Lib\Database as Database;
use Lib\DateUtils as DateUtils;
use Errors\AppException as AppException;
use Errors\ValidationException as ValidationException;
use \DateInterval;
use \DateTime;
use \PDO;


class WorkingHours extends Model{
  protected static $tableName = '`working_hours`';
  protected static $columns = ['id', 'user_id', 'work_date', 'time1', 'time2', 'time3', 'time4','worked_time'];

  public static function loadFromUserAndDate($userId, $workDate){
    $registry = self::getOne(['user_id' => $userId, 'work_date' => $workDate]);
    //var_dump($registry->length).die();
    if($registry->id===null) {
      $registry = new WorkingHours([
        'user_id' => $userId, 'work_date' => $workDate,'worked_time' => 0, 
        'time1'=>null, 'time2'=>null, 'time3'=>null, 'time4'=>null
      ]);
      // echo "ops";
    }
    return $registry;
  }

  public function getNextTime(){
    if(!$this->time1) return 'time1';
    if(!$this->time2) return 'time2';
    if(!$this->time3) return 'time3';
    if(!$this->time4) return 'time4';
    return null;
  }

  public function getActiveClock(){
    $nextTime = $this->getNextTime();
    if ($nextTime === 'time1' || $nextTime === 'time3'){
      return 'exitTime';
    }elseif ($nextTime === 'time2' || $nextTime === 'time4'){
      return 'workedInterval';
    }else{
      return null;
    }
  }

  public function innout($time){
    $timeColumn = $this->getNextTime();
    if(!$timeColumn){
      throw new AppException("Registros já realizados no dia!");
    }
    $this->$timeColumn = $time;
    $this->worked_time = DateUtils::getSecondsFromDateInterval($this->getWorkedInterval());
    if($this->id){
      $this->update();
    }else{
      $this->insert();
    }
  }

  function getWorkedInterval(){
    [$t1, $t2, $t3, $t4] = $this->getTimes();

    $part1 = new DateInterval('PT0S');
    $part2 = new DateInterval('PT0S');

    if($t1) $part1 = $t1->diff(new DateTime());
    if($t2) $part1 = $t1->diff($t2);
    if($t3) $part2 = $t3->diff(new DateTime());
    if($t4) $part2 = $t3->diff($t4);

    return DateUtils::sumIntervals($part1,$part2);
  }

  function getLunchInterval(){
    [, $t2, $t3,] = $this->getTimes();

    $lunchInterval = new DateInterval('PT0S');

    if($t2) $lunchInterval = $t2->diff(new DateTime());
    if($t3) $lunchInterval = $t2->diff($t3);

    return $lunchInterval;
  }

  function getExitTime(){
    [$t1, , , $t4] = $this->getTimes();
    $workday = DateInterval::createFromDateString('8 hours');
    // $breakInterval = new DateInterval('PT1H');
    
    if(!$t1){
      return (new DateTimeImmutable())->add($workday);//->add($breakInterval);
    } elseif ($t4){
      return $t4;
    }else{
      $total = DateUtils::sumIntervals($workday, $this->getLunchInterval());
      return $t1->add($total);
    }

  }

  function getBalance(){
    if(!$this->time1 && !DateUtils::isPastWorkday($this->work_date)) return '-';
    if($this->worked_time == DAILY_TIME) return '-';
    $balance = $this->worked_time - DAILY_TIME;
    $balanceStr = DateUtils::getTimeStringFromSeconds(abs($balance));
    $sign = ($this->worked_time > DAILY_TIME) ? '+' : '-';
    return "{$sign}{$balanceStr}";
  }

  public static function getAbsentUsers() {
    $today = new DateTime();
    $result = Database::getResultFromQuery("
        SELECT name FROM users
        WHERE end_date is NULL
        AND id NOT IN (
            SELECT user_id FROM working_hours
            WHERE work_date = '{$today->format('Y-m-d')}'
            AND time1 IS NOT NULL
        )
    ");
    $revela = $result->fetchAll(PDO::FETCH_ASSOC);

    $absentUsers = [];
    if(count($revela) > 0) {
        foreach ($revela as $key => $value) {
          array_push($absentUsers, $value['name']);
        }
    }

    return $absentUsers;
  }

  public static function getWorkedTimeInMonth($yearAndMonth) {
    $startDate = (new DateTime("{$yearAndMonth}-1"))->format('Y-m-d');
    $endDate = DateUtils::getLastDayOfMonth($yearAndMonth)->format('Y-m-d');
    $result = static::getResultSetFromSelect([
        'raw' => "work_date BETWEEN '{$startDate}' AND '{$endDate}'"
    ], "sum(worked_time) as sum");
    return $result->fetch(PDO::FETCH_ASSOC)['sum'];
  }

  public static function getMonthlyReport($userId, $date){
    $regs = [];
    $start = DateUtils::getFirstDayOfMonth($date)->format('Y-m-d');
    $ends = DateUtils::getLastDayOfMonth($date)->format('Y-m-d');

    $result = static::getResultSetFromSelect([
      'user_id'=>$userId, 
      'raw'=>"work_date between '{$start}' AND '{$ends}'"
    ]);

    if($result){
      while($row = $result->fetch(PDO::FETCH_ASSOC)){
        $regs[$row['work_date']] = new WorkingHours($row);
      }
    }

    return $regs;
  }

  private function getTimes(){
    $times = [];

    $this->time1 ? array_push($times,DateUtils::stringToDate($this->time1)) : array_push($times,null);
    $this->time2 ? array_push($times,DateUtils::stringToDate($this->time2)) : array_push($times,null);
    $this->time3 ? array_push($times,DateUtils::stringToDate($this->time3)) : array_push($times,null);
    $this->time4 ? array_push($times,DateUtils::stringToDate($this->time4)) : array_push($times,null);

    return $times;
  }
}