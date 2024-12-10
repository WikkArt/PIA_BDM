<?php

class db {

    public function conectar() {
        try {
            $host = 'localhost';
            $db = 'bdm_db';
            $user = 'root';
            $password = '';
            $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
        return $conn;
    }
}
?>
