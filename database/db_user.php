<?php
  include_once('../includes/database.php');

  /**
   * Verifies if a certain email, password combination
   * exists in the database. Use the sha1 hashing function.
   */
  function checkUserPassword($email, $password) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM Login WHERE email = ?');
    $stmt->execute(array($email));

    $user = $stmt->fetch();
    return $user !== false && password_verify($password, $user['password']);
  }

  function getUserInfo($email) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM User WHERE email = ?');
    $stmt->execute(array($email));

    $user = $stmt->fetch();
    return $user;
  }

  function insertUser($email, $password, $name, $phone_number) {
    $db = Database::instance()->db();

    $options = ['cost' => 12];

    $stmt = $db->prepare('INSERT INTO Login VALUES(?, ?)');
    $stmt->execute(array($email, password_hash($password, PASSWORD_DEFAULT, $options)));
    $stmt = $db->prepare('INSERT INTO User VALUES(?, ?, ?)');
    $stmt->execute(array($email, $name, $phone_number));
  }

  function updateUser($oldemail, $newemail, $password, $name, $phone_number) {
    $db = Database::instance()->db();

    $options = ['cost' => 12];

    $stmt = $db->prepare('UPDATE Login SET email = ?, password = ? WHERE email = ?');
    $stmt->execute(array($newemail, password_hash($password, PASSWORD_DEFAULT, $options), $oldemail));
    $stmt = $db->prepare('UPDATE User SET name = ?, phone_number = ? WHERE email = ?');
    $stmt->execute(array($name, $phone_number, $newemail));
  }

  function getUserPets($email) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM Pet WHERE user = ?');
    $stmt->execute(array($email));

    $pets = $stmt->fetchAll();
    return $pets;
  }

  function getUserFavorites($email) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM Pet, Favorite WHERE Favorite.user = ?');
    $stmt->execute(array($email));

    $pets = $stmt->fetchAll();
    return $pets;
  }

  function getUserProposals($email) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM Pet, AdoptionProposal WHERE AdoptionProposal.user = ?');
    $stmt->execute(array($email));

    $pets = $stmt->fetchAll();
    return $pets;
  }
?>