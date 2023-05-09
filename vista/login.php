<?php
require_once('../modelo/crud.php');
// si ha pulsado el botón login y los campos username y password no vienen vacios,
//validación por parte del servidor.
if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
    
    $encontrado = false;//no encontrado 
    $usuario = crud_select('Usuario', 'Email',$username);//se busca por email
    if ($usuario && password_verify($password, $usuario[0]["Contrasenia"])) {//con password_very verifica la contraseña     
        $encontrado = true;//si lo ha encontrado
        session_start();//si encuentra al usuario inicia sesión y se guardan los datos del usuario en las variables de sesión
        $_SESSION['usuario'] = $usuario[0]['Nombre'];
        $_SESSION['idUsuario'] = $usuario[0]['idUsuario'];
        $_SESSION['contraseniaHash'] = $usuario[0]['Contrasenia'];
        $_SESSION['apellido'] = $usuario[0]['Apellido'];
        $_SESSION['telefono'] = $usuario[0]['Telefono'];
        $_SESSION['fnacimiento'] = date('d-m-Y', strtotime(str_replace('-', '/', $usuario[0]['FechaNacimiento'])));
        $_SESSION['email'] = $usuario[0]['Email'];
        $_SESSION['dni'] = $usuario[0]['Dni'];
        //según el Rol manda al usuario a su portal
        //Si es administrador hay que mandarlo al portal del admin si no al portal de usuario
        if($usuario[0]['Rol'] == 'Especialista'){
            header('Location: especialista/portal_especialista.php');
        }
        if ($usuario[0]['Rol'] == 'Administrador') {
            header('Location: administrador/portal_administrador.php');
        }
        if($usuario[0]['Rol'] == 'Usuario'){
            header('Location: portal_usuario.php');
        }
        if($usuario[0]['Rol'] == 'Usuario_autorizado'){
            header('Location: personal_autorizado/portal_usuario_autorizado.php');
        }
		exit; // Es importante salir del script después de la redirección
    }
    
    if (!$encontrado) {//si no lo ha encontrado
        $msg = 'Usuario o contraseña no válidos';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/login_registro.css">
    <link rel="stylesheet" type="text/css" href="css/cabecera.css">
    <link rel="stylesheet" type="text/css" href="css/barra_navegacion.css">
</head>

<body class="body-fondo">
    <!--Cabecera------------------------------------------------------------------------------------------------------------>
    <header class="main-header">
        <div class="logo-container">
            <a href="index.php"><img src="logos/logo_hospital4.png"></a>
        </div>
        <div class="title-container">
            <h1>CenSalud</h1>
        </div>
        <div class="button-container">
            <a href="index.php" class="c-button user-button"><img src="logos/logo_volver-1.png" class="logo-volver"></a>
        </div>
    </header>
    <!--Cuerpo------------------------------------------------------------------------------------------------------------>
    <div class="container_login">
        <div class="login_box">
            <h2>Login</h2>
            <!--Mensaje de error-->
            <?php if (!empty($msg)): ?>
            <p><?php echo $msg; ?></p>
            <?php endif; ?>
            <form action="" method="post">
                <div class="form_login">
                    <label for="username">Email</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form_login">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form_login button">
                    <input type="submit" id="login" name="login" value="Login">
                </div>
                <div class="contra_olvidar">
                    <!-- <p><a href="#">¿Has olvidado tú contraseña?</a></p>-->
                    <p><a href="index.php">Volver</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>