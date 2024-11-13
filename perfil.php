<?php
session_start();

if (!isset($_SESSION['usuario']) || !isset($_SESSION['rol'])) {
    echo json_encode(['error' => 'No has iniciado sesión.']);
    exit();
}

require_once 'db_connect.php';

$nombre_usuario = $_SESSION['usuario'];

try {
    $sql = "SELECT nombre_completo,nombre_usuario, rol, correo, genero, fecha_nac, foto, mime FROM usuario WHERE nombre_usuario = :nombre_usuario";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre_usuario', $nombre_usuario);
    $stmt->execute();
    $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$userInfo) {
        echo json_encode(['error' => 'No se encontró la información del usuario.']);
        exit();
    }

    $userInfo['foto'] = $userInfo['foto'] ? base64_encode($userInfo['foto']) : null; 
    echo json_encode($userInfo);

} catch (PDOException $e) {
    echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
}
?>