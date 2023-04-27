<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Usuario autorizado</title>
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
            <div class="float-left cont_especialista">
                <!--Personal maneja paciente-->
                <h1>Paciente</h1>
                <!--Redirige a la página pedir cita-->
                <div class="texto_titulo" onclick="location.href = '../pedir_cita.php'">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">Dar cita para el paciente </span>
                    </div>
                    <input placeholder="NIF paciente" required type="text" class="form-control" id="cita_paciente"
                        name="cita_paciente" aria-describedby="basic-addon3">

                </div>
                <hr>
                <div class="texto_titulo">
                    <div class="input-group-prepend">
                        <select class="form-select mb-3" id="consulta" required>
                            <option value="">Consultar sobre el paciente</option>
                            <option value="1">Consultar citas del paciente</option>
                            <option value="1">Consultar informes del paciente</option>
                            <option value="2">Consultar familiares del paciente</option>
                        </select>
                        <!--Redirige a la página crear nuevo registro-->
                        <button type="button" name="btn_darCita" id="btn_darCita" class="btn btn-primary"
                            data-toggle="modal" onclick="location.href = '../pedir_cita.php'"
                            data-target="#exampleModal" onclick="location.href = '../registro.php'">
                            Nuevo Usuario
                        </button>
                    </div>


                </div>

            </div>
            <div class="float-right cont_especialista ">
                <!--Personal consulta la especialidad, agenda y especialista-->
                <h1>Especialista</h1>

                <div class="texto_titulo">
                    <!--Redirige a la página especialistas-->
                    <div class="input-group-prepend" onclick="location.href = '../especialistas.html'">
                        <span class="input-group-text" id="basic-addon3">Consultar Especialistas </span>
                    </div>
                    <hr>
                    <!--Redirige a la página Centros hospitalarios-->
                    <div class="input-group-prepend" onclick="location.href = '../centros_hospitalarios.html'">
                        <span class="input-group-text" id="basic-addon3">Consultar centros </span>
                    </div>
                    <hr>
                    <div class="texto_titulo">
                        <!--realiza lo mismo que ver la agenda en el portal del especialista-->
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">AGENDA </span>
                        </div>
                        <input required type="date" class="form-control" id="agenda" name="agenda"
                            aria-describedby="basic-addon3">
                    </div>

                </div>
            </div>
            <!--En este div mostrará la información seleccionada por el personal del paciente-->
            <div class="float-right cont_especialista ">
                <!--El personal da información sobre los centros que hay-->
                <h1>Información</h1>
                <div class="">


                </div>
            </div>

            <div class="clearfix"></div>
        </div>




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>

    </body>

</html>