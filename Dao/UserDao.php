<?php
include_once 'config.inc.php';
require_once 'database.php';
require_once 'model/User.php';
/**
 *
 */
class UserDao
{
    public static $instance;
    private $table = 'cc_users';

    private function __construct()
    {
        //
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new UserDao();
        }

        return self::$instance;
    }

    public function insert($user)
    {
      try {
        $sql = 'INSERT INTO '. $this->table . ' ' .
        '(first_name, last_name, email, password, photo) '.
        'VALUES '.
        '(:first, :last, :email, :password, :photo)';
        $psql = Database::getInstance()->prepare($sql);
        $psql->bindValue(':first', $user->getFirstName());
        $psql->bindValue(':last', $user->getLastName());
        $psql->bindValue(':email', $user->getEmail());
        $psql->bindValue(':password', $user->getPassword());
        $psql->bindValue(':photo', $user->getPhoto());

        if ($psql->execute()) {
            $user->setId(Database::getInstance()->lastInsertId());
            return $user;
        }
        return false;

      } catch (\Exception $e) {
        printf('Ocorreu um erro '. $e->getMessage());
      }

    }

    public function findByEmail($email)
    {
        try {
            $sql = 'SELECT * FROM ' . $this->table . ' WHERE email = :email';
            $psql = Database::getInstance()->prepare($sql);
            $psql->bindValue(':email', $email);
            $psql->execute();
            $row = $psql->fetch(PDO::FETCH_ASSOC);
            if (!$row) return false;
            return $this->populateUser($row);
        } catch (\Exception $e) {
          print('Error: '. $e->getMessage());
        }
    }

    private function populateUser($row)
    {
        $user = new User();
        $user->setId($row['id']);
        $user->setFirstName($row['first_name']);
        $user->setLastName($row['last_name']);
        $user->setEmail($row['email']);
        $user->setPassword($row['password']);
        $user->setPhoto($row['photo']);
        $user->setRule($row['rule']);
        return $user;
    }


}
