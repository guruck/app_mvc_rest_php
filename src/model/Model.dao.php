<?php
namespace Dao;
use Lib\Database as Database;
use \PDO as PDO;

class Model{
  protected static $tableName = '';
  protected static $columns = [];
  protected $values = [];

  function __construct($arr, $sanitize = true){
    $this->loadFromArray($arr, $sanitize);
  }

  public function loadFromArray($arr, $sanitize = true){
    if($arr){
      // $conn = Database::getConnection();
      foreach($arr as $key => $value){
        $cleanValue = $value;
        if($sanitize && isset($cleanValue)) {
          $cleanValue = strip_tags(trim($cleanValue));
          $cleanValue = htmlentities($cleanValue, ENT_NOQUOTES);
          // $cleanValue = mysqli_real_escape_string($conn, $cleanValue);
        }
        $this->$key = $cleanValue;
      }
      // $conn->close();
    }
  }

  public function __get($key){
    return $this->values[$key];
  }

  public function __set($key, $value){
    $this->values[$key] = $value;
  }
  public function __unset($key)
  {
    // $this->values[$key] = null;
    unset($this->values[$key]);
  }
  public function getValues() {
    return $this->values;
  }

  public static function getOne($filters = [], $columns = '*'){
    $class = get_called_class();
    $result = static::getResultSetFromSelect($filters, $columns);
    return $result ? new $class($result->fetch(PDO::FETCH_ASSOC)) : null;
  }

  public static function get($filters = [], $columns = '*'){
    $objects = [];
    $result = static::getResultSetFromSelect($filters, $columns);
    if($result){
      $class = get_called_class();
      while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        array_push($objects, new $class($row));
      };
    }
    return $objects;
  }

  public static function getResultSetFromSelect($filters = [], $columns = '*'){
    $sql = "SELECT {$columns} FROM " 
    . static::$tableName 
    . static::getFilters($filters)
    ;
    $result = Database::getResultFromQuery($sql);
    // var_dump($result);die();
    if($result->rowCount() === true){
      return null;
    }else{
      return $result;
    }
  }

  public function insert(){
    $sql = "INSERT INTO " . static::$tableName . " (" . implode(',',static::$columns) . ") VALUES(";
    foreach(static::$columns as $col){
      $sql .= static::getFormatedValue($this->$col) . ",";
    }
    $sql[strlen($sql) - 1] = ')';
    // echo "cheguei aqui agora $sql <br/>";
    // die();
    $id = Database::executeFromQuery($sql);
    $this->id = $id;
  }

  public function update(){
    $sql = "UPDATE " . static::$tableName . " SET";
    foreach(static::$columns as $col){
      $sql .= " ${col} = " . static::getFormatedValue($this->$col) . ",";
    }
    $sql[strlen($sql) - 1] = ' ';
    $sql .= "WHERE id = {$this->id} ";
    Database::executeFromQuery($sql);
  }

  public static function getCount($filters = []) {
    $result = static::getResultSetFromSelect(
        $filters, 'count(*) as count');
    return $result->fetch(PDO::FETCH_ASSOC)['count'];
  }

  public function delete() {
    static::deleteById($this->id);
  }

  public static function deleteById($id) {
    $sql = "DELETE FROM " . static::$tableName . " WHERE id = {$id}";
    Database::executeFromQuery($sql);
  }

  private static function getFilters($filters){
    $sql = '';
    if (count($filters) > 0){
      $sql .= " WHERE 1 = 1 ";
      foreach($filters as $key => $value){
        if($key === 'raw'){
          $sql .= "AND {$value}";
        }else{
          $sql .= "AND {$key} = " . static::getFormatedValue($value);
        }
      }
    }
    return $sql;
  }

  private static function getFormatedValue($value){
    if(is_null($value)){
      return "null";
    }elseif(gettype($value)==='string' and $value === ''){
      return "null";
    }elseif(gettype($value)==='string'){
      return "'{$value}'";
    }else{
      return $value;
    }
  }
}