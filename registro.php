<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_completo = $_POST['txtFullname'];
    $nombre_usuario = $_POST['txtUsername'];
    $correo = $_POST['txtEmail'];
    $contrasena = $_POST['txtPassword'];
    $fecha_nac = $_POST['ffechanacimiento'];
    $genero = isset($_POST['inlineRadioOptions']) ? $_POST['inlineRadioOptions'] : 'no binario';

    $rol = $_POST['idRol'];

    if (isset($_FILES['btnAvatar']) && $_FILES['btnAvatar']['error'] == 0) {
        $foto = file_get_contents($_FILES['btnAvatar']['tmp_name']);
        $mime = $_FILES['btnAvatar']['type'];
    } else {
        $foto = null;
        $mime = null;
    }

    try {
        $sql = "CALL registrar_usuario(:nombre_completo, :nombre_usuario, :correo, :contrasena, :fecha_nac, :genero, :rol, :foto, :mime, @resultado)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':nombre_completo', $nombre_completo);
        $stmt->bindParam(':nombre_usuario', $nombre_usuario);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->bindParam(':fecha_nac', $fecha_nac);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':rol', $rol);
        $stmt->bindParam(':foto', $foto, PDO::PARAM_LOB);
        $stmt->bindParam(':mime', $mime);

        $stmt->execute();

        $result = $conn->query("SELECT @resultado AS resultado")->fetch(PDO::FETCH_ASSOC);

        if ($result['resultado'] == 1) {
            echo "<script>
                    alert('Registro exitoso.');
                    window.location.href = 'login.html';
                  </script>";
        } else {
            echo "<script>
                    alert('El nombre de usuario o el correo ya están registrados.');
                    window.history.back();
                  </script>";
        }
    } catch (PDOException $e) {
        echo "<script>
                alert('Error al registrar el usuario: " . $e->getMessage() . "');
                window.history.back();
              </script>";
    }
}
?>
