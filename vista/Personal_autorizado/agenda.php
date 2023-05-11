<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Usuario autorizado</title>
</head>

<body>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/Portal_especialista.css">
    <link rel="stylesheet" type="text/css" href="../css/Portal_administrador.css">
    <link rel="stylesheet" type="text/css" href="../css/cabecera.css">
    <link rel="stylesheet" type="text/css" href="../css/barra_navegacion.css">

    </head>

    <?php
session_start();//para poder leer y escribir en las variables de sesión 
if (!isset($_SESSION['usuario'])) {
    header('location: ../login.php');
    exit();
}


?>

    <body class="body-fondo">
        <!--Cabecera-------------------------------------------------------------------------------------------------->
        <header class="main-header">
            <div class="logo-container">
                <a href="../index.php"><img src="../logos/logo_hospital4.png"></a>
            </div>
            <div class="title-container">
                <h1>CenSalud</h1>
            </div>
            <div class="button-container">
                <a href="portal_usuario_autorizado.php" class="c-button user-button"><img
                        src="../logos/logo_volver-1.png" class="logo-volver"></a>
            </div>
        </header>
        <!--Barra de navegación------------------------------------------------------------------------------------------>
        <div class="main">
            <nav>
                <ul>
                    <li><a href="../portal_administrador.php">Inicio</a></li>
                    <li><a href="../centros_hospitalarios.html">Hospitales</a></li>
                    <li><a href="../acerca_de.html">Acerca de</a></li>
                    <li><a href="../contacto.php">Contacto</a></li>
                    <li><a href="../especialistas.html">Especialistas</a></li>
                    <li><a href="../portal_usuario.php">Agenda</a></li>
                    <li><a><?php echo "Hola" . " " . $_SESSION['usuario']; ?></a></li>
                    <li><a href="../cerrar_session.php">Cerrar sesión</a></li>
                </ul>
            </nav>
        </div>
        <!--cuerpo de la página------------------------------------------------------------------------------------------->
        <div class="row">
            <div class="col-md-6">
                <h1>Agenda</h1>
                <!--realiza lo mismo que ver la agenda en el portal del especialista-->
                <form>
                    <input required type="text" class="form-control" id="nom_especialista" name="nom_especialista"
                        aria-describedby="basic-addon3" placeholder="Nombre especialista">
                    <input required type="text" class="form-control" id="apell_especialista" name="apell_especialista"
                        aria-describedby="basic-addon3" placeholder="Apellidos">
                    <input required type="date" class="form-control" id="agenda" name="agenda"
                        aria-describedby="basic-addon3">
                    <button class="btn btn-primary" style="margin-top:10px" type="submit"
                        id="buscar_agenda_especialista" name="buscar_agenda_especialista" value="Enviar">Buscar</button>

                </form>
            </div>
            <!--mostrar los resultads-->
            <div class="col-md-6">
                <?php
            require_once('../../modelo/autorizado_especialistas_citas.php');
            if (isset($_POST['buscar_agenda_especialista'])) {
                $nom = $_POST['nom_especialista'];
                $apell = $_POST['apell_especialista'];
                
                $fecha = $_POST['agenda'];
                
            try{
                $busqueda=obtener_usuarios_por_especialista_fecha('2023-05-11',$nom,$apell);
               
              
            }catch(PDOException $e) {
                echo 'Error en la búsqueda de la ciudad: ' . $e->getMessage();
            }
            echo "<table class='table table-hover'>";
            echo "<thead><tr><th>Pacientes</th></tr></thead>";
            echo "<tbody>";
            foreach ($busqueda as $resultado) {
                echo '<tr>';
                echo '<td>' . $resultado['Nombre'] . '</td>';
                echo '<td>' . $resultado['Apellido'] . '</td>';
                echo '<td>' . $resultado['Hora'] . '</td>';
                echo '</tr>';
            }
            echo "</tbody>";
            echo "</table>";
            }  
            ?>
            </div>
        </div>

        <body>