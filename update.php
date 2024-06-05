<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./signup.css">
    <title>Update User</title>
</head>
<body>
    <?php
        session_start();
        require('./connection.php');

        if (isset($_POST['button'])) {
            $matric = $_POST['matric'];
            $name = $_POST['name'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            if (!empty($matric) && !empty($name) && !empty($password) && !empty($role)) {
                try {
                    $crud = new crud();
                    $updateResult = $crud->update($matric, $name, $password, $role);

                    if ($updateResult === true) {
                        $_SESSION['validate'] = true;
                        header("Location: users.php");
                        exit();
                    } else {
                        echo 'Update failed: ' . $updateResult;
                    }
                } catch (PDOException $e) {
                    echo 'Error: ' . $e->getMessage();
                }
            } else {
                echo 'Please fill all the fields!';
            }
        }
    ?>
    <div class="signup-form">
        <h2>Update User</h2>
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
            <button type="submit" name="button">Update</button>
        </form>
    </div>
</body>
</html>
