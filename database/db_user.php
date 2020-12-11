<?php
  include_once(dirname(__DIR__) . '/includes/database.php');
  include_once(dirname(__DIR__) . '/includes/regex.php');

  function checkUserPassword($email, $password) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM LoginData WHERE email = ?');
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

  function getAllUsers() {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM User');
    $stmt->execute();

    $users = $stmt->fetchAll();
    return $users;
  }

  function insertUser($email, $password, $name, $phone_number) {
    $db = Database::instance()->db();

    $options = ['cost' => 12];

    $stmt = $db->prepare('INSERT INTO LoginData VALUES(?, ?)');
    $stmt->execute(array($email, password_hash($password, PASSWORD_DEFAULT, $options)));
    $stmt = $db->prepare('INSERT INTO User VALUES(?, ?, ?)');
    $stmt->execute(array($email, $name, $phone_number));
  }

  function updateUser($oldemail, $newemail, $password, $name, $phone_number) {
    $db = Database::instance()->db();

    $options = ['cost' => 12];

    $stmt = $db->prepare('UPDATE LoginData SET email = ?, password = ? WHERE email = ?');
    $stmt->execute(array($newemail, password_hash($password, PASSWORD_DEFAULT, $options), $oldemail));
    $stmt = $db->prepare('UPDATE User SET name = ?, phone_number = ? WHERE email = ?');
    $stmt->execute(array($name, $phone_number, $newemail));
  }

  function getUserPets($user) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM Pet WHERE user = ?');
    $stmt->execute(array($user));

    $pets = $stmt->fetchAll();
    return $pets;
  }

  function getUserFavorites($user) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM Pet, Favorite WHERE Favorite.user = ? AND Pet.id = Favorite.pet_id');
    $stmt->execute(array($user));

    $pets = $stmt->fetchAll();
    return $pets;
  }

  function getUserProposals($user) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM Pet, AdoptionProposal WHERE AdoptionProposal.user = ? AND Pet.id = AdoptionProposal.pet_id');
    $stmt->execute(array($user));

    $pets = $stmt->fetchAll();
    return $pets;
  }

  function getAdoptedPets($user) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM Pet WHERE adoptedBy = ?');
    $stmt->execute(array($user));

    $pets = $stmt->fetchAll();
    return $pets;
  }

  function countNotifications($user){
    $db = Database::instance()->db();
    
    $stmt = $db->prepare('SELECT COUNT(*) AS count FROM UserNotification WHERE user = ?');
    $stmt->execute(array($user));
    $notifications = $stmt->fetch()['count'];

    return $notifications;
  }

  function getUserNotifications($user){
    $db = Database::instance()->db();
    
    $stmt = $db->prepare('SELECT * FROM UserNotification WHERE user = ?');
    $stmt->execute(array($user));
    $notifications = $stmt->fetchAll();

    $stmt = $db->prepare('DELETE FROM UserNotification WHERE user = ?');
    $stmt->execute(array($user));
    
    return $notifications;
  }

?>