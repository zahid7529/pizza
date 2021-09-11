<?php

    //db connect
    include('config/db_connect.php');

    $email = $password = $confirmPassword = '';
    $errors = array('email'=>'', 'password'=>'', 'confirmPassword'=>'');

    if(isset($_POST['submit'])) {

        //check email
        if(empty($_POST['email'])) {
            $errors['email'] = 'An email is required!';
        } else {
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email must be a valid email address!';
            }
        }

        //check password
        if(empty($_POST['password'])) {
            $errors['password'] = 'A password is required!';
        } else {
            $password = $_POST['password'];
            if(!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/', $password)) {
                $errors['password'] = 'Password must contain 
                at least one lowercase char, 
                at least one uppercase char, 
                at least one digit, 
                at least one special sign of @#-_$%^&+=§!?!';
            }
        }

        //check password confirmation
        if(empty($_POST['confirmPassword'])) {
            $errors['confirmPassword'] = 'Please confirm your password!';
        } else {
            $confirmPassword = $_POST['confirmPassword'];
            $check = strcasecmp($password, $confirmPassword);
            if($check != 0) {
                $errors['confirmPassword'] = 'Password does not match';
            }
        }
    } //end of POST check


    if(array_filter($errors)) {
        //echo 'errors in the form';
    } else if(!array_filter($errors) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirmPassword'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        //$ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

        //create sql
        $sql = "INSERT INTO useraccount(email, password) VALUES('$email', '$password')";

        //save to db and check
        if(mysqli_query($conn, $sql) && $email != '') {
            header('Location: login.php');
        } //else {
        //     echo 'query error: ' . mysqli_error($conn);
        // }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
    
    <?php include('templates/header.php'); ?>
    
    <section class="container grey-text">
        <h4 class="center">Create Account</h4>
        <form action="user-account.php" method="POST" class="white">
            <label>Your Email:</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
            <div class="red-text"><?php echo $errors['email']; ?></div>
            <label>Password:</label>
            <input type="password" name="password" value="<?php echo htmlspecialchars($password) ?>">
            <div class="red-text"><?php echo $errors['password']; ?></div>
            <label>Confirm password:</label>
            <input type="password" name="confirmPassword" value="<?php echo htmlspecialchars($confirmPassword) ?>">
            <div class="red-text"><?php echo $errors['confirmPassword']; ?></div>
            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>

    <?php include('templates/footer.php'); ?>

</html>