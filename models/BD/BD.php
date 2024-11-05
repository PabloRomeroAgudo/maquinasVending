<?php

declare(strict_types=1);

class BD {
  private static $dbh;

  private function __construct() {
    $user = 'root';
    $pass = '';
    $dbn = 'maquinas_expendedoras';
    $mysqlhost = 'localhost';
    $port = '3306';

    try {
      $dsn = "mysql:host=$mysqlhost;port=$port;dbname=$dbn";
      self::$dbh = new PDO($dsn, $user, $pass);
      self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo "error: ";
      print_r($e);
    }
  }

  public static function getInstance() {
    if (!isset(self::$dbh)) {
      new self();
    }
    return self::$dbh;
  }

  public static function close() {
    self::$dbh = null;
  }
}
