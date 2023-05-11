<!DOCTYPE html>
<html>

<head>
    <title>Área Cliente</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/portal_usuario.css">
    <link rel="stylesheet" type="text/css" href="css/cabecera.css">
    <link rel="stylesheet" type="text/css" href="css/barra_navegacion.css">
</head>

<?php
session_start();//para poder leer y escribir en las variables de sesión 
if (!isset($_SESSION['usuario'])) {
    header('location: ./login.php');
    exit();
}
?>

<body class="body-fondo">
    <!--cabecera----------------------------------------------------------------------------------------------------------------->
    <header class="main-header">
        <div class="logo-container">
            <a href="index.php"><img src="logos/logo_hospital4.png"></a>
        </div>
        <div class="title-container">
            <h1>CenSalud</h1>
        </div>
        <div class="button-container">
            <a href="area_perfil.php" class="c-button logo-perfil">Mi perfil</a>
            <a href="./cerrar_session.php" class="c-button logo-cerrar-sesion">Cerrar Sesión</a>
        </div>
    </header>
    <!--barra de navegación----------------------------------------------------------------------------------------------------------------->
    <div class="main">
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="centros_hospitalarios.html">Hospitales</a></li>
                <li><a href="especialistas.html">Especialistas</a></li>
                <li><a href="portal_usuario.php">Portal del usuario</a></li>
            </ul>
        </nav>
    </div>
    <!--Cuerpo----------------------------------------------------------------------------------------------------------------->
    <div class="cuerpo">
        <div class="cabecera-cuerpo">
            <p>Bienvenido <?php echo $_SESSION['usuario']?> a tu portal de salud</p>
        </div>
    </div>
    <div class="menu-tarjetas">
        <div class="tarjeta">
            Pedir cita <br>
            <a href="pedir_cita.php"><img src="imagenes/imagenes_portal_de_usuario/pedir_cita.png"
                    class="imagenes-etiquetas"> </a>

        </div>
        <div class="tarjeta">
            Mis citas<br>
            <a href="mis_citas.php"><img src="imagenes/imagenes_portal_de_usuario/mis_citas.png"
                    class="imagenes-etiquetas"> </a>
        </div>
        <div class="tarjeta">
            Historial<br>
            <a href="informes_clinicos.php"><img src="imagenes/imagenes_portal_de_usuario/informes2.png"
                    class="imagenes-etiquetas"> </a>
        </div>
        <div class="tarjeta">
            Familiares<br>
            <a href="familiares.html"><img src="imagenes/imagenes_portal_de_usuario/familiares.png"
                    class="imagenes-etiquetas"> </a>
        </div>
        <div class="tarjeta">
            Salud<br>
            <a href="contenido_salud/salud.php"><img src="imagenes/imagenes_portal_de_usuario/salud.png"
                    class="imagenes-etiquetas">
            </a>
        </div>
    </div>
</body>

</html>