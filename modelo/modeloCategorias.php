<?php 
require_once("db_connect.php");

class mCategorias {
    private $conexion;
    public function __construct() {
        $dbObj = new db();
        $this->conexion = $dbObj->conectar();
    }

    public function crear($param) {
        $query = "CALL nueva_categoria(:nombre, :descripcion, :usuario_creador, @resultado)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':nombre', $param["nombre"]);
        $stmt->bindParam(':descripcion', $param["descripcion"]);
        $stmt->bindParam(':usuario_creador', $param["nombre_usuario"]);
        $stmt->execute();

        $result = $this->conexion->query("SELECT @resultado AS resultado")->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function obtenerCategoriasPorUsuario($usuario) {
        $query = "SELECT id, nombre, descripcion, DATE(fecha_creacion) AS fecha, TIME(fecha_creacion) AS hora
                  FROM categoria
                  WHERE usuario_creador = :usuario AND estatus = 1";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function obtenerCategoriaPorId($id) {
        $query = "SELECT id, nombre, descripcion FROM categoria WHERE id = :id AND estatus = 1";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function actualizarCategoria($id, $nombre, $descripcion) {
        $query = "UPDATE categoria SET nombre = :nombre, descripcion = :descripcion WHERE id = :id AND estatus = 1";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        return $stmt->execute();
    }
    
    public function eliminarCategoria($id) {
        $query = "UPDATE categoria SET estatus = 0 WHERE id = :id";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function obtenerCategoriasActivas() {
        $query = "SELECT * FROM categoria WHERE estatus = 1";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
