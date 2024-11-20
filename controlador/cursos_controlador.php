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

        try{
            if(isset($_POST['txtCategory']) && isset($_POST['txtDesc'])){

                $datos = array(
                    "nombre" => $_POST['txtCategory'],
                    "descripcion" => $_POST['txtDesc'],
                    "nombre_usuario" => $_SESSION['usuario']
                );
                $result = $this->cursoObj->crear($datos);

                $this->respuesta = array("state" => true);
                if ($result['resultado'] == 1) {
                    echo "<script>
                            alert('Curso creado exitosamente.');
                            window.location.href = 'index.php?controlador=usuarios&accion=mostrarDatos';
                          </script>";
                } else {
                    echo "<script>
                            alert('El curso ya ha sido registrado.');
                            window.history.back();
                          </script>";
                }
            }
        }catch(PDOException $e){
            $this->respuesta = array("state" => false);
            echo "<script>
                    alert('Error al registrar el curso: " . $e->getMessage() . "');
                    window.history.back();
                </script>";
        }
        return $this->respuesta;
    }
}