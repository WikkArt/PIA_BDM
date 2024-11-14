<?php
require_once("db_connect.php");

class mCategorias {
    public $conexion;

    public function obtenerConexion() {
        $dbObj = new db();
        $this->conexion = $dbObj->conectar();
    }

    public function crear($param) {
        $this->obtenerConexion();
        $query = "CALL nueva_categoria(:nombre, :descripcion, :usuario_creador, @resultado)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':nombre', $param["nombre"]);
        $stmt->bindParam(':descripcion', $param["descripcion"]);
        $stmt->bindParam(':usuario_creador', $param["nombre_usuario"]);
        $stmt->execute();

        $result = $this->conexion->query("SELECT @resultado AS resultado")->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}