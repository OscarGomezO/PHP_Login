<?php
    require "database.php";

    $message = '';

    if(!empty($_POST["email"])&& !empty($_POST["password"])){
        $sql = "INSERT INTO users (email, password) VALUES (:email, :password )";
        $statement = $connection->prepare($sql);
        $statement->bindParam(':email', $_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $statement->bindParam(':password', $password);

        if($statement->execute()){
            $message = 'Successfully created new User';
        }else{
                $message = 'Sorry There  must have been an issue creating your User/ERROR';
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SingUp</title>
    <link href="https://fonts.googleapis.com/css2?family=Yusei+Magic&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
        <p><?= $message ?></p>
    <?php endif; ?>

    <h1>SingUp</h1>
    <span>or <a href="login.php">Login</a></span>
    
    <form action="singup.php" method="post">
        <input type="text" name="email" placeholder="Enter your Email">
        <input type="password" name="password" placeholder="Enter your Password">
        <input type="password" name="confirm_password" placeholder="Confirm your Password">
        <input type="submit" value="Send">
    </form>
</body>
</html>