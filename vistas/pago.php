<?php

require_once("controlador/cursos_controlador.php");

$cursoCtrl = new cursos();
$infoCurso = $cursoCtrl->comprar();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habímate | Pago de curso</title>
    <link rel="stylesheet" href="CSS/pagoDesign.css">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
</head>
<body>
    <!--Navegador-->
    <nav id="idNav" class="navbar navbar-expand-lg">
        <button id="btnLogo" class="navbar-brand" type="button">
            <img src="Images/HabimateLogo.png" width="160px"/>
        </button>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#idNavLinks" aria-controls="idNavLinks" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="idNavLinks" class="collapse navbar-collapse">
            <div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controlador=cursos&accion=listar">Inicio</a>
                    </li>
                </ul>
            </div>
            <div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php?accion=mostrarDatos&controlador=usuarios">Perfíl</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tablaChats.php">Chat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controlador=usuarios&accion=cerrarSesion">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Cuerpo -->
    <div class="container-fluid">
        <h1 id="idSubtitulo">Pago del Curso</h1>

        <div class="row proceso-pago">
            <a href="index.php?controlador=cursos&accion=mostrarInfo&idCurso=<?=$infoCurso[0]['id']?>" id="idRegresar" class="btn">
                <img src="Images/regresar.png" alt="">
            </a>
            <div id="idCurso" class="col-7">
                <div class="image-level">
                    <?php
                    if($infoCurso[0]['imagen'] != null) {
                    ?>
                    <img id="idAvatarSample" src="data:image/png;base64,<?=base64_encode($infoCurso[0]['imagen'])?>" 
                    alt="Imágen del Curso">
                    <?php } ?>
                    
                    <div class="level">
                        <table>
                            <tr>
                                <th>Nivel</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                            </tr>

                            <?php
                            $precios = array();
                            for($i = 0; $i < count($infoCurso); $i++) {
                            array_push($precios, $infoCurso[$i]['precioNivel']); ?>
                            <tr>
                                <td><?=$i+1?></td>
                                <td><?=$infoCurso[$i]['nombreNivel']?></td>
                                <td>$<?=$infoCurso[$i]['precioNivel']?> MXN</td>
                            </tr>
                            <?php } ?>
                        </table>

                        <table id="idTablaTotal">
                            <tr>
                                <th>TOTAL: </th>
                                <?php
                                $total =  (float)array_sum($precios); ?>
                                <th>$<?=$total?> MXN</th>
                            </tr>
                        </table>
                    </div>
                    
                </div>
                
                <div class="info">
                    <h3><?=$infoCurso[0]['titulo']?></h3>
                    <p> <?=$infoCurso[0]['descripcion']?></p>
                </div>  
            </div>
            <div id="idPagos" class="col">
                <div id="paypal-button-container"></div>
            </div>
        </div>
        
    </div>
    
    <!-- Footer -->
    <footer>
        <iframe class="footer" src="Footer.html" frameborder="0" scrolling="no"></iframe>
    </footer>

    <!-- Archivos externos -->
    <script src="JS/bootstrap.min.js"></script>

    <!-- Paypal -->
    <script src="https://www.paypal.com/sdk/js?client-id=AVKQlbBiWC_hRV-GeELpMy8oAy-tacFoasmCKYBH7y-CngyYzkk-y-jJTuRFYrjUddZyRyIuXibEKPq7&currency=MXN"></script>
    <script>
        paypal.Buttons({
            style: {
                color: 'black',
                label: 'pay',
            },
            // createOrder: function(data, actions) {
            //   return actions.order.create({
            //     purchase_units: [{
            //       amount: {
            //         // value: echo $total; ?>
            //       }
            //     }]
            //   });
            // },

            // onApprove: function(data, actions){
            //     actions.order.capture().then(function (detalles){
            //         // window.location.href="comprar.php"
            //     });
            // },

            // onCancel: function(data){
            //    alert("Pago cancelado")
            // }

        }).render('#paypal-button-container');
    </script>
</body>
</html>