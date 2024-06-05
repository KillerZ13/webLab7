<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./signup.css">
    <title>Sign Up</title>
</head>
<body>
    <?php
        session_start();
        require('./connection.php');
        if (isset($_POST['button']))
        {
            $matric = $_POST['matric'];
            $name = $_POST['name'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            
            if (!empty($matric) && !empty($name) && !empty($password) && !empty($role))
            {
                $p = Crud::connect()->prepare('INSERT INTO users(matric, name, password, role) VALUES(:m, :n, :p, :r)');
                $p->bindValue(':m', $matric);
                $p->bindValue(':n', $name);
                $p->bindValue(':p', $password);
                $p->bindValue(':r', $role);
                $p->execute();
                echo 'Successfully!';
                
                if ($p->rowCount() > 0) {
                    $_SESSION['validate'] = true;
                    header("Location: login.php");
                    exit();
            } else {
                echo 'Please fill all the fields!';
            }
        }
        }
    ?>
    <div class="signup-form">
        <h2>Sign Up</h2>
        <form action="" method="POST">
            <label for="matric">Matric Number</label>
            <input type="text" id="matric" name="matric" required>
            
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="" disabled selected>Select your role</option>
                <option value="student">Student</option>
                <option value="lecturer">Lecturer</option>
            </select>
            <button type="submit" name="button">Sign Up</button>
        </form>
    </div>
</body>
</html>
