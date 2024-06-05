<?php
class crud {
    private static $pdo = null;

    public static function connect() {
        if (self::$pdo == null) {
            try {
                self::$pdo = new PDO('mysql:host=localhost;dbname=webLab7', 'matric', 'password');
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Error: ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }

    public static function Selectdata() {
        $data = array();
        $p = self::connect()->prepare('SELECT * FROM users');
        $p->execute();
        $data = $p->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function delete($matric) {
        $conn = self::connect();
        $sql = "DELETE FROM users WHERE matric = :matric";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bindParam(':matric', $matric);
            $result = $stmt->execute();
            if ($result) {
                return true;
            } else {
                return "Error: " . $stmt->errorInfo()[2];
            }
        } else {
            return "Error: " . $conn->errorInfo()[2];
        }
    }

    public function update($matric, $name, $password, $role) {
        $conn = self::connect();
        $sql = "UPDATE users SET name = :name, password = :password, role = :role WHERE matric = :matric";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':password', $password);
            $stmt->bindValue(':role', $role);
            $stmt->bindValue(':matric', $matric);
            $result = $stmt->execute();
            if ($result) {
                return true;
            } else {
                return "Error: " . $stmt->errorInfo()[2];
            }
        } else {
            return "Error: " . $conn->errorInfo()[2];
        }
    }
}
?>
