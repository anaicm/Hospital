<!DOCTYPE html>
<html>
<head>
	<title>Mis citas</title>
  <meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/mis_citas.css">
  <link rel="stylesheet" type="text/css" href="css/cabecera.css">
  <link rel="stylesheet" type="text/css" href="css/barra_navegacion.css">
  <link rel="stylesheet" type="text/css" href="css/portal_usuario.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<?php
require_once('../modelo/crud.php');
session_start();
$citas = crud_select('cita', 'idUsuario', $_SESSION['idUsuario'] );

if (isset($_GET['borrar'])) {
  $id = $_GET['idCita'];
  try {
      crud_borrar('cita', $id);
  } catch (PDOException $e) {
      echo "No se ha podido eliminar ya que el familiar est� asiganda a un usuario";
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
        <a href="portal_usuario.php" class="c-button user-button"><img src="logos/logo_volver-1.png" class="logo-volver"></a>
    </div>
  </header>
  <div class="main">
  <nav>
    <ul>
      <li><a href="index.php">Inicio</a></li>
      <li><a href="centros_hospitalarios.html">Hospitales</a></li>
      <li><a href="especialistas.html">Especialistas</a></li>
      <li><a href="portal_usuario.php">Portal del usuario</a></li>
      <li><a href="mis_citas.php">Mis citas</a></li>
    </ul>
  </nav>  
  <div class="cuerpo-citas">
    <div class="cabecera-cuerpo-citas">
    <?php
    if($citas)
      echo '<p>Tienes una cita programada</p>';
    else
      echo '<p>No tienes ninguna cita programada</p>';
    ?>   
    </div>
    <?php
    foreach ($citas as $cita) { 
      $tipo_cita = crud_select('TipoCita', 'idTipoCita',$cita['idTipoCita'] );
      $personal = crud_select('Personal', 'idPersonal',$cita['idPersonal'] );
    echo '<div class="tarjeta-citas">
      Próxima cita<br>      
        Tu proxima cita es ' . $tipo_cita[0]['Nombre']. ' con el especialista ' . $personal[0]['Nombre'] . ' ' . $personal[0]['Apellido'] . ' el ' . $cita['Hora'] . '<br>
        <form action="" method="GET"><input type="hidden" name="idCita" value="' . $cita['idCita'] . '">
        <button onclick="confirm(\'¿Estas seguro de borrar el registro?\');" class="btn btn-primary" type="submit" name="borrar" value="Borrar">Borrar</button>
      </form> </p>
    </div>';}
    ?>    
  </div> 
</div> 
</body>
</html>