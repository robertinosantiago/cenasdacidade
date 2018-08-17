<?php

/**
 *
 */
class Photo
{

  private $id;
  private $title;
  private $path;
  private $relativeId;
  private $user_id;

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getTitle() {
    return $this->title;
  }

  public function setTitle($title) {
    $this->title = $title;
  }

  public function getPath() {
    return $this->path;
  }

  public function setPath($path) {
    $this->path = $path;
  }

  public function getRelativeId() {
    return $this->relativeId;
  }

  public function setRelativeId($relativeId) {
    $this->relativeId = $relativeId;
  }

  public function getUserId() {
    return $this->user_id;
  }

  public function setUserId($user_id) {
    $this->user_id = $user_id;
  }

  public function toArray() {
    return [
      'Photo' => [
        'id' => $this->id,
        'title' => $this->title,
        'path' => $this->path,
        'relativeId' => $this->relativeId,
        'user_id' => $this->user_id,
      ]
    ];
  }

}
