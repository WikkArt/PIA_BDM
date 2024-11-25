<?php
require_once("db_connect.php");

class mCursos{
    public $conexion;

    public function obtenerConexion() {
        $dbObj = new db();
        $this->conexion = $dbObj->conectar();
    }

    
}