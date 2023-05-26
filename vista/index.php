<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Página de inicio</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/cabecera.css">
    <link rel="stylesheet" href="css/barra_navegacion.css">
    <!-- <script src="index.js"></script> -->
</head>

<body>
    <!--Cabecera------------------------------------------------------------------------------------------------------------->
    <header class="main-header">
        <div class="logo-container">
            <a href="index.php"><img src="logos/logo_hospital4.png"></a>
        </div>
        <div class="title-container">
            <h1>CenSalud</h1>
        </div>
        <div class="button-container">
            <a href="portal_usuario.php" class="c-button user-button">Área Cliente</a>
            <a href="registro.php" class="c-button signup-button">Registrarse</a>
        </div>
    </header>
    <!--Barra de navegación------------------------------------------------------------------------------------------------>
    <div id="fondo">
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="acerca_de.html">Acerca de</a></li>
                <li><a href="contacto.php">Contacto</a></li>
                <li><a href="centros_hospitalarios.html">Hospitales</a></li>
                <li><a href="especialistas.html">Especialistas</a></li>

            </ul>
            <!--Icono y input para la búsqueda rápida
            <div class="search-icon">
                <form method="post" action="#">
                    <img src="imagenes/icono_busqueda.png" class="icon" alt="Icono de búsqueda">
                    <input type="text" name="busqueda_rapida" id="busqueda_rapida" placeholder="Buscar">
                </form>-->
        </nav><br>
        <!--cuerpo de la página---------------------------------------------------------------------------------------->
        <!--marquesina de imagenes------------------------------------------------------------------------------------->
        <div class="columnas">
            <div class="filas">
                <img src="imagenes/imagenes_index/introduccion1.png">
                <img src="imagenes/imagenes_index/introduccion7.png">
            </div>
            <div class="filas">
                <img src="imagenes/imagenes_index/introduccion2.png">
                <img src="imagenes/imagenes_index/introduccion3.png">
            </div>
            <div class="filas">
                <img src="imagenes/imagenes_index/introduccion4.png">
                <img src="imagenes/imagenes_index/introduccion5.png">
            </div>
            <div class="filas">
                <img src="imagenes/imagenes_index/introduccion6.png" class="img-fondo">
            </div>
        </div>
    </div>
    <!--Pie de página----------------------------------------------------------------------------------------------------->
    <footer>
        <p>Contacto: <a href="tel:900-100-200">+900-100-200</a> |
            <a href="mailto:CenSalud@gmail.com">CenSalud@gmail.com</a>
        </p>
    </footer>


</body>

</html>