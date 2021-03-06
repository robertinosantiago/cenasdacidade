<?php

/**
 *
 */
class Vote
{

  private $id;
  private $document;
  private $photo_id;
  private $token;

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getDocument() {
    return $this->document;
  }

  public function setDocument($document) {
    $this->document = $document;
  }

  public function getPhotoId() {
    return $this->photo_id;
  }

  public function setPhotoId($photo_id) {
    $this->photo_id = $photo_id;
  }

  public function getToken() {
    return $this->token;
  }

  public function setToken($token) {
    $this->token = $token;
  }

  public function toArray() {
    return [
      'Vote' => [
        'id' => $this->getId(),
        'document' => $this->getDocument(),
        'photo_id' => $this->getPhotoId(),
        'token' => $this->getToken()
      ]
    ];
  }

}
