<?php
include_once 'config.inc.php';

/**
 *
 */
class Database
{
  public static $instance;

  private function __construct()
  {
    // code...
  }

  public static function getInstance() {
    if (!isset(self::$instance)) {
      self::$instance = new PDO(
        'mysql:host='. DB_HOSTNAME .';dbname=' . DB_DATABASE,
        DB_USERNAME,
        DB_PASSWORD,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
      );
      self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
    }
    return self::$instance;
  }
}
