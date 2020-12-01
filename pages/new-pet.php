<?php
    session_start();

    if (!isset($_SESSION['email']))
        die(header('Location: ./login.php'));

    $msg=!empty($_SESSION['msg'])?$_SESSION['msg']:'';

    include_once('../templates/tpl_common.php');

    draw_header("Send New Pet For Adoption", array('new_pet.css'));
?>

<section class="pet-container">    
    <form method="post" action="../actions/action_new_pet.php" enctype="multipart/form-data">
        <section class="add-pet-image">
            <h2 class="large-text">Pet Images</h2>
            <p><?= "Please select a file" ?></p>
            <label for="pet-image" class="custom-file-upload"></label>
            <input type="file" name="pet-image[]" id="pet-image" multiple>
        </section>

        <section class="pet-info">
            <label for="name">Name:</label>
            <input type="text" name="name" placeholder="Max, Kitty, Sky, Nemo..." required>
            <label for="species">Species:</label>
            <input type="text" name="species" placeholder="Dog, Cat, Bird, Fish..." required>
            <label for="age">Age:</label>
            <input type="text" name="age" placeholder="10 years, 4 months, 2 weeks...">
            <label for="color">Color:</label>
            <input type="text" name="color" placeholder="Brown, Black, Yellow, Orange...">
            <label for="location">Location:</label>
            <input type="text" name="location" placeholder="Pick up adress" required>
            <input type="submit" value="Submit" class="large-text">
        </section>
    </form>
</section>

<?php
    draw_footer();
?>