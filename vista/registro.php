<?php
require_once('../modelo/crud.php');
$msg = '';
if (isset($_POST['registrar'])) {
    //Trae los datos del formulario
    $nombre = $_POST['nombre'];
	$apellido = $_POST['apellidos'];
    $dni = $_POST['dni'];
	$telefono = $_POST['telefono'];
	$fnacimiento = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['fnacimiento'])));
	$email = $_POST['email'];
	$contrasenia = $_POST['password'];

    $valido = true;
      if($valido){
        try {//con la función insertar los inserto en la BD, por defecto el rol será usuario y lo redirige a la página del login
            crud_insertar('Usuario', array('dni' => $dni, 'nombre' => $nombre, 'apellido' => $apellido, 'telefono' => $telefono, 'FechaNacimiento' => $fnacimiento,'contrasenia' => password_hash($contrasenia, PASSWORD_DEFAULT),
            'email' => $email, 'rol' => 'Usuario'));
            header("location: login.php");
        } catch (PDOException $e) {
            echo 'Error al insertar usuario: ' . $e->getMessage();
        }
    }
}
    

?>

<!DOCTYPE html>
<html>

<head>
    <title>Formularo registro</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/login_registro.css">
    <link rel="stylesheet" type="text/css" href="css/cabecera.css">
    <link rel="stylesheet" type="text/css" href="css/barra_navegacion.css">
</head>

<body class="body-fondo">
    <!--Cabecera---------------------------------------------------------------------------------------->
    <header class="main-header">
        <div class="logo-container">
            <a href="index.php"><img src="logos/logo_hospital4.png"></a>
        </div>
        <div class="title-container">
            <h1>CenSalud</h1>
        </div>
        <div class="button-container">
            <a href="login.php" class="c-button user-button"><img src="logos/logo_volver-1.png" class="logo-volver"></a>
        </div>
    </header>
    <!--Cuerpo---------------------------------------------------------------------------------------->
    <div class="container_registro">
        <div class="login_box">
            <h2>Registro de usuario</h2>
            <!--Mensaje de error-->
            <?php if (!empty($msg)): ?>
            <p><?php echo $msg; ?></p>
            <?php endif; ?>
            <!--formulario---------------------------------------------------------------------------------------->
            <form method="post" class="form_login">

                <input type="text" id="nombre" name="nombre" required placeholder="Nombre"><br>

                <input type="text" id="apellidos" name="apellidos" required placeholder="Apellidos"><br>

                <input type="text" id="dni" name="dni" required placeholder="Documento (DNI)"><br>

                <input type="text" type="datetime-local" id="fnacimiento" name="fnacimiento" required
                    placeholder="Fecha de Nacimiento"><br>

                <input type="tel" id="telefono" name="telefono" required placeholder="Teléfono"><br>

                <input type="email" id="email" name="email" required placeholder="Email"><br>

                <input type="password" id="password" name="password" required placeholder="Contraseña"><br>

                <input type="submit" id="registrar" name="registrar" value="Enviar">
            </form>
        </div>
    </div>
</body>

</html>