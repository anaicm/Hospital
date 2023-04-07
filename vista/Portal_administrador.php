<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Administración BD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/Portal_Administrador.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/cabecera.css">
    <link rel="stylesheet" type="text/css" href="css/barra_navegacion.css">
</head>

<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('location: login.php');
    exit();
}

echo "<br><br><br><br><br><br><br>Hola" . $_SESSION['usuario'];
?>


<body class="body-fondo">
    <!--Cabecera------------------------------------------------------------------------------------------>
    <header class="main-header">
        <div class="logo-container">
            <a href="index.html"><img src="logos/logo_hospital4.png"></a>
        </div>
        <div class="title-container">
            <h1>CenSalud</h1>
        </div>
        <div class="button-container">
            <a href="portal_administrador.php" class="c-button user-button"><img src="logos/logo_volver-1.png"
                    class="logo-volver"></a>
        </div>
    </header>
    <!--Barra de navegación------------------------------------------------------------------------------------------>
    <div class="main">
        <nav>
            <ul>
                <li><a href="portal_administrador.php">Inicio</a></li>
                <li><a href="centros_hospitalarios.html">Hospitales</a></li>
                <li><a href="especialistas.html">Especialistas</a></li>
                <li><a href="portal_usuario.html">Portal del usuario</a></li>
            </ul>
        </nav>
        <!--Cuerpo------------------------------------------------------------------------------------------------------>
        <!--*En este ejemplo, he utilizado las clases "col-md-6" para asegurarme de que cada div ocupe el 50% del ancho 
        disponible en pantallas medianas o grandes. Puedes ajustar estas clases según tus necesidades. Recuerda que debes 
        tener en cuenta el diseño responsive de Bootstrap para asegurarte de que tu página se vea bien en distintos dispositivos.
        la clase "clearfix" en un div contenedor para asegurarte de que el contenido flotante se ajuste correctamente.*-->
        <div class="row">
            <div class="col-md-6 float-left">
                <!--div para mostrar las tablas de BD-->
                <table class="texto">
                    <tr>
                        <th>Tablas Base</th>
                    </tr>
                </table>
                <div class="celdas texto">
                    Centro
                </div>
                <div class="celdas texto">
                    Ciudad
                </div>
                <div class="celdas texto">
                    Provincia
                </div>
                <div class="celdas texto">
                    Departamento
                </div>
                <div class="celdas texto">
                    Personal
                </div>
                <div class="celdas texto">
                    Citas
                </div>
                <div class="celdas texto">
                    Tipo de citas
                </div>
                <div class="celdas texto">
                    Paciente
                </div>
                <div class="celdas texto">
                    Familiares
                </div>
            </div>
            <div class="col-md-6 float-right ">
                <!--div para mostrar la barra de búsqueda y GIG-->
                <div class="contenedor-der">

                    <input type="text" placeholder="Busqueda rápida">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-search" viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                    <!--gif-->
                </div>
            </div>
            <div class="clearfix"></div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>
</body>

</html>