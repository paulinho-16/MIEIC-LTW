<?php
  session_start();
  include_once('../database/db_pet.php');

  $email = $_SESSION['email'];
  $pet = $_POST['pet_id'];

  try {
      if(!is_id($pet)){
        throw new PDOException('Invalid Pet id');
      }

      if(getPetOwner($pet) == $email){
        $name = clean_text($_POST['name']);
        $species = clean_text($_POST['species']);
        $age = clean_text($_POST['age']);
        $color = clean_text($_POST['color']);
        $location = clean_text($_POST['location']);

        if(!validate_pet($name, $species, $age, $color, $location))
          return new PDOException('Matching error in on of the inputs');

        updatePet($pet, $name, $species, $age, $color, $location, $email);
        $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Pet Updated!');
      }
      else{
        throw new PDOException('User Does Not Own This Pet');
      }

  } catch (PDOException $e) {
    // die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to update pet!');
  }
  header("Location: ../pages/pet.php?pet_id={$pet}");
?>