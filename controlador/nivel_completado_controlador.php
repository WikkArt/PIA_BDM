<?php
require_once("modelo/modeloNivelCompletado.php");

session_start();

class nivelesCompletados {
    public $nivelcompObj;
    public $vista;
    public $respuesta;

    public function __construct() {
        $this->cursoObj = new mNivelCompletado();
    }

    public function crear() {
        $this->vista = 'vistaNivel';

        // Verificar sesión activa
        if (!isset($_SESSION['usuario']) || !isset($_SESSION['rol'])) {
            echo json_encode(['error' => 'No has iniciado sesión.']);
            exit();
        }

        try {
            // Validación de datos del formulario
            if (isset($_POST['txtCourse']) && isset($_POST['txtDesc'])) {
                $datos = [
                    "id_nivel" => $_POST['txtCourse'],
                    "nombre_usuario" => $_SESSION['usuario'],
                ];

                // Guardar recursos adicionales (si existen)
                $recursos = $this->procesarRecursos($_FILES['recurso'], $_POST['txtLevel']);
                
                // Crear nivel
                $result = $this->cursoObj->agregarNivelCompletado($datos);

                // Respuesta al usuario
                if ($result) {
                    echo "<script>
                            alert('Nivel completado registrado con éxito.');
                            window.location.href = 'index.php?controlador=usuarios&accion=mostrarDatos';
                          </script>";
                }
            }
        } catch (PDOException $e) {
            echo "<script>
                    alert('Error al registrar el nivel: " . $e->getMessage() . "');
                    window.history.back();
                </script>";
        }
    }

    private function procesarRecursos($archivos, $nivel) {
        $recursos = [];
        if (!empty($archivos['name'][0])) {
            $totalRec = count($archivos['name']);
            for ($i = 0; $i < $totalRec; $i++) {
                if ($archivos['size'][$i] > 0) {
                    $rutaRecurso = "recursos/" . $_SESSION['usuario'] . "_" . $nivel . "_" . $archivos['name'][$i];
                    move_uploaded_file($archivos['tmp_name'][$i], $rutaRecurso);
                    $recursos[] = $rutaRecurso;
                }
            }
        }
        return $recursos;
    }
}
?>