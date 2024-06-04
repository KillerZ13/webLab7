<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./login.css">
    <title>Log in</title>
    <style>
        .form {
            width: 230px;
            height: 300px;
        }
    </style>
</head>
<body>

<?php
    session_start();
    require("./connection.php");

    if (isset($_POST["login_button"])) {
        $_SESSION['validate'] = false;
        $matric = $_POST['matric'];
        $password = $_POST['password'];
        
        $p = crud::connect()->prepare('SELECT * FROM users WHERE matric=:m AND password=:p');
        $p->bindValue(':m', $matric);
        $p->bindValue(':p', $password);
        $p->execute();
        $d = $p->fetchAll(PDO::FETCH_ASSOC);
        
        if ($p->rowCount() > 0) {
            $_SESSION['matric'] = $matric;
            $_SESSION['pass'] = $password;
            $_SESSION['validate'] = true;
            header("Location: users.php");
            exit();
        } else {
            echo 'Make sure that you are registered!';
        }
    }
?>


    <div class="login-form">
        <h2>Login</h2>
        <form action="" method="POST">
            <input type="text" name="matric" placeholder="Matric">
            <input type="password" name="password" placeholder="Password">
            <input type="submit" value="Login" name="login_button">
            <input type="button" value="Register here" name="register_button">

        </form>
    </div>
</body>
</html>
