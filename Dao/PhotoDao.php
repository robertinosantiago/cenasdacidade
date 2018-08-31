<?php
include_once 'config.inc.php';
require_once 'database.php';
require_once 'model/Photo.php';
/**
 *
 */
class PhotoDao
{
    public static $instance;
    private $table = 'cc_photos';

    private function __construct()
    {
        //
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new PhotoDao();
        }

        return self::$instance;
    }

    public function insert($photo)
    {
      try {
        $sql = 'INSERT INTO '. $this->table . ' ' .
        '(title, path, user_id) '.
        'VALUES '.
        '(:title, :path, :user_id)';
        $psql = Database::getInstance()->prepare($sql);
        $psql->bindValue(':title', $photo->getTitle());
        $psql->bindValue(':path', $photo->getPath());
        $psql->bindValue(':user_id', $photo->getUserId());

        if ($psql->execute()) {
            $photo->setId(Database::getInstance()->lastInsertId());
            return $photo;
        }
        return false;

      } catch (\Exception $e) {
        printf('Ocorreu um erro '. $e->getMessage());
      }

    }

    public function countByUserId($user_id) {
      try {
          $sql = 'SELECT COUNT(id) FROM ' . $this->table . ' WHERE user_id = :user_id';
          $psql = Database::getInstance()->prepare($sql);
          $psql->bindValue(':user_id', $user_id);
          $psql->execute();
          $total = (int) $psql->fetchColumn(0);
          return $total;
      } catch (\Exception $e) {
        print('Error: '. $e->getMessage());
      }
    }

    public function findByUserId($user_id)
    {
        try {
            $sql = 'SELECT * FROM ' . $this->table . ' WHERE user_id = :user_id';
            $psql = Database::getInstance()->prepare($sql);
            $psql->bindValue(':user_id', $user_id);
            $psql->execute();
            $rows = $psql->fetchAll();
            if (!$rows) return false;
            $array = array();
            foreach ($rows as $value) {
              $array[] = $this->populatePhoto($value);
            }
            return $array;
        } catch (\Exception $e) {
          print('Error: '. $e->getMessage());
        }
    }

    public function findById($id) {
      try {
          $sql = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';
          $psql = Database::getInstance()->prepare($sql);
          $psql->bindValue(':id', $id);
          $psql->execute();
          $row = $psql->fetch(PDO::FETCH_ASSOC);
          if (!$row) return false;
          return $this->populatePhoto($row);
      } catch (\Exception $e) {
        print('Error: '. $e->getMessage());
      }
    }

    public function delete($id) {
      try {
          $sql = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
          $psql = Database::getInstance()->prepare($sql);
          $psql->bindValue(':id', $id);
          $result = $psql->execute();
          return $result;
      } catch (\Exception $e) {
        print('Error: '. $e->getMessage());
      }
    }

    public function countUnratedPhotos($appraiser_id) {
      try {
        $sql = 'SELECT COUNT(p.id) FROM cc_ratings r ';
        $sql .= 'RIGHT join cc_photos p on (p.id = r.photo_id) ';
        $sql .= 'where p.id not in (select p.id from cc_ratings r ';
        $sql .= 'inner join cc_photos p on (p.id = r.photo_id) ';
        $sql .= 'inner join cc_users u ON (u.id = r.user_id) ';
        $sql .= 'where u.id = ' . $appraiser_id . ') ';

        // $sql = 'SELECT COUNT(p.id) FROM ' . $this->table . ' p ';
        // $sql .= 'INNER JOIN cc_users u ON (p.user_id = u.id) ';
        // $sql .= 'LEFT JOIN cc_ratings r ON (p.id = r.photo_id) ';
        // $sql .= 'WHERE r.user_id IS null OR r.user_id != :appraiser_id ';

        $psql = Database::getInstance()->prepare($sql);
        $psql->bindValue(':appraiser_id', $appraiser_id);
        $psql->execute();
        $total = (int) $psql->fetchColumn(0);
        return $total;
      } catch (\Exception $e) {
        print('Error: '. $e->getMessage());
      }
    }

    public function unratedPhotos($appraiser_id) {
      try {
        $sql = 'SELECT p.id, p.title, p.path FROM cc_ratings r ';
        $sql .= 'RIGHT join cc_photos p on (p.id = r.photo_id) ';
        $sql .= 'where p.id not in (select p.id from cc_ratings r ';
        $sql .= 'inner join cc_photos p on (p.id = r.photo_id) ';
        $sql .= 'inner join cc_users u ON (u.id = r.user_id) ';
        $sql .= 'where u.id = ' . $appraiser_id . ') ';
        $sql .= 'LIMIT 0,1';

        // $sql = 'SELECT p.id, r.user_id, p.title, p.path FROM ' . $this->table . ' p ';
        // $sql .= 'INNER JOIN cc_users u ON (p.user_id = u.id) ';
        // $sql .= 'LEFT JOIN cc_ratings r ON (p.id = r.photo_id) ';
        // $sql .= 'WHERE r.user_id IS null OR r.user_id != :appraiser_id ';
        // $sql .= 'LIMIT 0,1';

        $psql = Database::getInstance()->prepare($sql);
        $psql->bindValue(':appraiser_id', $appraiser_id);
        $psql->execute();
        $rows = $psql->fetchAll();
        if (!$rows) return false;
        $array = array();
        foreach ($rows as $value) {
          $array[] = $this->populatePhoto($value);
        }
        return $array;
      } catch (\Exception $e) {
        print('Error: '. $e->getMessage());
      }

    }

    private function populatePhoto($row)
    {
      $photo = new Photo();
      $photo->setId($row['id']);
      $photo->setTitle($row['title']);
      $photo->setPath($row['path']);
      $photo->setRelativeId($row['relativeId']);
      $photo->setUserId($row['user_id']);
      return $photo;
    }


}
