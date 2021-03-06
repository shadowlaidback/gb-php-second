<?php
namespace fadeev\php2\services;

class DB
{
  private $dbName;
  private $dbLogin;
  private $dbPassword;
  private $dbHost;
  private $dbCharset;
  private $dbDriver;

  private $db = null;

  public function __construct($driver, $host, $login, $password, $database, $charset = "utf8")
  {
    $this->dbDriver = $driver;
    $this->dbHost = $host;
    $this->dbLogin = $login;
    $this->dbPassword = $password;
    $this->dbName = $database;
    $this->dbCharset = $charset;
  }

  private function connect()
  {
    if (is_null($this->db))
    {
      $this->db = new \PDO($this->prepareDsn(), $this->dbLogin, $this->dbPassword);
      $this->db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
    }
    return $this->db;
  }

  public function query($sql, $arParams = array()){
    try {
      $pdoStatement = $this->connect()->prepare($sql);
      $pdoStatement->execute($arParams);
      return $pdoStatement;
    } catch (PDOExecption $e) {
      die($e->getMessage());
    }
  }

  public function queryObject($sql, $arParams, $class)
  {
    $smtp = $this->query($sql, $arParams);
    $smtp->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
    return $smtp->fetch();
  }

  public function execute($sql, $arParams = array())
  {
    $this->query($sql, $arParams);
    return true;
  }

  public function lastInsertId()
  {
    return $this->db->lastInsertId();
  }

  private function prepareDsn()
  {
    return sprintf("%s:host=%s;dbname=%s;charset=%s",
      $this->dbDriver,
      $this->dbHost,
      $this->dbName,
      $this->dbCharset
    );
  }

  function __toString()
  {
    return "DB";
  }
}
?>