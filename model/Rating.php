<?php

/**
 *
 */
class Rating
{

  private $id;
  private $value;
  private $photo_id;
  private $user_id;

  public function setId($id) {
    $this->id = $id;
  }

  public function getId() {
    return $this->id;
  }

  public function setValue($value) {
    $this->value = $value;
  }

  public function getValue() {
    return $this->value;
  }

  public function setPhotoId($photo_id) {
    $this->photo_id = $photo_id;
  }

  public function getPhotoId() {
    return $this->photo_id;
  }

  public function setUserId($user_id) {
    $this->user_id = $user_id;
  }

  public function getUserId() {
    return $this->user_id;
  }

  public function toArray() {
    return [
      'Rating' => [
        'id' => $this->id,
        'value' => $this->value,
        'photo_id' => $this->photo_id,
        'user_id' => $this->user_id,
      ]
    ];
  }
}
