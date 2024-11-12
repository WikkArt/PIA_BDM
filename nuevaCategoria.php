<?php
session_start();

if (!isset($_SESSION['usuario']) || !isset($_SESSION['rol'])) {
    echo json_encode(['error' => 'No has iniciado sesión.']);
    exit();
}
require_once 'db_connect.php';
$nombre_usuario = $_SESSION['usuario'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['txtCategory'];
    $descripcion = $_POST['txtDesc'];

    try {
        $sql = "CALL nueva_categoria(:nombre, :descripcion, :usuario_creador, @resultado)";
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':usuario_creador', $nombre_usuario);

        $stmt->execute();

        $result = $conn->query("SELECT @resultado AS resultado")->fetch(PDO::FETCH_ASSOC);

        if ($result['resultado'] == 1) {
            echo "<script>
                    alert('Categoria creada exitosamente.');
                    window.location.href = 'administrador.html';
                  </script>";
        } else {
            echo "<script>
                    alert('La categoria ya ha sido registrada.');
                    window.history.back();
                  </script>";
        }
    } catch (PDOException $e) {
        echo "<script>
                alert('Error al registrar la categoria: " . $e->getMessage() . "');
                window.history.back();
              </script>";
    }
}
?>