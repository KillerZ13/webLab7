<?php
require_once('connection.php');

class Crud {
    public static function selectData() {
        $conn = Database::connect();
        $stmt = $conn->prepare('SELECT * FROM users');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($matric) {
        $conn = Database::connect();
        $stmt = $conn->prepare('DELETE FROM users WHERE matric = :matric');
        $stmt->bindParam(':matric', $matric);
        return $stmt->execute();
    }

    public function update($matric, $name, $password, $role) {
        $conn = Database::connect();
        $stmt = $conn->prepare('UPDATE users SET name = :name, password = :password, role = :role WHERE matric = :matric');
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':matric', $matric);
        return $stmt->execute();
    }
}
?>
