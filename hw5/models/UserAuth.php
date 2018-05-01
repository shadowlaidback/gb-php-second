<?php
namespace fadeev\php2\models;
use fadeev\php2\models\User;
/**
* Пользователь
*/
class UserAuth
{
  /**
   * Шифруем пароль
   * @param string $password
   */
  protected function HashPassword($password)
  {
    return password_hash($password, PASSWORD_DEFAULT);
  }
  /**
   * Проверяем пароль
   * @param string $password
   */
  protected static function VerifyPassword($password, $db_password)
  {
    return password_verify($password, $db_password);
  }

  /**
   * Авторизация
   * @param string $login
   * @param string $password
   */
  public static function Auth($login, $password)
  {
    $findUser = User::GetList(array("login" => $login), array("id", "password"))[0];
    if (self::VerifyPassword($password, $findUser["password"]))
    {
      return User::GetById($findUser["id"]);
    }
    return false;
  }
}
?>