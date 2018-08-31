<?php

/**
 *
 */
class User
{

  private $id;
  private $first_name;
  private $last_name;
  private $email;
  private $password;
  private $photo;
  private $role;

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getFirstName() {
    return $this->first_name;
  }

  public function setFirstName($first_name) {
    $this->first_name = $first_name;
  }

  public function getLastName() {
    return $this->last_name;
  }

  public function setLastName($last_name) {
    $this->last_name = $last_name;
  }

  public function getEmail() {
    return $this->email;
  }

  public function setEmail($email) {
    $this->email = $email;
  }

  public function getPassword() {
    return $this->password;
  }

  public function setPassword($password) {
    $this->password = $password;
  }

  public function getPhoto() {
    return $this->photo;
  }

  public function setPhoto($photo) {
    $this->photo = $photo;
  }

  public function getRole() {
    return $this->role;
  }

  public function setRole($role) {
    $this->role = $role;
  }

  public function getFullName() {
    return $this->getFirstName() . ' ' . $this->getLastName();
  }

  public function toArray() {
    return [
      'User' => [
        'id' => $this->getId(),
        'first_name' => $this->getFirstName(),
        'last_name' => $this->getLastName(),
        'full_name' => $this->getFullName(),
        'email' => $this->getEmail(),
        'password' => $this->getPassword(),
        'photo' => $this->getPhoto(),
        'role' => $this->getRole()
      ]
    ];
  }
}
