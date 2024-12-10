<?php

require_once("modelo/modeloChat.php");

class chat {
    public $chatObj;
    public $respuesta;

    public function __construct() {
        $this->chatObj = new mChat();
    }

    // Mostrar lista de usuarios
    public function listarUsuarios() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $currentId = $_SESSION['usuario']; // Suponiendo que el ID del usuario está en la sesión

        $usuarios = $this->chatObj->obtenerUsuarios($currentId);
        $this->respuesta = array("state" => true, "usuarios" => $usuarios);
        return $this->respuesta;
    }

    // En el controlador chat_controlador.php
    public function obtenerUsuarioChat($chatId) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($chatId)) {
            $usuario = $this->chatObj->obtenerUsuarioPorChatId($chatId);

            // Log para depurar si la consulta encontró o no el usuario
            if ($usuario) {
                error_log("Usuario encontrado para el chatId: $chatId");
                $this->respuesta = array("state" => true, "usuario" => $usuario);
            } else {
                error_log("No se encontró usuario para el chatId: $chatId");
                $this->respuesta = array("state" => false, "message" => "Usuario no encontrado para este chat.");
            }
        } else {
            $this->respuesta = array("state" => false, "message" => "No chatId provided.");
        }
        return $this->respuesta;
    }



    // Mostrar mensajes de una conversación
    public function obtenerMensajes($chatId) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($chatId)) {
            $messages = $this->chatObj->obtenerMensajes($chatId);
            $this->respuesta = array("state" => true, "messages" => $messages);
        } else {
            $this->respuesta = array("state" => false, "message" => "No chatId provided.");
        }
        return $this->respuesta;
    }

    // Crear una nueva conversación o recuperar una existente
    public function obtenerConversacion() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $currentId = $_SESSION['usuario'];
        if (isset($_GET['userId'])) {
            $otherUserId = $_GET['userId'];
            $conversationId = $this->chatObj->obtenerConversacionId($currentId, $otherUserId);
            $this->respuesta = array("state" => true, "conversationId" => $conversationId);
        } else {
            $this->respuesta = array("state" => false, "message" => "No userId provided.");
        }
        return $this->respuesta;
    }

    // Enviar un mensaje
    public function enviarMensaje() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_POST['chatId']) && isset($_POST['message'])) {
            $chatId = $_POST['chatId'];
            $message = $_POST['message'];
            $envioId = $_SESSION['usuario']; // ID del usuario que envía el mensaje
            $this->chatObj->enviarMensaje($chatId, $envioId, $message);
            $this->respuesta = array("state" => true, "message" => "Mensaje enviado.");
        } else {
            $this->respuesta = array("state" => false, "message" => "Faltan datos.");
        }
        return $this->respuesta;
    }
}
?>
