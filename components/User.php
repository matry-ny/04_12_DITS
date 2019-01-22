<?php

namespace components;

use PDO;

/**
 * Class User
 * @package components
 */
class User
{
  /**
   * @var bool
   */
  private $isGuest = true;

  /**
   * @var array
   */
  private $userData = [];

  /**
   * @return bool
   */
  public function getIsGuest(): bool
  {
    return $this->isGuest;
  }

  /**
   * @return array
   */
  public function getUserData()
  {
    return $this->userData;
  }

  /**
   * @param string $login
   * @param string $password
   * @return $this
   */
  public function auth(string $login, string $password)
  {
    $userData = $this->findUserByLogin($login);
    if ($userData && password_verify($password, $userData['password'])) {
      $this->isGuest = false;

      unset($userData['password']);
      $this->userData = $userData;
    }

    return $this;
  }

  public function logout()
  {
    $this->isGuest = true;
    $this->userData = [];
  }

  /**
   * @param string $login
   * @return mixed
   * @throws \Exception
   */
  private function findUserByLogin(string $login)
  {
    $statement = App::get()
      ->db()
      ->getQueryBuilder()
      ->prepare('SELECT * FROM users WHERE login = :login');

    $statement->bindParam(':login', $login, PDO::PARAM_STR);
    $statement->execute();


    return $statement->fetch(PDO::FETCH_ASSOC);
  }
}
