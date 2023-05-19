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

    .step {
        display: none;
    }

    .step.active {
        display: block;
    }
    </style>
</head>

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
                    echo  '<a href="portal_usuario.php" class="c-button user-button"><img src="logos/logo_volver-1.png"
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
        <!-- Botón que abre el Modal -->
        <div class="container">
            <h3 class="text-center mb-4">Seleccione los datos para elegir su cita:</h3>

            <div class="step active" id="step-1">
                <label for="fecha" class="form-label">Paso 1: Selecciona una fecha</label>
                <form action="pedir_cita_p2.php" method="post" name="mostrar-datos-usuario">
                    <div class="input-group mb-3">
                        <?php if($rol !='Usuario'){
                             echo '<input type="text" class="form-control" id="dni" name="dni"
                             aria-describedby="fecha-ayuda" placeholder="DNI">';
                        }?>
                        <input type="datetime-local" class="form-control" id="fecha" name="fecha"
                            aria-describedby="fecha-ayuda">
                        <button type="submit" class="btn btn-primary">Lo antes
                            posible</button>

                    </div>
                    <small id="fecha-ayuda" class="form-text text-muted">Selecciona una fecha disponible.</small>
                    <button type="submit" id="siguientep1" name="siguientep1" value="siguientep1"
                        class="btn btn-primary">Siguiente</button>
                </form>
            </div>
        </div>
</body>
<!--cuerpo-->