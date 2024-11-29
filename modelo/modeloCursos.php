<?php
require_once("db_connect.php");

class mCursos{
    private $conexion;
    public function __construct() {
        $dbObj = new db();
        $this->conexion = $dbObj->conectar();
    }

    public function crear($param, $link, $recursos) {
        $query = "CALL nuevo_curso(:curso, :descripcion, :foto, :mime, :nombre_usuario, :categoria, @resultado)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':curso', $param["nombre_curso"]);
        $stmt->bindParam(':descripcion', $param["descripcion"]);
        $stmt->bindParam(':foto', $param["foto"]);
        $stmt->bindParam(':mime', $param["mime"]);
        $stmt->bindParam(':nombre_usuario', $param["nombre_usuario"]);
        $stmt->bindParam(':categoria', $param["idCategoria"]);
        $stmt->execute();

        $result = $this->conexion->query("SELECT @resultado AS resultado")->fetch(PDO::FETCH_ASSOC);

        //Agregar nivel
        $this->agregarNivel($param, $link, $recursos);

        return $result;
    }

    public function agregarNivel($param, $link, $recursos) {
        $query = "CALL nuevo_nivel(:nivel, :video, :precio)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':nivel', $param["nivel"]);
        $stmt->bindParam(':video', $param["videoNivel"]);
        $stmt->bindParam(':precio', $param["precioNivel"]);
        $stmt->execute();
        //Agregar el arreglo de recursos y links
        if($link != null) {
            $query2 = "CALL nuevo_recurso(:link)";
            $stmt2 = $this->conexion->prepare($query2);
            $stmt2->bindParam(':link', $link);
            $stmt2->execute();
        }
        if($recursos != null) {
            foreach ($recursos as $archivo) {
                $q = "CALL nuevo_recurso(:archivo)";
                $st = $this->conexion->prepare($q);
                $st->bindParam(':archivo', $archivo);
                $st->execute();
            }
        }
        return 1;
    }

    public function obtenerCursosActivos($usuario) {
        $query = "SELECT * FROM curso WHERE estatus = 1 AND usuario_instructor = :usuario";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}