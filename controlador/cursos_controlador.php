<?php
require_once("modelo/modeloCursos.php");

session_start();

class cursos {
    public $cursoObj;
    public $vista;
    public $respuesta;

    public function __construct() {
        $this->cursoObj = new mCursos();
    }

    public function crear() {
        $this->vista = 'nuevoCurso';

        if (!isset($_SESSION['usuario']) || !isset($_SESSION['rol'])) {
            echo json_encode(['error' => 'No has iniciado sesión.']);
            exit();
        }

        try{
            if(isset($_POST['txtCourse']) && isset($_POST['txtDesc'])&& isset($_POST['txtLevel'])){

                if ($_FILES['promo']['size'] > 0) {
                    $foto = file_get_contents($_FILES['promo']['tmp_name']);
                    $mime = $_FILES['promo']['type'];
                } else {
                    $foto = null;
                    $mime = null;
                }

                if ($_FILES['video']['error'] > 0) {
                    echo "<script>
                            alert('Error al guardar nivel: " . $_FILES['video']['error'] . "');
                        </script>";
                } else {
                    //Guardar niveles subidos en la carpeta videos
                    $rutavideoNivel = "videos/" .$_SESSION['usuario']."_".$_POST['txtLevel']."_".$_FILES['video']['name'];
                    move_uploaded_file($_FILES['video']['tmp_name'], $rutavideoNivel);
                }

                $datos = array(
                    "nombre_curso" => $_POST['txtCourse'],
                    "descripcion" => $_POST['txtDesc'],
                    "foto" => $foto,
                    "mime" => $mime,
                    "nombre_usuario" => $_SESSION['usuario'],
                    "idCategoria" => $_POST['idCategoria'],
                    "videoNivel" => $rutavideoNivel,
                    "nivel" => $_POST['txtLevel'],
                    "precioNivel" => $_POST['txtLevelPrice']
                );

                if($_POST['txtLink'] != null) {
                    $linkNivel = $_POST['txtLink'];
                } else {
                    $linkNivel = null;
                }
                $recursos = array();
                if($_FILES['recurso']['name'][0] != null || $_FILES['recurso']['name'][1] != null ||
                    $_FILES['recurso']['name'][2] != null || $_FILES['recurso']['name'][3] != null) {
                    //Arreglo de recursos
                    $totalRec = count($_FILES['recurso']['name']);
                    for ($i = 0; $i < $totalRec; $i++) { 
                        //Guardar archivos subidos en la carpeta recursos
                        if($_FILES['recurso']['size'][$i] > 0) {
                            $rutaRecurso = "recursos/" .$_SESSION['usuario']."_".$_POST['txtLevel']."_".$_FILES['recurso']['name'][$i];
                            move_uploaded_file($_FILES['recurso']['tmp_name'][$i], $rutaRecurso);
                            array_push($recursos, $rutaRecurso);
                        }
                    }
                } else {
                    $recursos = null;
                }
                
                $result = $this->cursoObj->crear($datos, $linkNivel, $recursos);

                $this->respuesta = array("state" => true);
                if ($result['resultado'] == 1) {
                    echo "<script>
                            if(confirm('¿Desea agregar otro nivel?') == true) {
                                window.location.href = 'index.php?controlador=cursos&accion=agregarNivel';
                            } else {
                                alert('Nuevo curso creado.');
                                window.location.href = 'index.php?controlador=usuarios&accion=mostrarDatos';
                            }
                          </script>";
                }
            }
        }catch(PDOException $e){
            $this->respuesta = array("state" => false);
            echo "<script>
                    alert('Error al crear el curso: " . $e->getMessage() . "');
                    window.history.back();
                </script>";
        }
        return $this->respuesta;
    }

