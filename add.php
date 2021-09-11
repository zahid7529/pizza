<?php

    //db connect
    include('config/db_connect.php');

    $title = $name =  $email = $ingredients = '';
    $errors = array('name'=>'', 'email'=>'', 'title'=>'', 'ingredients'=>'');

    if(isset($_POST['submit'])) {

        //check name
        if(empty($_POST['name'])) {
            $errors['name'] = 'A name is required!';
        }

        //check email
        if(empty($_POST['email'])) {
            $errors['email'] = 'An email is required!';
        } else {
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email must be a valid email address!';
            }
        }

        //check title
        if(empty($_POST['title'])) {
            $errors['title'] = 'A title is required!';
        } else {
            $title = $_POST['title'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $title)) {
                $errors['title'] = 'Title must be letters and spaces only!';
            }
        }

        //check ingredients
        if(empty($_POST['ingredients'])) {
            $errors['ingredients'] = 'At least one ingredient is required!';
        } else {
            $ingredients = $_POST['ingredients'];
            if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
                $errors['ingredients'] = 'Ingredients must be a comma separated list!';
            }
        }
    } //end of POST check


    if(array_filter($errors)) {
        //echo 'errors in the form';
    } else if(!array_filter($errors) && !empty($_POST['ingredients']) && !empty($_POST['title']) && !empty($_POST['email']) && !empty($_POST['name'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

        //create sql
        $sql = "INSERT INTO pizzas(title, name, email, ingredients) VALUES('$title', '$name', '$email', '$ingredients')";

        //save to db and check
        if(mysqli_query($conn, $sql) && $email != '') {
            header("Location: user.php?email=".$_POST['email']);
        } //else {
        //     echo 'query error: ' . mysqli_error($conn);
        // }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
    
    <?php include('templates/header.php'); ?>
    
    <section class="container grey-text">
        <h4 class="center">Add a Pizza</h4>
        <form action="add.php" method="POST" class="white">
            <label>Your Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($name) ?>">
            <div class="red-text"><?php echo $errors['name']; ?></div>
            <label>Your Email:</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
            <div class="red-text"><?php echo $errors['email']; ?></div>
            <label>Pizza Title:</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
            <div class="red-text"><?php echo $errors['title']; ?></div>
            <label>Ingredients (comma separated):</label>
            <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
            <div class="red-text"><?php echo $errors['ingredients']; ?></div>
            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>

    <?php include('templates/footer.php'); ?>

</html>