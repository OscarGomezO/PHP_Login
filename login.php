<?php
    session_start();

    require 'database.php';

    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $records = $connection->prepare('SELECT id, email, password FROM users WHERE email=:email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $message = '';

        if(count($results)> 0 && password_verify($_POST['password'], $results['password'])){
            $_SESSION['user_id'] = $results['id'];
            header('location: /php-login');
        }else{
            $message = "Sorry, These credentials do not match";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Yusei+Magic&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
    <?php require 'partials/header.php' ?>
    <h1>Login</h1>
    <span>or <a href="singup.php">Singup</a></span>
    
    <?php if (!empty($message)):?>
        <p><?= $message ?></p>
    <?php endif; ?>
    
    <form action="login.php" method="post">
        <input type="text" name="email" placeholder="Enter your Email">
        <input type="password" name="password" placeholder="Enter your Password">
        <input type="submit" value="Send">
    </form>
</body>
</html>