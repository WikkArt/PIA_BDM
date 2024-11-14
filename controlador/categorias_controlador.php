<?php
require_once("modelo/modeloCategorias.php");

session_start();

class categorias {
    public $categoriaObj;
    public $vista;
    public $respuesta;

    public function __construct() {
        $this->categoriaObj = new mCategorias();
    }

    public function crear() {
        $this->vista = 'nuevaCategoria';

        try{
            if(isset($_POST['txtCategory']) && isset($_POST['txtDesc'])){

                $datos = array(
                    "nombre" => $_POST['txtCategory'],
                    "descripcion" => $_POST['txtDesc'],
                    "nombre_usuario" => $_SESSION['usuario']
                );
                $result = $this->categoriaObj->crear($datos);

                $this->respuesta = array("state" => true);
                if ($result['resultado'] == 1) {
                    echo "<script>
                            alert('Categoria creada exitosamente.');
                            window.location.href = 'index.php?controlador=usuarios&accion=mostrarDatos';
                          </script>";
                } else {
                    echo "<script>
                            alert('La categoria ya ha sido registrada.');
                            window.history.back();
                          </script>";
                }
            }
        }catch(PDOException $e){
            $this->respuesta = array("state" => false);
            echo "<script>
                    alert('Error al registrar la categoria: " . $e->getMessage() . "');
                    window.history.back();
                </script>";
        }
        return $this->respuesta;
    }
}