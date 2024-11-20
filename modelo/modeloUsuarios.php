<?php
require_once("db_connect.php");

class mUsuarios {
    public $conexion;

    public function obtenerConexion() {
        $dbObj = new db();
        $this->conexion = $dbObj->conectar();
    }

    public function iniciarSesion($param) {
        $this->obtenerConexion();
        $query = "CALL iniciar_sesion(:nombre_usuario, :contrasena, @rol, @estatus, @resultado)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':nombre_usuario', $param["nombre_usuario"]);
        $stmt->bindParam(':contrasena', $param["contrasena"]);
        $stmt->execute();

        $result = $this->conexion->query("SELECT @rol AS rol, @estatus AS estatus, @resultado AS resultado")->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function registrar($param) {
        if(isset($param["nombre_usuario"])){
            $this->obtenerConexion();
            $query = "CALL registrar_usuario(:nombre_completo, :nombre_usuario, :correo, :contrasena, :fecha_nac, :genero, :rol, :foto, :mime, @resultado)";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre_completo', $param["nombre_completo"]);
            $stmt->bindParam(':nombre_usuario', $param["nombre_usuario"]);
            $stmt->bindParam(':correo', $param["correo"]);
            $stmt->bindParam(':contrasena', $param["contrasena"]);
            $stmt->bindParam(':fecha_nac', $param["fecha_nac"]);
            $stmt->bindParam(':genero', $param["genero"]);
            $stmt->bindParam(':rol', $param["rol"]);
            $stmt->bindParam(':foto', $param["foto"], PDO::PARAM_LOB);
            $stmt->bindParam(':mime', $param["mime"]);
            $stmt->execute();

            $result = $this->conexion->query("SELECT @resultado AS resultado")->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function obtenerUsuario($nombre_usuario) {
        $this->obtenerConexion();
        $query = "SELECT nombre_completo, nombre_usuario, rol, correo, genero, fecha_nac, foto, mime FROM usuario WHERE nombre_usuario = :nombre_usuario";
        $consulta = $this->conexion->prepare($query);
        $consulta->bindParam(':nombre_usuario', $nombre_usuario);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerUsuarioEditar($nombre_usuario) {
        $this->obtenerConexion();
        $query = "SELECT nombre_usuario, contrasena, nombre_completo, correo, genero, fecha_nac, foto, mime, rol FROM usuario WHERE nombre_usuario = :nombre_usuario";
        $consulta = $this->conexion->prepare($query);
        $consulta->bindParam(':nombre_usuario', $nombre_usuario);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function editar($param, $nombre_usuario) {
        $this->obtenerConexion();
        $query = "CALL actualizar_usuario(:nombre_usuario, :contrasena, :nombre_completo, :correo, :genero, :fecha_nac, :foto, :mime)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':nombre_usuario', $nombre_usuario);
        $stmt->bindParam(':contrasena', $param["contrasena"]);
        $stmt->bindParam(':nombre_completo', $param["nombre_completo"]);
        $stmt->bindParam(':correo', $param["correo"]);
        $stmt->bindParam(':genero', $param["genero"]);
        $stmt->bindParam(':fecha_nac', $param["fecha_nac"]);
        $stmt->bindParam(':foto', $param["foto"], PDO::PARAM_LOB);
        $stmt->bindParam(':mime', $param["mime"]);
        $stmt->execute();
    }
    
}