<?php

    //db connection
    include('config/db_connect.php');
    $email = $_GET['email'];
    //write query for all pizzas
    $sql = "SELECT title, ingredients, id FROM pizzas 
                WHERE email = '$email'
                    ORDER BY created_at";
    
    //make quaries and get results
    $result = mysqli_query($conn, $sql);
    
    //fetch the resulting rows as array
    $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //feee reslut from memory
    mysqli_free_result($result);

    //close connection
    mysqli_close($conn);

    //print_r($pizzas);

?>

<!DOCTYPE html>
<html>

    <?php include('templates/header.php'); ?>
    <section>
    <h4 class="center white-text"><i>PIZZAS</i></h4>
        <div class="photo-album">
        <?php foreach ($pizzas as $pizza): ?>
            <div class="photo-frame">
                <div class="photo">
                    <img src="img/bg-pizza2.jpg" alt="">
                </div>
                <div class="photo-detail center">
                    <h4><?php echo htmlspecialchars($pizza['title']);?></h4>
                    <ul>
                        <?php foreach(explode(',', $pizza['ingredients']) as $ing):?>
                            <li><?php echo htmlspecialchars($ing);?></li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
            <div>
                <a href="details.php?id=<?php echo $pizza['id']?>"><b>MORE INFO</b></a>
            </div>
        <?php endforeach;?>
        </div>
    </section>

    <?php include('templates/footer.php'); ?>

</html>