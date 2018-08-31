<?php
include_once 'config.inc.php';
require_once 'database.php';
require_once 'model/Rating.php';
/**
 *
 */
class RatingDao
{
    public static $instance;
    private $table = 'cc_ratings';

    private function __construct()
    {
        //
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new RatingDao();
        }

        return self::$instance;
    }

    public function insert($rating)
    {
      try {
        $sql = 'INSERT INTO '. $this->table . ' ' .
        '(value, photo_id, user_id) '.
        'VALUES '.
        '(:value, :photo_id, :user_id)';
        $psql = Database::getInstance()->prepare($sql);
        $psql->bindValue(':value', $rating->getValue());
        $psql->bindValue(':photo_id', $rating->getPhotoId());
        $psql->bindValue(':user_id', $rating->getUserId());

        if ($psql->execute()) {
            $rating->setId(Database::getInstance()->lastInsertId());
            return $rating;
        }
        return false;

      } catch (\Exception $e) {
        printf('Ocorreu um erro '. $e->getMessage());
      }

    }

}
