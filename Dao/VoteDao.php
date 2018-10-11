<?php
include_once 'config.inc.php';
require_once 'database.php';
require_once 'model/Vote.php';
/**
 *
 */
class VoteDao
{
    public static $instance;
    private $table = 'cc_votes';

    private function __construct()
    {
        //
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new VoteDao();
        }

        return self::$instance;
    }

    public function insert($vote)
    {
      try {
        $sql = 'INSERT INTO '. $this->table . ' ' .
        '(document, photo_id, token) '.
        'VALUES '.
        '(:document, :photo_id, :token)';
        $psql = Database::getInstance()->prepare($sql);
        $psql->bindValue(':document', $vote->getDocument());
        $psql->bindValue(':photo_id', $vote->getPhotoId());
        $psql->bindValue(':token', $vote->getToken());

        if ($psql->execute()) {
            $vote->setId(Database::getInstance()->lastInsertId());
            return $vote;
        }
        return false;

      } catch (\Exception $e) {
        printf('Ocorreu um erro '. $e->getMessage());
      }

    }

}
