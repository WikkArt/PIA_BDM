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

    public function editar($param, $idCurso) {
        $query = "CALL actualizar_curso(:id_curso, :foto, :mime, :categoria, :nombre_curso, :descripcion)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':id_curso', $idCurso);
        $stmt->bindParam(':foto', $param["foto"]);
        $stmt->bindParam(':mime', $param["mime"]);
        $stmt->bindParam(':categoria', $param["idCategoria"]);
        $stmt->bindParam(':nombre_curso', $param["nombre_curso"]);
        $stmt->bindParam(':descripcion', $param["descripcion"]);
        $stmt->execute();

        return 1;
    }

    public function obtenerCursoEditar($idCurso) {
        $query = "SELECT id, foto, mime, categoria_id, nombre, descripcion FROM curso WHERE estatus = 1 AND id = :id";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':id', $idCurso);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerCursosdeInstructor($usuario) {
        $query = "SELECT * FROM curso WHERE estatus = 1 AND usuario_instructor = :usuario";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // A traves de la vista 'lista_cursos' accedemos a la info para el dashboard mas facil
    public function obtenerCursosActivos() {
        $query = "SELECT * FROM lista_cursos";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // A traves de la vista 'infocurso' accedemos a la info de un curso especifico mas facil
    public function obtenerInfoCurso($idCurso) {
        $query = "SELECT * FROM infocurso WHERE id = :id";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':id', $idCurso);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function inscribirCurso($param) {
        $query = "CALL inscribir_curso(:curso_id, :usuario_estudiante, :forma_pago)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':curso_id', $param['curso_id']);
        $stmt->bindParam(':usuario_estudiante', $param['estudiante']);
        $stmt->bindParam(':forma_pago', $param['forma_pago']);
        $stmt->execute();

        return 1;
    }

    public function obtenerInfoNivel($idNivel) {
        $query = "SELECT * FROM infonivel WHERE id = :id";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':id', $idNivel);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}