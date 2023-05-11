<!DOCTYPE html>
<html>

<head>
    <title>Salud</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/acerca_de.css">
    <link rel="stylesheet" type="text/css" href="../css/cabecera.css">
    <link rel="stylesheet" type="text/css" href="../css/barra_navegacion.css">
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/salud.js"></script>
</head>

<body class="body-fondo">
    <!--cabecera---------------------------------------------------------------------------------------------------------------------->
    <header class="main-header">
        <div class="logo-container">
            <a href="../index.php"><img src="../logos/logo_hospital4.png"></a>
        </div>
        <div class="title-container">
            <h1>CenSalud</h1>
        </div>
        <div class="button-container">
            <a href="../portal_usuario.php" class="c-button user-button"><img src="../logos/logo_volver-1.png"
                    class="logo-volver"></a>
        </div>
    </header>
    <div class="main">
        <!--barra de navegación--------------------------------------------------------------------------------------------------------->
        <nav>
            <ul>
                <li><a href="../index.php">Inicio</a></li>
                <li><a href="../centros_hospitalarios.html">Hospitales</a></li>
                <li><a href="../acerca_de.html">Acerca de</a></li>
                <li><a href="../contacto.php">Contacto</a></li>
                <li><a href="../especialistas.html">Especialistas</a></li>
                <li><a href="../portal_usuario.php">Portal del usuario</a></li>
                <li><a href="salud.php">Salud</a></li>
            </ul>
        </nav>
    </div>
    <!--cuerpo---------------------------------------------------------------------------------------------------------------------->
    <div class="row">
        <!--izquierdo, etiquetas a elegir -->
        <div class="col-md-3 float-left">
            <div class="card tam_tarjeta_salud" onclick="document.getElementById('iframe').src ='contenido_salud.html'">
                <img src="../imagenes/imagenes_salud/salud_bienestar.png" class="card-img-top" alt="salud">
                Salud y bienestar
            </div>
            <div class="card tam_tarjeta_salud"
                onclick="document.getElementById('iframe').src ='contenido_investigación.html'">
                <img src="../imagenes/imagenes_salud/investigacion.png" class="card-img-top" alt="investigación">
                Investigación
            </div>
            <div class="card tam_tarjeta_salud"
                onclick="document.getElementById('iframe').src ='contenido_prevención.html'">
                <img src="../imagenes/imagenes_salud/prevencion.png" class="card-img-top" alt="prevención">
                Prevención
            </div>
        </div>
        <!--derecho, contenidos de información -->
        <div class="col-md-9 float-right">
            <div class="tam_derecho">
                <div style="margin: 10px 20px 30px 10px;">
                    <iframe title='consejos' id='iframe' src="contenido_salud.html">
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

</body>

</html>