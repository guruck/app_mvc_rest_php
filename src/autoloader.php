<?php 
class Autoloader
{

  public static $loader;

  public static function init()
  {
      if (self::$loader == NULL)
          self::$loader = new self();
      return self::$loader;
  }

  public function __construct() {
    
    spl_autoload_register(array($this, 'helper'));
    spl_autoload_register(array($this, 'exception'));
    spl_autoload_register(array($this, 'controller'));
    spl_autoload_register(array($this, 'library'));
    spl_autoload_register(array($this, 'router'));
    spl_autoload_register(array($this, 'model'));
    // spl_autoload_register(array($this, 'loadView'));

  }

  public function helper($class)
  {
    $fileList = glob(__DIR__ . '/helpers/*.helper.php');
    foreach($fileList as $filename){
        if(is_file($filename)){
          require_once ($filename); 
        }   
    }
  }

  public function model($class)
  {
    $base_dir = __DIR__ . '/model/';
    $class = preg_replace('/Dao\\\/','',$class);
    $file = $base_dir . $class . '.dao.php';
    if (file_exists($file)) {
      // echo "$file";
      require_once $file;
    }
  }

  public function library($class)
  {
    $base_dir = __DIR__ . '/lib/';
    $class = preg_replace('/Lib\\\/','',$class);
    $file = $base_dir . $class . '.class.php';
    if (file_exists($file)) {
      // echo "$file<br/>";
      require_once $file;
    }
  }

  public function router($class)
  {
    $base_dir = __DIR__ . '/router/';
    $class = preg_replace('/Src\\\/','',$class);
    $file = $base_dir . $class . '.class.php';
    if (file_exists($file)) {
      require_once $file;
    }
  }

  public function controller($class)
  {
    $base_dir = __DIR__ . '/controllers/';
    $class = preg_replace('/App\\\/','',$class);
    $file = $base_dir . $class . '.php';
    if (file_exists($file)) {
      require_once $file;
    }
  }

  public function exception($class)
  {
    $base_dir = __DIR__ . '/exceptions/';
    $class = preg_replace('/Errors\\\/','',$class);
    $file = $base_dir . $class . '.php';
    if (file_exists($file)) {
      require_once $file;
    }
  }
}
