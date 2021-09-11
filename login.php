<?php

    //db connect
    include('config/db_connect.php');

    $email = $password ='';
    $errors = array('email'=>'', 'password'=>'');


    if(isset($_POST['submit'])) {

        //check email
        if(empty($_POST['email'])) {
            $errors['email'] = 'An email is required!';
        //check password    
        } else if(empty($_POST['password'])) {
            $errors['password'] = 'A password is required!';
        } else {
            $e = $_POST['email'];
            $p = $_POST['password'];
            //write query for all pizzas
            $sql = "SELECT email, password 
                        FROM useraccount 
                            WHERE email = '$e' AND password = '$p'";

            //make quaries and get results
            $result = mysqli_query($conn, $sql);
            $qValues = mysqli_fetch_all($result, MYSQLI_ASSOC);
            if(empty($qValues)){
                $errors['password'] = 'Incorrect email or password!';
            } else {
                header("Location: user.php?email=".$_POST['email']);
            }

        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    
    <?php include('templates/header.php'); ?>
    
    <section class="container grey-text">
        <h4 class="center">Login</h4>
        <form action="login.php" method="POST" class="white">
            <label>Your Email:</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
            <div class="red-text"><?php echo $errors['email']; ?></div>
            <label>Password:</label>
            <input type="password" name="password" value="<?php echo htmlspecialchars($password) ?>">
            <div class="red-text"><?php echo $errors['password']; ?></div>
            <div class="center">
                <input type="submit" name="submit" value="login" class="btn brand z-depth-0">
            </div>
        </form>
    </section>

    <?php include('templates/footer.php'); ?>

</html>