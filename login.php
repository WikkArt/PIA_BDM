<?php
require_once 'db_connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_usuario = $_POST['txtUsername'];
    $contrasena = $_POST['txtLPassword'];
    
    try {
        $sql = "CALL iniciar_sesion(:nombre_usuario, :contrasena, @rol, @estatus, @resultado)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':nombre_usuario', $nombre_usuario);
        $stmt->bindParam(':contrasena', $contrasena);

        $stmt->execute();

        $result = $conn->query("SELECT @rol AS rol, @estatus AS estatus, @resultado AS resultado")->fetch(PDO::FETCH_ASSOC);

        if ($result['resultado'] == 1) {
            $_SESSION['usuario'] = $nombre_usuario;
            $_SESSION['rol'] = $result['rol'];

            if ($result['rol'] == 'estudiante') {
                header('Location: dashboard.html');
            } elseif ($result['rol'] == 'instructor') {
                header('Location: instructor.html');
            } elseif ($result['rol'] == 'admin') {
                header('Location: administrador.html');
            }
            exit();
        } elseif ($result['resultado'] == 0) {
            echo "<script>
                    alert('Error: El usuario no existe.');
                    window.history.back();
                  </script>";
        } elseif ($result['resultado'] == 2) {
            echo "<script>
                    alert('Error: Tu cuenta está bloqueada o eliminada.');
                    window.history.back();
                  </script>";
        } elseif ($result['resultado'] == 3) {
            echo "<script>
                    alert('Error: Contraseña incorrecta.');
                    window.history.back();
                  </script>";
        }
    } catch (PDOException $e) {
        echo "<script>
                alert('Error en el inicio de sesión: " . $e->getMessage() . "');
                window.history.back();
              </script>";
    }
}
?>
