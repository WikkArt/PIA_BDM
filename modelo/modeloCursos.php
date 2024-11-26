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
        $query2 = "CALL nuevo_nivel(:nivel, :video, :precio)";
        $stmt2 = $this->conexion->prepare($query2);
        $stmt2->bindParam(':nivel', $param["nivel"]);
        $stmt2->bindParam(':video', $param["videoNivel"]);
        $stmt2->bindParam(':precio', $param["precioNivel"]);
        $stmt2->execute();
        //Agregar el arreglo de recursos y links
        if($link != null) {
            $query3 = "CALL nuevo_recurso(:archivo)";
            $stmt3 = $this->conexion->prepare($query3);
            $stmt3->bindParam(':archivo', $link);
            $stmt3->execute();
        }
        if($recursos != null) {
            foreach ($recursos as $archivo) {
                $q = "CALL nuevo_recurso(:archivo)";
                $st = $this->conexion->prepare($q);
                $st->bindParam(':archivo', $archivo);
                $st->execute();
            }
        }

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
            $query2 = "CALL nuevo_recurso(:archivo)";
            $stmt2 = $this->conexion->prepare($query2);
            $stmt2->bindParam(':archivo', $link);
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
}