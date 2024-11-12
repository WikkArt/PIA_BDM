<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.html');
    exit();
}

require_once 'db_connect.php'; 

$nombre_usuario = $_SESSION['usuario'];
$contrasena = $_POST['txtPassword'];
$nombre_completo = $_POST['txtFullname'];
$correo = $_POST['txtEmail'];
$genero = $_POST['inlineRadioOptions'];
$fecha_nac = $_POST['ffechanacimiento'];

if ($_FILES['btnAvatar']['size'] > 0) {
    $foto = file_get_contents($_FILES['btnAvatar']['tmp_name']);
    $mime = $_FILES['btnAvatar']['type'];
} else {
    $foto = null; 
    $mime = null; 
}

try {
    $sql = "CALL actualizar_usuario(:nombre_usuario, :contrasena, :nombre_completo, :correo, :genero, :fecha_nac, :foto, :mime)";
    $stmt = $conn->prepare($sql);
    
    $stmt->bindParam(':nombre_usuario', $nombre_usuario);
    $stmt->bindParam(':contrasena', $contrasena);
    $stmt->bindParam(':nombre_completo', $nombre_completo);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':genero', $genero);
    $stmt->bindParam(':fecha_nac', $fecha_nac);
    $stmt->bindParam(':foto', $foto, PDO::PARAM_LOB);
    $stmt->bindParam(':mime', $mime);
    
    $stmt->execute();

    if ($rol == 'estudiante') {
        header('Location: estudiante.html');
    } elseif ($rol == 'instructor') {
        header('Location: instructor.html');
    } else {
        header('Location: administrador.html');
    }

} catch (PDOException $e) {
    echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    header('Location: editarUsuario.html');
}
?>
