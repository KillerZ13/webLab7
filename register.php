<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #278099 0%, #63a4ff 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .register-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .register-form h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .register-form input,
        .register-form select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .register-form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .register-form input[type="submit"]:hover {
            background-color: #45a049;
        }
        .register-form .fa {
            margin-right: 10px;
        }
        .register-form .form-icon {
            font-size: 24px;
            color: #4CAF50;
        }
    </style>
</head>
<body>

<?php
    session_start();
    require_once("./connection.php");

    if (isset($_POST["register_button"])) {
        if (isset($_POST['matric'], $_POST['name'], $_POST['password'], $_POST['role'])) {
            $matric = $_POST['matric'];
            $name = $_POST['name'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            
            $stmt = crud::connect()->prepare('INSERT INTO users (matric, name, password, role) VALUES (:m, :n, :p , :r)');
            $stmt->bindValue(':m', $matric);
            $stmt->bindValue(':n', $name);
            $stmt->bindValue(':p', $password);
            $stmt->bindValue(':r', $role);
            
            if ($stmt->execute()) {
                header("Location: login.php");
                exit();
            } else {
                echo 'Registration failed. Please try again.';
            }
        } else {
            //echo 'Please fill in all required fields.';
        }
    }
?>

    <div class="register-form">
        <i class="fas fa-user-plus form-icon"></i>
        <h2>Register</h2>
        <form action="" method="POST">
            <input type="text" name="matric" placeholder="Matric" required>
            <input type="text" name="name" placeholder="Name" required>
            <input type="password" name="password" placeholder="Password" required>
            <select id="role" name="role" required>
                <option value="" disabled selected>Select your role</option>
                <option value="student">Student</option>
                <option value="lecturer">Lecturer</option>
            </select>
            <input type="submit" value="Register" name="register_button">
        </form>
    </div>
</body>
</html>
