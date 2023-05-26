<!DOCTYPE html>
<html>
<?php
require_once('../modelo/crud.php');
session_start();//para poder leer y escribir en las variables de sesión 
if (!isset($_SESSION['usuario'])) {
    header('location: ../login.php');
exit();
}
$usuario = crud_select('usuario', 'idUsuario', $_SESSION['idUsuario'] );
$rol = $_SESSION['rol'] = $usuario[0]['Rol'];
$dni = $_SESSION['dni'] = $usuario[0]['Dni'];
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
        border: 2px solid #1F736A;
        border-radius: 10px;
    }
    </style>
</head>

<?php
if (isset($_POST['siguientep1'])) {//
//se obtiene la fecha del paso anterior (primero se inicializa y luego se obtiene el valor del post) así nos aseguramos que fecha tiene un valor
$fecha = date('Y-m-d H:i:s', strtotime($_POST['fecha']));
    if($rol !='Usuario'){
       $dni = $_POST['dni'];
    }else{
        $dni = $_SESSION['dni'] = $usuario[0]['Dni'];
    }
}
?>

<body class="body-fondo">
    <!--Cabecera---------------------------------------------------------------------------------------------------->
    <header class="main-header">
        <div class="logo-container">
            <a href="index.php"><img src="logos/logo_hospital4.png"></a>
        </div>
        <div class="title-container">
            <h1>CenSalud</h1>
        </div>
        <div class="button-container">
            <a href="portal_usuario.php" class="c-button user-button"><img src="logos/logo_volver-1.png"
                    class="logo-volver"></a>
        </div>
    </header>
    <div class="main">
        <!--Barra de navegación--------------------------------------------------------------------------------------------------->
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="centros_hospitalarios.html">Hospitales</a></li>
                <li><a href="especialistas.html">Especialistas</a></li>
                <li><a href="portal_usuario.php">Portal del usuario</a></li>
                <li><a href="pedir_cita.php">Pedir Cita</a></li>
            </ul>
        </nav>
        <!--cuerpo---------------------------------------------------------------------------------------------------->
        <div class="container">
            <h3 class="text-center mb-4">Seleccione los datos para elegir su cita:</h3>
            <div class="step" id="step-2">
                <label for="especialidad" class="form-label">Paso 2: Selecciona una especialidad hospitalaria</label>
                <form action="pedir_cita_p3.php" method="post" name="mostrar-datos-usuario">
                    <?php
					//se ponen los datos del paso anterior en hiddens para pasarlos al paso siguiente al pulsar siguiente
                echo '<input type="hidden" name="fecha" value="' . $fecha . '">';
                echo '<input type="hidden" name="dni" value="' . $dni . '">';         
                ?>
                    <select class="form-select mb-3" name="departamento" id="departamento" required>
                        <?php         
							// se pintan todos los departamentos
                    $departamentos=crud_get_all('departamento');
                    foreach ($departamentos as $departamento) { 
                        echo '<option selected value=' . $departamento['idDepartamento'] . '>' . $departamento['Nombre'] . '</option>'; //Imprime una opcion por cada ciudad
                    }
                ?>
                    </select>
                    <button type="submit" id="anteriorp1" name="anteriorp1" value="anterior1"
                        class="btn btn-secondary">Anterior</button>
                    <button type="submit" id="siguientep2" name="siguientep2" value="siguientep2"
                        class="btn btn-primary ms-3">Siguiente</button>
                </form>
            </div>
        </div>
</body>