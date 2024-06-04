<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./table.css">
    <title>Document</title>
</head>

</body>
    <br>
    <br>
    <h1 style="text-align: center;">Welcome To My Database System</h1>
    <br>
    <table>
        <thead>
            <tr>
                <th>Matric</th>
                <th>Name</th>
                <th>Password</th>
                <th>Role</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
        <?php
            require('./connection.php');
            $data = Crud::selectData();
            if (isset($_GET['delete'])) {
                $matric = $_GET['delete'];
                $result = (new Crud())->delete($matric);
                if ($result === true) {
                    echo "Record deleted successfully.";
                } else {
                    echo "Error deleting record: " . $result;
                }
            }
            if (count($data) > 0) 
            {
                foreach ($data as $row) 
                {
                    echo '<tr>';
                    echo '<td>' . $row['matric'] . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['password'] . '</td>';
                    echo '<td>' . $row['role'] . '</td>';
                    echo '<td><a href="?delete=' . $row['matric'] . '">Delete</a></td>';
                    echo '<td><a href="update.php?matric=' . $row['matric'] . '">Update</a></td>';
                    echo '</tr>';
                }
            }
            ?>
        </tbody>
    </table>
</body>
</html>