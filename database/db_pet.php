<?php
  include_once('../includes/database.php');

  function insertPet($name, $species, $age, $color, $location, $user) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('INSERT INTO Pet(name, species, age, color, location, user) VALUES(?, ?, ?, ?, ?, ?)');
    $stmt->execute(array($name, $species, $age, $color, $location, $user));

    $stmt = $db->prepare('SELECT * FROM Pet ORDER BY id DESC LIMIT 1');
    $stmt->execute();
    $pet = $stmt->fetch();
    return $pet;
  }

  function updatePet($pet_id, $name, $species, $age, $color, $location, $user) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('UPDATE Pet SET name = ?, species = ?, age = ?, color = ?, location = ? WHERE id = ? AND user = ?');
    $stmt->execute(array($name, $species, $age, $color, $location, $pet_id, $user));
  }

  function getPetInfo($pet_id) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM Pet WHERE id = ?');
    $stmt->execute(array($pet_id));

    $pet = $stmt->fetch();
    return $pet;
  }

  function addPetPhoto($user, $pet_id, $photo){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT user, adoptedBy FROM Pet WHERE id = ?');
    $stmt->execute(array($pet_id));

    $users = $stmt->fetch();

    if($user != $users['user'] && $user != $users['adoptedBy'])
      throw new PDOException();

    $stmt = $db->prepare('INSERT INTO Photo VALUES(?, ?)');
    $stmt->execute(array($pet_id, $photo));
  }

  function addPetToFavorites($user, $pet_id){
    $db = Database::instance()->db();
    try {
      $stmt = $db->prepare('INSERT INTO Favorite VALUES(?, ?)');
      $stmt->execute(array($user, $pet_id));
    } catch (PDOException $e) {
      $stmt = $db->prepare('DELETE FROM Favorite WHERE user = ? AND pet_id = ?');
      $stmt->execute(array($user, $pet_id));
    }
  }

  function addPetQuestion($user, $pet_id, $question){
    $db = Database::instance()->db();
    $stmt = $db->prepare('INSERT INTO Question(user, pet_id, question) VALUES(?, ?, ?)');
    $stmt->execute(array($user, $pet_id, $question));
  }

  function addPetAdoptionProposal($user, $pet_id){
    $db = Database::instance()->db();
    $stmt = $db->prepare('INSERT INTO AdoptionProposal(user,pet_id) VALUES(?, ?)');
    $stmt->execute(array($user, $pet_id));
  }

  function setPetAdoptState($user, $pet_id, $state){
    $db = Database::instance()->db();
    if($state == 1){
      $stmt = $db->prepare('UPDATE Pet SET adoptedBy = ? WHERE id = ?');
      $stmt->execute(array($user, $pet_id));
      $stmt = $db->prepare('UPDATE AdoptionProposal SET state = ? WHERE pet_id = ? AND user = ? ');
      $stmt->execute(array($state, $pet_id, $user));
    }
    else if($state == -1){
      $stmt = $db->prepare('UPDATE AdoptionProposal SET state = ? WHERE pet_id = ? AND user = ? ');
      $stmt->execute(array($state, $pet_id, $user));
    }

  }

  function getPetProposals($pet_id) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT U.email, U.name, A.state FROM User AS U, AdoptionProposal AS A WHERE U.email = A.user AND A.pet_id = ?');
    $stmt->execute(array($pet_id));

    $proposals = $stmt->fetchAll();
    return $proposals;
  }

  function getPetQuestions($pet_id) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT U.name, Q.question FROM User AS U, Question AS Q WHERE U.email = Q.user AND Q.pet_id = ?');
    $stmt->execute(array($pet_id));

    $questions = $stmt->fetchAll();
    return $questions;
  }

  function getAllPets(){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM Pet;');
    $stmt->execute();

    return $stmt->fetchAll();
  }
