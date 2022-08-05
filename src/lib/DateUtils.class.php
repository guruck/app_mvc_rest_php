<?php
namespace Lib;
use \DateTime;
use \DateTimeImmutable;


class DateUtils{
  function getDateAsDateTime($date){
    return is_string($date) ? new DateTime($date) : $date;
  }

  function isWeekend($date){
    $inputDate = self::getDateAsDateTime($date);
    return $inputDate->format('N') >= 6;
  }

  function isBefore($date1,$date2){
    $inputDate1 = self::getDateAsDateTime($date1);
    $inputDate2 = self::getDateAsDateTime($date2);
    return $inputDate1 <= $inputDate2;
  }

  function getNextDay($date){
    $inputDate = self::getDateAsDateTime($date);
    $inputDate->modify('+1 day');
    return $inputDate;
  }

  function sumIntervals($interval1,$interval2){
    $date = new DateTime('00:00:00');
    $date->add($interval1);
    $date->add($interval2);
    return (new DateTime('00:00:00'))->diff($date);
  }

  function subtractIntervals($interval1,$interval2){
    $date = new DateTime('00:00:00');
    $date->add($interval1);
    $date->sub($interval2);
    return (new DateTime('00:00:00'))->diff($date);
  }

  function intervalToDate($interval1){
    // return new DateTime($interval1->format('%H:%i:%s'));
    return new DateTimeImmutable($interval1->format('%H:%i:%s'));
  }

  function intervalToString($interval1){
    $strDateInterval = $interval1;
    if (get_class($interval1)==='DateInterval'){
      $dateInterval = self::intervalToDate($interval1);
      $strDateInterval = $dateInterval->format('H:i:s');
    }elseif ((get_class($interval1) === 'DateTimeImmutable') || (get_class($interval1) === 'DateTime'))
    {
      $strDateInterval = $interval1->format('H:i:s');
    }
    return $strDateInterval;
  }

  function stringToDate($string){
    return DateTimeImmutable::createFromFormat('H:i:s',$string);
  }

  function getFirstDayOfMonth($date){
    $time = self::getDateAsDateTime($date)->getTimestamp();
    return new DateTime(date('Y-m-1', $time));
  }

  function getLastDayOfMonth($date){
    $time = self::getDateAsDateTime($date)->getTimestamp();
    return new DateTime(date('Y-m-t', $time));
  }

  function getSecondsFromDateInterval($interval){
    $d1 = new DateTimeImmutable;
    $d2 = $d1->add($interval);
    return $d2->getTimestamp() - $d1->getTimestamp();
  }

  function isPastWorkDay($date){
    return !self::isWeekend($date) && self::isBefore($date, new DateTime());
  }

  function getTimeStringFromSeconds($seconds){
    $horas = intdiv($seconds,3600);
    $minutos = intdiv($seconds % 3600,60);
    $segundos = $seconds - ($horas * 3600) - ($minutos * 60);
    return sprintf('%02d:%02d:%02d',$horas,$minutos,$segundos);
  }

  function formatDateWithLocale($date, $pattern){
    $time = self::getDateAsDateTime($date)->getTimestamp();
    return utf8_encode(strftime($pattern, $time));
  }
}