<?php


class DBConnection
{
  private $hostanme = "localhost";
  private $username = "root";
  private $dbname = "schooldb";
  private $password = "";
  private $connection = null;
  /**
   * DBConnection constructor.
   * @param $hostanme
   * @param $username
   * @param $dbname
   * @param $password
   */

  /**
   * @return mixed
   */
  public function getHostanme()
  {
    return $this->hostanme;
  }

  /**
   * @return mixed
   */
  public function getUsername()
  {
    return $this->username;
  }

  /**
   * @return mixed
   */
  public function getDbname()
  {
    return $this->dbname;
  }

  /**
   * @return mixed
   */
  public function getPassword()
  {
    return $this->password;
  }

  public function getConnection(){

  }


}
