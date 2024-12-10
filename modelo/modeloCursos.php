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

    public function listarCursos($palabra_clave, $fecha_inicio, $fecha_fin, $categorias) {
        // Preparamos la consulta base
        $query = "SELECT 
                        C.id, 
                        C.foto AS imagen, 
                        C.nombre AS titulo, 
                        C.descripcion, 
                        U.nombre_completo AS instructor,
                        CG.nombre AS categoria, 
                        SUM(N.precio) AS precio_total 
                FROM curso C 
                JOIN categoria CG ON CG.id = C.categoria_id 
                JOIN usuario U ON U.nombre_usuario = C.usuario_instructor 
                JOIN nivel N ON N.curso_id = C.id 
                WHERE C.estatus = 1 ";

        // Añadimos los filtros a la consulta si están presentes
        if ($palabra_clave != '') {
            $query .= " AND (C.nombre LIKE :palabra_clave OR C.descripcion LIKE :palabra_clave)";
        }
        if ($fecha_inicio) {
            $query .= " AND C.fecha_creacion >= :fecha_inicio";
        }
        if ($fecha_fin) {
            $query .= " AND C.fecha_creacion <= :fecha_fin";
        }
        if (!empty($categorias)) {
            $query .= " AND C.categoria_id IN (" . implode(',', $categorias) . ")";
        }

        // Agrupamos por el ID del curso
        $query .= " GROUP BY C.id";

        // Preparamos la consulta para ejecutarla
        $stmt = $this->conexion->prepare($query);

        // Vinculamos los parámetros con los filtros
        if ($palabra_clave != '') {
            $stmt->bindValue(':palabra_clave', "%" . $palabra_clave . "%");
        }
        if ($fecha_inicio) {
            $stmt->bindValue(':fecha_inicio', $fecha_inicio);
        }
        if ($fecha_fin) {
            $stmt->bindValue(':fecha_fin', $fecha_fin);
        }

        // Ejecutamos la consulta
        $stmt->execute();

        // Devolvemos los resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}