<?php
ob_start(); // Iniciamos el buffer de salida

$msg = '';
if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if($username == "prueba" && $password == "prueba"){
		session_start();
		$_SESSION['usuario'] = 'prueba';
		header('Location: portal_administrador.php');
		exit; // Es importante salir del script después de la redirección
	}else{
		$msg = 'Wrong username or password';
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

<!--Este código creará un contenedor centrado en la pantalla con un formulario de inicio de sesión estilizado,
    un campo de contraseña y un botón de enviar. El contenedor está diseñado con una sombra y un borde redondeado 
    para una apariencia más atractiva. También se ha utilizado una fuente de Google llamada "Montserrat" para darle
    un aspecto más elegante y moderno.-->


<body class="body-fondo">
    <header class="main-header">
        <div class="logo-container">
            <a href="index.html"><img src="logos/logo_hospital4.png"></a>
        </div>
        <div class="title-container">
            <h1>CenSalud</h1>
        </div>
        <div class="button-container">
            <a href="index.html" class="c-button user-button"><img src="logos/logo_volver-1.png"
                    class="logo-volver"></a>
        </div>
    </header>
    <div class="container_login">
        <div class="login_box">
            <h2>Login</h2>
            <?php if (!empty($msg)): ?>
            <p><?php echo $msg; ?></p>
            <?php endif; ?>
            <form action="" method="post">
                <div class="form_login">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form_login">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form_login button">
                    <input type="submit" id="login" value="Login">
                </div>
                <div class="contra_olvidar">
                    <p><a href="#">¿Has olvidado tú contraseña?</a></p>
                    <p><a href="index.html">Volver</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>