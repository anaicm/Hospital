<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Administración BD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/Portal_Administrador.css">
    <link rel="stylesheet" type="text/css" href="../css/cabecera.css">
    <link rel="stylesheet" type="text/css" href="../css/barra_navegacion.css">
</head>

<?php
/**
 * inicia sesión para poder leer y escribir en las variables de sesión
 */
require_once('../../modelo/crud.php');
session_start();
if (!isset($_SESSION['usuario'])) {
    header('location: ../login.php');
    exit();
}
//se obtienen el rol del usuario para que si entra en otro portal distinto le pida acreditación y no pueda entrar 
//en los que no le corresponde 
$usuario = crud_select('usuario', 'idUsuario', $_SESSION['idUsuario'] );
$rol = $_SESSION['rol'] = $usuario[0]['Rol'];
if($rol !='Administrador'){
    header('location: ../login.php');
}
?>


<body class="body-fondo">
    <!--Cabecera-------------------------------------------------------------------------------------------------->
    <header class="main-header">
        <div class="logo-container">
            <a href="../index.php"><img src="../logos/logo_hospital4.png"></a>
        </div>
        <div class="title-container">
            <h1>CenSalud</h1>
        </div>
        <div class="button-container">
            <a href="../Administrador/portal_administrador.php" class="c-button user-button"><img
                    src="../logos/logo_volver-1.png" class="logo-volver"></a>
        </div>
    </header>
    <!--Barra de navegación------------------------------------------------------------------------------------------>
    <div class="main">
        <nav>
            <ul>
                <li><a href="../index.php">Inicio</a></li>
                <li><a href="../centros_hospitalarios.html">Hospitales</a></li>
                <li><a href="../especialistas.html">Especialistas</a></li>
                <li><a href="../portal_usuario.php">Portal del usuario</a></li>
                <li><a><?php echo "Hola" . " " . $_SESSION['usuario']; ?></a></li>
                <li><a href="../cerrar_session.php">Cerrar sesión</a></li>
            </ul>
        </nav>
        <!--Cuerpo------------------------------------------------------------------------------------------------------>
        <!--Mediante bootstrap con las clases "col-md-4" y "col-md-8" para que ocupe el 100% del ancho disponible
        la clase "clearfix" asegura que el contenido flotante se ajuste correctamente.-->
        <div class="row">
            <div class="col-md-4 float-left">
                <!--div para mostrar las tablas de BD-->
                <table class="tab_administrador texto">
                    <tr>
                        <th>Tablas Base</th>
                    </tr>
                </table>
                <div onclick="document.getElementById('iframe').src ='centro.php'" class="celdas texto">
                    Centro
                </div>
                <div onclick="document.getElementById('iframe').src ='ciudad.php'" class="celdas texto">
                    Ciudad
                </div>
                <div onclick="document.getElementById('iframe').src ='provincia.php'" class="celdas texto">
                    Provincia
                </div>
                <div onclick="document.getElementById('iframe').src ='departamento.php'" class="celdas texto">
                    Departamento
                </div>
                <div onclick="document.getElementById('iframe').src ='personal.php'" class="celdas texto">
                    Personal
                </div>
                <div onclick="document.getElementById('iframe').src ='cita.php'" class="celdas texto">
                    Citas
                </div>
                <div onclick="document.getElementById('iframe').src ='tipocita.php'" class="celdas texto">
                    Tipo de citas
                </div>
                <div onclick="document.getElementById('iframe').src ='usuario.php'" class="celdas texto">
                    usuarios
                </div>
                <div onclick="document.getElementById('iframe').src ='familiar.php'" class="celdas texto">
                    Familiares
                </div>
            </div>
            <div class="col-md-8 float-right ">
                <!--es el que primero se abre por defecto-->
                <div class="tam_derecho">

                    <div>
                        <iframe title='administrador' id='iframe' src="usuario.php">
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