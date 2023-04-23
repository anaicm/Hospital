<?php
require_once('../modelo/crud.php');
$msg = '';
if (isset($_POST['registrar'])) {
	

	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellidos'];
	$telefono = $_POST['telefono'];
	$fnacimiento = date('d-m-Y', strtotime(str_replace('-', '/', $_POST['fnacimiento'])));
	$email = $_POST['email'];
	$contrasenia = $_POST['password'];
    $dni = $_POST['dni'];

    try {
        crud_insert('Usuario', array('nombre' => $nombre, 'apellido' => $apellido, 'telefono' => $telefono,  'contrasenia' => $contrasenia, 'email' => $email, 'rol' => 'Usuario', 'dni' => $dni));
        header("location: login.php");
    }catch (PDOException $e) {
        echo 'Error al insertar usuario: ' . $e->getMessage();
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
    <!--Cabecera de la página------------------------------------------------------------------------------------------------>
    <header class="main-header">
        <div class="logo-container">
            <a href="index.html"><img src="logos/logo_hospital4.png"></a>
        </div>
        <div class="title-container">
            <h1>CenSalud</h1>
        </div>
        <div class="button-container">
            <a href="login.php" class="c-button user-button"><img src="logos/logo_volver-1.png" class="logo-volver"></a>
        </div>
    </header>
    <div class="container_registro">
        <!--Cuerpo de la página------------------------------------------------------------------------------------------------>
        <div class="login_box">
            <h2>Registro de usuario</h2>
            <?php if (!empty($msg)): ?>
            <p><?php echo $msg; ?></p>
            <?php endif; ?>
            <form method="post" class="form_login">
                <input placeholder="Nombre" type="text" id="nombre" name="nombre" required><br>

                <input placeholder="Apellidos" type="text" id="apellidos" name="apellidos" required><br>

                <input placeholder="Documento (DNI)" type="text" id="dni" name="dni" required><br>

                <input placeholder="Año/mes/día" type="text" id="fnacimiento" name="fnacimiento" required><br>

                <input placeholder="Teléfono" type="tel" id="telefono" name="telefono" required><br>

                <input placeholder="Email" type="email" id="email" name="email" required><br>

                <input placeholder="Contraseña" type="password" id="password" name="password" required><br>

                <input type="submit" id="registrar" name="registrar" value="Enviar">
            </form>
        </div>
    </div>
</body>

</html>