    public function agregarNivel() {
        $this->vista = 'nuevoNivel';

        if (!isset($_SESSION['usuario']) || !isset($_SESSION['rol'])) {
            echo json_encode(['error' => 'No has iniciado sesión.']);
            exit();
        }

        try{
            if(isset($_POST['txtLevel']) && isset($_POST['txtLevelPrice'])){

                if ($_FILES['video']['error'] > 0) {
                    echo "<script>
                            alert('Error al guardar nivel: " . $_FILES['video']['error'] . "');
                        </script>";
                } else {
                    //Guardar niveles subidos en la carpeta videos
                    $rutavideoNivel = "videos/" .$_SESSION['usuario']."_".$_POST['txtLevel']."_".$_FILES['video']['name'];
                    move_uploaded_file($_FILES['video']['tmp_name'], $rutavideoNivel);
                }

                $datos = array(
                    "videoNivel" => $rutavideoNivel,
                    "nivel" => $_POST['txtLevel'],
                    "precioNivel" => $_POST['txtLevelPrice']
                );

                if($_POST['txtLink'] != null) {
                    $linkNivel = $_POST['txtLink'];
                } else {
                    $linkNivel = null;
                }
                $recursos = array();
                if($_FILES['recursoNivel']['name'][0] != null || $_FILES['recursoNivel']['name'][1] ||
                    $_FILES['recursoNivel']['name'][2] || $_FILES['recursoNivel']['name'][3]) {
                    //Arreglo de recursos
                    $totalRec = count($_FILES['recursoNivel']['name']);
                    for ($i = 0; $i < $totalRec; $i++) { 
                        //Guardar archivos subidos en la carpeta recursos
                        if($_FILES['recursoNivel']['size'][$i] > 0) {
                            $rutaRecurso = "recursos/" .$_SESSION['usuario']."_".$_POST['txtLevel']."_".$_FILES['recursoNivel']['name'][$i];
                            move_uploaded_file($_FILES['recursoNivel']['tmp_name'][$i], $rutaRecurso);
                            array_push($recursos, $rutaRecurso);
                        }
                    }
                } else {
                    $recursos = null;
                }
                
                $result = $this->cursoObj->agregarNivel($datos, $linkNivel, $recursos);

                $this->respuesta = array("state" => true);
                if ($result == 1) {
                    echo "<script>
                            if(confirm('¿Desea agregar otro nivel?') == true) {
                                window.location.href = 'index.php?controlador=cursos&accion=agregarNivel';
                            } else {
                                alert('Nuevo curso creado.');
                                window.location.href = 'index.php?controlador=usuarios&accion=mostrarDatos';
                            }
                          </script>";
                }
            }
        }catch(PDOException $e){
            $this->respuesta = array("state" => false);
            echo "<script>
                    alert('Error al agregar nivel: " . $e->getMessage() . "');
                    window.history.back();
                </script>";
        }
        return $this->respuesta;
    }

    public function editar() {
        $this->vista = "editarCurso";

        if (!isset($_SESSION['usuario']) || !isset($_SESSION['foto'])) {
            echo json_encode(['error' => 'No has iniciado sesión.']);
            exit();
        }

        if(isset($_POST['txtCourse'])&&isset($_POST['txtDesc'])){
            try {
            if ($_FILES['promo']['size'] > 0) {
                $foto = file_get_contents($_FILES['promo']['tmp_name']);
                $mime = $_FILES['promo']['type'];
            } else {
                $foto = null;
                $mime = null;
            }

            $datos = array(
                'foto' => $foto,
                'mime' => $mime,
                'idCategoria' => $_POST['idCategoria'],
                'nombre_curso' => $_POST['txtCourse'],
                'descripcion' => $_POST['txtDesc']
            );

            $idCursoStr = $_GET['idCurso'];
            $idCurso = (int)$idCursoStr;
            $this->cursoObj->editar($datos, $idCurso);
            header('Location: index.php?controlador=cursos&accion=mostrardeInstructor');
            
            } catch (PDOException $e) {
                $this->respuesta = array("state" => false);
                echo "<script>alert('Error: ". $e->getMessage() ."');</script>";
                header('Location: index.php?controlador=cursos&accion=editar&idCurso='.$idCurso);
            }
        }else{
            $idCursoStr = $_GET['idCurso'];
            $idCurso = (int)$idCursoStr;
            $infoCurso = $this->cursoObj->obtenerCursoEditar($idCurso);
            $this->respuesta = array(
                "state" => true,
                "cursoInfo" =>$infoCurso
            );
            return $this->respuesta;
        }
    }

    public function mostrardeInstructor() {
        $this->vista = 'tablaCursos';

        if (!isset($_SESSION['usuario']) || !isset($_SESSION['rol'])) {
            echo json_encode(['error' => 'No has iniciado sesión.']);
            exit();
        }

        return $this->cursoObj->obtenerCursosdeInstructor($_SESSION['usuario']);
    }

    public function listar() {
        $this->vista = 'dashboard';

        // Recibimos los filtros desde el formulario
        $palabra_clave = isset($_POST['txtBuscar']) ? $_POST['txtBuscar'] : '';
        $fecha_inicio = isset($_POST['txtDateFromG']) && $_POST['txtDateFromG'] != '' ? $_POST['txtDateFromG'] : null;
        $fecha_fin = isset($_POST['txtDateToG']) && $_POST['txtDateToG'] != '' ? $_POST['txtDateToG'] : null;
        $categorias = isset($_POST['categorias']) ? $_POST['categorias'] : [];

        // Llamamos a la función en el modelo y le pasamos los filtros
        $cursoModelo = new mCursos();
        return $cursoModelo->listarCursos($palabra_clave, $fecha_inicio, $fecha_fin, $categorias);
    }
    
    

    public function mostrarInfo() {
        $this->vista = 'infoCurso';

        $idCursoStr = $_GET['idCurso'];
        $idCurso = (int)$idCursoStr;
        return $this->cursoObj->obtenerInfoCurso($idCurso);
    }

    public function comprar() {
        $this->vista = 'pago';

        $idCursoStr = $_GET['idCurso'];
        $idCurso = (int)$idCursoStr;
        return $this->cursoObj->obtenerInfoCurso($idCurso);
    }
}