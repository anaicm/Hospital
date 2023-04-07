<?php
require_once('../controlador/crud.php');
$msg = '';
if (isset($_POST['registrar'])) {
	

	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellidos'];
	$telefono = $_POST['telefono'];
	$fnacimiento = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['fnacimiento'])));
	$email = $_POST['email'];
	$contrasenia = $_POST['password'];

    try {
    crud_insert('Usuario', array('nombre' => $nombre, 'apellido' => $apellido, 'telefono' => $telefono,  'contrasenia' => $contrasenia, 'email' => $email));
    header("location: login.php");
    } catch (PDOException $e) {
        echo 'Error al insertar usuario: ' . $e->getMessage();
    }
	// $link = mysqli_connect('localhost', 'root', '', 'Hospital');

	//     // Prepare an insert statement
	// 	$sql = "INSERT INTO Usuario (Nombre, Apellido, Telefono, Email, Contrasenia, Rol ) VALUES (?, ?, ?, ?, ?, ?)";
         
    //     if($stmt = mysqli_prepare($link, $sql)){
    //         // Bind variables to the prepared statement as parameters
	// 		mysqli_stmt_bind_param($stmt, "ssssss", $param_nombre, $param_apellido, $param_telefono, $param_email, $param_contrasenia, $param_rol);
            
    //         // Set parameters
    //         $param_nombre = $nombre;
    //         $param_contrasenia = password_hash($contrasenia, PASSWORD_DEFAULT); // Creates a password hash
    //         $param_apellido = $apellido;
	// 		$param_telefono = $telefono;
	// 		$param_email = $email;
	// 		$param_rol = 'Usuario';
			
    //         // Attempt to execute the prepared statement
    //         if(mysqli_stmt_execute($stmt)){
    //             // Redirect to login page
    //             header("location: login.php");
    //         } else{
    //             $msg = "Algo salió mal, por favor inténtalo de nuevo.";
    //         }
    //     }
         
    //     // Close statement
    //     mysqli_stmt_close($stmt);
		
    // // Close connection
    // mysqli_close($link);
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
<!--En este código, cada campo tiene el atributo "required" para que el formulario no se pueda enviar a menos 
	que se completen todos los campos. También se ha agregado una etiqueta "label" para cada campo, lo que 
	mejora la accesibilidad del formulario. Además, el campo "Rol" es un menú desplegable que solo permite 
	seleccionar opciones válidas.-->

<body class="body-fondo">
    <header class="main-header">
        <div class="logo-container">
            <a href="index.html"><img src="logos/logo_hospital4.png"></a>
        </div>
        <div class="title-container">
            <h1>CenSalud</h1>
        </div>
        <div class="button-container">
            <a href="login.html" class="c-button user-button"><img src="logos/logo_volver-1.png"
                    class="logo-volver"></a>
        </div>
    </header>
    <div class="container_registro">
        <div class="login_box">
            <h2>Registro de usuario</h2>
            <?php if (!empty($msg)): ?>
            <p><?php echo $msg; ?></p>
            <?php endif; ?>
            <form method="post" class="form_login">
                <label for="nombre">Nombre:</label><br>
                <input type="text" id="nombre" name="nombre" required><br>

                <label for="Apellidos">Apellidos:</label><br>
                <input type="text" id="apellidos" name="apellidos" required><br>

                <label for="DNI">Documento (DNI):</label><br>
                <input type="text" id="dni" name="dni" required><br>


                <label for="fnacimiento">Fecha de Nacimiento:</label><br>
                <input type="text" id="fnacimiento" name="fnacimiento" required><br>

                <label for="telefono">Teléfono:</label><br>
                <input type="tel" id="telefono" name="telefono" required><br>

                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required><br>

                <label for="password">Contraseña:</label><br>
                <input type="password" id="password" name="password" required><br>

                <input type="submit" id="registrar" name="registrar" value="Enviar">
            </form>
        </div>
    </div>
</body>

</html>