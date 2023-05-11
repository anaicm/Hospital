<!DOCTYPE html>
<html>

<head>
    <title>Mis citas</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/informes_clinicos.css">
    <link rel="stylesheet" type="text/css" href="css/cabecera.css">
    <link rel="stylesheet" type="text/css" href="css/barra_navegacion.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!--JavaScript----------------------------------------------------------------------------------------->
    <script src="js/area_perfil.js"></script>

</head>
<?php
require_once('../modelo/crud.php');
session_start();
//se obtienen las citas por id usuario guardado en el login
$citas = crud_select('cita', 'idUsuario', $_SESSION['idUsuario'] );


?>

<body class="body-fondo">
    <!--Cabecera ------------------------------------------------------------------------------------------------------------------------------>
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
        <!--Barra de navegación------------------------------------------------------------------------------------------------------------------------------>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="centros_hospitalarios.html">Hospitales</a></li>
                <li><a href="especialistas.html">Especialistas</a></li>
                <li><a href="portal_usuario.php">Portal del usuario</a></li>
                <li><a href="informes_clinicos.php">Informes Clínicos</a></li>
            </ul>
        </nav>
        <!--cuerpo------------------------------------------------------------------------------------------------------------------------------>
        <div id="accordion">
            <?php
			//para cada cita obtenida en la consulta anterior
      foreach ($citas as $cita) { 
	  //se obtiene el tipo de cita y el personal de la cita
        $tipo_cita = crud_select('TipoCita', 'idTipoCita',$cita['idTipoCita'] );
        $personal = crud_select('Personal', 'idPersonal',$cita['idPersonal'] );
		//para cada cida se pinta una tarjeta con la informacion de la cita, nombre, hora, informe. Se ha intentado usar un carrusel de bootstrap pero no funciona
        echo '<div class="card">
        <div class="card-header" id="headingOne">
          <h5 class="mb-0">
            <h4 data-target="#'. $tipo_cita[0]['Nombre'] .'" >
            '. $tipo_cita[0]['Nombre'] . ' ' . $personal[0]['Nombre'] . ' ' . $cita['Hora'] . '
            </h4>
          </h5>
        </div>
        <div id="'. $tipo_cita[0]['Nombre'] .'" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
          <div class="card-body"> -
          '. $cita['Informe'] .'
          </div>
        </div>
      </div>';
      }
      ?>
        </div>


</body>

</html>