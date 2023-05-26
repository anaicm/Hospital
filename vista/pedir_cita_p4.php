<!DOCTYPE html>
<html>
<?php
require_once('../modelo/crud.php');
?>

<head>
    <title>Pedir cita</title>
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
if (isset($_POST['siguientep3'])) {//
//se obtienen los datos del paso anterior

    $dni = $_POST['dni'];
    $departamento = -1;
    $ciudad = -1;
    $fecha = $_POST['fecha'];
    $ciudad = $_POST['ciudad'];    
    $departamento = $_POST['departamento'];
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
            <a href="portal_usuario.php" class="c-button user-button"><img src="logos/logo_volver-1.png"
                    class="logo-volver"></a>
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
            <h3 class="text-center mb-4">Seleccione los datos para elegir su cita:</h3>
            <div class="step" id="step-3">
                <label for="localidad" class="form-label">Paso 4: Selecciona un centro</label>
                <form action="pedir_cita_p5.php" method="post" name="mostrar-datos-usuario">
                    <?php
					//se ponen los datos del paso anterior en hiddens para pasarlos al paso siguiente al pulsar siguiente

                echo '<input type="hidden" name="fecha" value="' . $fecha . '">';   
                echo '<input type="hidden" name="dni" value="' . $dni . '">';      
                echo '<input type="hidden" name="ciudad" value="' . $ciudad . '">'; 
                echo '<input type="hidden" name="departamento" value="' . $departamento . '">'; 
                ?>
                    <div class="row">
                        <select class="form-select mb-3" id="centro" name="centro" required>
                            <option value="">Selecciona un centro...</option>
                            <?php
							// se pintan todos los centros (faltaria buscarlos solo por la ciudad seleccionada en el paso anterior)
                            $centros=crud_get_all('centro');
                            foreach ($centros as $centro) { //Recorre las centros
                                echo '<option selected value=' . $centro['idCiudad'] . '>' . $centro['Nombre'] . '</option>'; //Imprime una opcion por cada centro
                            }
                        ?>
                        </select>
                    </div>
                    <button type="submit" id="siguientep4" name="siguientep4" value="siguientep4"
                        class="btn btn-primary ms-3">Siguiente</button>
                </form>
            </div>
        </div>
</body>
<!--cuerpo-->