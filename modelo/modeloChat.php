<?php
require_once("db_connect.php");

class mChat {
    public $conexion;

    // Método para obtener la conexión a la base de datos
    public function obtenerConexion() {
        $dbObj = new db();
        $this->conexion = $dbObj->conectar();
    }

    // Obtener usuarios (excepto el usuario actual)
    public function obtenerUsuarios($currentId) {
        $this->obtenerConexion();
        $query = "SELECT nombre_usuario, nombre_completo, foto 
                FROM usuario 
                WHERE nombre_usuario != :currentId 
                AND estatus = 'activo'";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':currentId', $currentId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // En modeloChat.php
    public function obtenerUsuarioPorChatId($chatId) {
        $this->obtenerConexion();
        $query = "SELECT u.nombre_usuario, u.nombre_completo, u.foto 
                FROM usuario u
                JOIN mensaje m ON m.emisor = u.nombre_usuario 
                WHERE m.chat_id = :chat_id 
                LIMIT 1"; // Solo uno porque es una conversación con un solo usuario
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':chat_id', $chatId);
        $stmt->execute();

        error_log("Query ejecutado: $query");
        return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve el usuario
    }


    // Obtener los mensajes de una conversación
    public function obtenerMensajes($chat_id) {
        $this->obtenerConexion();
        $query = "SELECT m.texto, m.fecha, u.nombre_completo, u.foto, u.mime
                  FROM mensaje m
                  JOIN usuario u ON m.emisor = u.nombre_usuario
                  WHERE m.chat_id = :chat_id
                  ORDER BY m.fecha ASC";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':chat_id', $chat_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear o recuperar una conversación
    public function obtenerConversacionId($currentId, $otherUserId) {
        $this->obtenerConexion();
        $query = "CALL obtener_conversacion(:usuario1, :usuario2, @chat_id)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':usuario1', $currentId);
        $stmt->bindParam(':usuario2', $otherUserId);
        $stmt->execute();

        // Recuperamos el chat_id
        $result = $this->conexion->query("SELECT @chat_id AS chat_id")->fetch(PDO::FETCH_ASSOC);
        
        return $result['chat_id'];
    }

    // Enviar mensaje a una conversación
    public function enviarMensaje($chat_id, $emisor, $mensaje) {
        $this->obtenerConexion();
        $query = "CALL enviar_mensaje(:chat_id, :emisor, :mensaje)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':chat_id', $chat_id);
        $stmt->bindParam(':emisor', $emisor);
        $stmt->bindParam(':mensaje', $mensaje);
        $stmt->execute();
    }
}
?>