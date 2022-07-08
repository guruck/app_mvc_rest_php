<?php
namespace Lib;

class Database{
  
  public static function getConnection(){
    $envPath = realpath(dirname(__FILE__) . '/../.env');
    $env = parse_ini_file($envPath);
    $dsn = "mysql:host={$env['hostname']}:{$env['dtbsport']};dbname={$env['database']};charset=utf8";
    $opcoes = array(
        \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
    );
    try {
      $pdo = new \PDO($dsn, $env['username'], $env['password'], $opcoes);
      // $pdo->exec("SET CHARACTER SET utf8");
      return $pdo;
    } catch (\PDOException $e) {
      die('Erro: ' . $e->getMessage());
    } 
  }

  public static function getResultFromQuery($sql){
    $conn = self::getConnection();
    $result = $conn->query($sql);
    $conn = null;
    return $result;
  }

  public static function executeFromQuery($sql){
    $conn = self::getConnection();
    $affected = $conn->exec($sql);
    if ($affected === false) {
        $err = $conn->errorInfo();
        if ($err[0] === '00000' || $err[0] === '01000') {
            return true;
        }
    }
    return $affected;
  }
}