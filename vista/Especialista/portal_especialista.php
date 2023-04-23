<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Especialista</title>
</head>

<body>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/Portal_especialista.css">
    <link rel="stylesheet" type="text/css" href="../css/Portal_administrador.css">
    <link rel="stylesheet" type="text/css" href="../css/cabecera.css">
    <link rel="stylesheet" type="text/css" href="../css/barra_navegacion.css">
    </head>

    <?php
session_start();//para poder leer y escribir en las variables de sesión 
if (!isset($_SESSION['usuario'])) {
    header('location: ../login.php');
    exit();
}


?>

    <body class="body-fondo">
        <!--Cabecera-------------------------------------------------------------------------------------------------->
        <header class="main-header">
            <div class="logo-container">
                <a href="../index.html"><img src="../logos/logo_hospital4.png"></a>
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
                    <li><a href="../portal_administrador.php">Inicio</a></li>
                    <li><a href="../centros_hospitalarios.html">Hospitales</a></li>
                    <li><a href="../especialistas.html">Especialistas</a></li>
                    <li><a href="../portal_usuario.html">Portal del usuario</a></li>
                    <li><a><?php echo "Hola" . " " . $_SESSION['usuario']; ?></a></li>
                    <li><a href="../cerrar_session.php">Cerrar sesión</a></li>
                </ul>
            </nav>
        </div>
        <!--cuerpo de la página------------------------------------------------------------------------------------------->

        <div class="contedor_izquierdo">
            <div class="col-md-4 float-left cont_especialista">
                <!--div para elegir día y que el especialista vea los pacientes de el día en concreto-->

                <div class="texto_titulo">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">AGENDA </span>
                    </div>
                    <input required type="date" class="form-control" id="agenda" name="agenda"
                        aria-describedby="basic-addon3">
                </div>
                <div class="con_tabala_agenda">
                    <!--Bucle para mostrar todos los usuarios que tengan cita el día seleccionado------------------------>
                    <table class="tab_especialista texto">
                        <tr>
                            <th></th>
                            <th>Pacientes</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>
                                <hr />
                            </th>
                            <th>
                                <hr />
                            </th>
                            <th>
                                <hr />
                            </th>
                            <th>
                                <hr />
                            </th>
                        </tr>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Dni</th>
                            <th>Hora</th>
                        </tr>
                        <tr class="celdas">
                            <td>Alberto</td>
                            <td>Perez</td>
                            <td>77845236M</td>
                            <td>09:30</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-8 float-right ">
                <!--Iframe que muestra la página usuario_especialista.php para el paciente-->
                <div class="tam_derecho">

                    <div>
                        <iframe title='especialista' id='iframe' src="usuario_especialista.php">

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