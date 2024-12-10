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

    // Obtenemos la info de la vista 'kardexinfo'
    public function obtenerKardex($nombre_usuario) {
        $this->obtenerConexion();
        $query = "SELECT * FROM kardexinfo WHERE usuario_estudiante = :nombre_usuario";
        $consulta = $this->conexion->prepare($query);
        $consulta->bindParam(':nombre_usuario', $nombre_usuario);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizarUltimoIngreso($param) {
        $this->obtenerConexion();
        $query = "UPDATE inscripcion_estudiante SET ultimo_ingreso = :hoy WHERE curso_id = :curso_id AND usuario_estudiante = :usuario";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':hoy', $param['fecha']);
        $stmt->bindParam(':curso_id', $param['curso_id']);
        $stmt->bindParam(':usuario', $param['usuario']);
        $stmt->execute();
    }

    public function obtenerInfoCursoInscrito($idCurso, $usuario) {
        $this->obtenerConexion();
        $query = "SELECT * FROM infocursoinscrito WHERE id = :idCurso AND estudiante = :nombre_usuario";
        $consulta = $this->conexion->prepare($query);
        $consulta->bindParam(':idCurso', $idCurso);
        $consulta->bindParam(':nombre_usuario', $usuario);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerMisVentasGeneral($usuario) {
        $this->obtenerConexion();
        $query = "SELECT * FROM cursos_general WHERE usuario_instructor = :nombre_usuario";
        $consulta = $this->conexion->prepare($query);
        $consulta->bindParam(':nombre_usuario', $usuario);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerNivelPromediodeMiCurso($curso_id) {
        $this->obtenerConexion();
        $query = "CALL nivel_promedio_cursado(:id)";
        $consulta = $this->conexion->prepare($query);
        $consulta->bindParam(':id', $curso_id);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerMisVentasDetalle($curso_id) {
        $this->obtenerConexion();
        $query = "SELECT * FROM ventasDetalle WHERE idCurso = :id";
        $consulta = $this->conexion->prepare($query);
        $consulta->bindParam(':id', $curso_id);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    
}