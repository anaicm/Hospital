<!DOCTYPE html>
<html>
<?php
require_once('../modelo/crud.php');
session_start();
if (!isset($_SESSION['usuario'])) {
    header('location: ../login.php');
exit();
}
$usuario = crud_select('usuario', 'idUsuario', $_SESSION['idUsuario'] );
$rol = $_SESSION['rol'] = $usuario[0]['Rol'];
?>

<head>
    <title>Mis citas</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/pedir_cita.css">
    <link rel="stylesheet" type="text/css" href="css/cabecera.css">
    <link rel="stylesheet" type="text/css" href="css/barra_navegacion.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Agrega los scripts de Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <style>
    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 50%;
        width: 60%;
        margin: auto;
        margin-top: 5%;
        padding: 30px;
        border: 1px solid #ccc;
        border-radius: 10px;
    }
    </style>
</head>

<?php
if(isset($_POST['confirmar'])){
    
    if(isset($_POST['fecha']) && isset($_POST['dni'])){
        $fecha = $_POST['fecha'];
        $dni = $_POST['dni'];
    }
    
    $departamento = $_POST['departamento'];
    $centro = $_POST['centro'];      
    $ciudad = $_POST['ciudad'];    
    $tipo_cita = $_POST['tipo_cita'];
    $fecha =  $_POST['fecha'];
    $personal = null;
    /*
    if ($fecha == ''){
        // Lo antes posible es mañana a las 8 de la mañana
        $fecha = new DateTime(); 
        $fecha->modify('+1 day'); 
        $fecha->setTime(8, 0, 0);
    }*/

    $departamento_personales=crud_select('Departamento_Personal', 'idDepartamento', $departamento);
    
    try {
        $personal = $departamento_personales[0]['idPersonal'];
        if($rol =='Usuario'){
            crud_insertar('cita', array('Hora' => $fecha, 'idPersonal' => $personal, 'idUsuario' => $_SESSION['idUsuario'], 'idTipoCita' => $tipo_cita));

            //crud_insertar('cita', array('hora' => date('Y-m-d', strtotime(str_replace('-', '/', $fecha))), 'idPersonal' => $departamento_personales[0]['idPersonal'], 'idUsuario' => $_SESSION['idUsuario'], 'idTipoCita' => $tipo_cita));
        }if($rol !='Usuario'){
            $consulta=crud_select('usuario', 'Dni', $dni);
            $idUsuario= $consulta[0]['idUsuario'];
            crud_insertar('cita', array('Hora' => date('Y-m-d', strtotime(str_replace('-', '/', $fecha))), 'idPersonal' => $departamento_personales[0]['idPersonal'], 'idUsuario' => $idUsuario, 'idTipoCita' => $tipo_cita));
        }
    } catch (PDOException $e) {
        echo 'Error al insertar la cita: ' . $e->getMessage();
    }
}
?>

<body class="body-fondo">
    <header class="main-header">
        <div class="logo-container">
            <a href="index.php"><img src="logos/logo_hospital4.png"></a>
        </div>
        <div class="title-container">
            <h1>CenSalud</h1>
        </div>
        <div class="button-container">
            <?php if($rol =='Usuario'){//si el usuario su rol es usuario le lleva al portal del usuario
                    echo  '<a href="login.php" class="c-button user-button"><img src="logos/logo_volver-1.png"
                    class="logo-volver"></a>';
                }
                if($rol =='Usuario_autorizado'){//si el usuario su rol es usuario_autorizado le lleva al portal del personal autorizado
                    echo  '<a href="Personal_autorizado/portal_usuario_autorizado.php" class="c-button user-button"><img src="logos/logo_volver-1.png"
                    class="logo-volver"></a>';
                }
                if($rol =='Especialista'){//si el usuario su rol es especialista le lleva al portal del especialista
                    echo  '<a href="Especialista/portal_especialista.php" class="c-button user-button"><img src="logos/logo_volver-1.png"
                    class="logo-volver"></a>';
                }
                
                ?>
        </div>
    </header>
    <div class="main">
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="centros_hospitalarios.html">Hospitales</a></li>
                <li><a href="especialistas.html">Especialistas</a></li>
                <li><a href="portal_usuario.php">Portal del usuario</a></li>
                <li><a href="pedir_cita.php">Pedir Cita</a></li>
            </ul>
        </nav>
        <div class="container">
            <h3 class="text-center mb-4">Se ha confirmado su cita:</h3>
            <div class="step" id="step-3">
                <label for="localidad" class="form-label">Cita Confirmada:</label>

                <div class="row">
                    <?php 
                $centroCita = crud_select('Centro', 'idCentro', $centro );
                $departamentoCita = crud_select('Departamento', 'idDepartamento',$departamento );
                $personalCita = crud_select('personal', 'idpersonal',$personal );
                echo 'Se ha confirmado su cita en ' . $centroCita[0]['Nombre'] . ' el día ' . $fecha . ' para la especialidad ' . $departamentoCita[0]['Nombre'] . ' con el especialista ' . $personalCita[0]['Nombre'] . $departamentoCita[0]['Nombre'] . ' con el especialista ' . ' ' . $personalCita[0]['Apellido'];
                ?>
                </div>
                <?php if($rol =='Usuario'){//según el rol le lleva a su portal
                echo '<form action="mis_citas.php" method="post" name="mostrar-datos-usuario">
                    <button type="submit" id="confirmar" name="confirmar" value="confirmar"
                        class="btn btn-primary ms-3">Mis Citas</button></form>';
                } if($rol =='Usuario_autorizado'){
                echo'<a href="Personal_autorizado/portal_usuario_autorizado.php">
                    <button type="submit" id="confirmar" name="confirmar" value="confirmar"
                        class="btn btn-primary ms-3">Mis Citas</button>
                </a>';
                }
                if($rol =='Especialista'){
                    echo'<a href="Especialista/portal_especialista.php">
                    <button type="submit" id="confirmar" name="confirmar" value="confirmar"
                        class="btn btn-primary ms-3">Mis Citas</button>
                </a>';

                }
                ?>



            </div>
        </div>
</body>