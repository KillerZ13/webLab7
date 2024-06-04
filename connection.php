<?php
    class crud{
        public static function connect()
        {
            try
            {
                $con=new PDO('mysql:localhost=host; dbname=weblab7','root','');
                return $con;
            }catch (PDOException $error1){
                echo 'Something wrong!'.$error1->getMessage();
            }catch (Exception $error2){
                echo 'Generic error!'.$error2->getMessage();
            }
        }
        public static function Selectdata()
        {
            $data=array();
            $p=crud::connect()->prepare('SELECT * FROM users');
            $p->execute();
            $data=$p->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        public function delete($matric)
        {
            $conn = crud::connect();
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
                $stmt->closeCursor();
            } else {
                return "Error: " . $conn->errorInfo()[2];
            }
        }
        public function update($matric, $name, $password, $role)
        {
            $conn = self::connect();
            $sql = "UPDATE users SET name = name, password = password, role = role WHERE matric = matric";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("ssss", $name, $password, $role, $matric);
                $result = $stmt->execute();
                if ($result) {
                    return true;
                } else {
                    return "Error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                return "Error: " . $conn->error;
            }
        }
    }
?>