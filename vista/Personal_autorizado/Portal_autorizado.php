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
    require('../../modelo/consulta_autorizado_familiar.php');
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
                    <li><a href="../portal_administrador.php">Inicio</a></li>
                    <li><a href="../centros_hospitalarios.html">Hospitales</a></li>
                    <li><a href="../acerca_de.html">Acerca de</a></li>
                    <li><a href="../contacto.php">Contacto</a></li>
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
                <form method='post' action='../../modelo/consulta_autorizado_familiar.php'>
                    <div class="texto_titulo">
                        <input placeholder="NIF paciente" required type="text" class="form-control" id="dni_usuario"
                            name="dni_usuario" aria-describedby="basic-addon3">
                        <button type="submit" name="btn_informacion" id="btn_informacion" class="btn btn-primary">
                            Informacion
                        </button><br>
                        <!--Datos del paciente-->
                        <?php 
                        if (isset($_POST['btn_informacion'])) {
                            try{
                                $busqueda=obtener_centros_por_provincia($dni);
                            }catch(PDOException $e) {
                                echo 'Error en la búsqueda de la ciudad: ' . $e->getMessage();
                            }
                                echo "<h1> Información <h1>";  
                            foreach ($busqueda as $resultado) {
                                echo '<h2> NOMBRE: <h2>' . $resultado['familiarNombre'] . '</td>';
                                echo '<h2> APELLIDO: <h2>' . $resultado['familiarApellido'] . '</td>';
                             
                            }
                            }
                        ?>
                        <hr>
                        <button type="submit" name="btn_darCita" id="btn_darCita" class="btn btn-primary">
                            Dar cita
                        </button><br>

                    </div>
                    <hr>
                    <div class="texto_titulo">
                        <div class="input-group-prepend">
                            <!--Redirige a la página crear registro -->
                            <button type="button" name="nuevo_registro" id="nuevo_registro" class="btn btn-primary"
                                data-target="#exampleModal" onclick="location.href = '../registro.php'">
                                Nuevo Usuario
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="float-right cont_especialista ">
                <!--Personal consulta la especialidad, agenda y especialista-->
                <h1>Especialista</h1>

                <div class="texto_titulo">
                    <!--muestra los especialistas según el centro-->
                    <form action="" method="post">
                        <input type="text" class="form-control" id="nom_provincia" name="nom_provincia"
                            aria-describedby="basic-addon3" placeholder="Provincia" />
                        <button class="btn btn-primary" style="margin-top:10px" type="submit" id="buscar" name="buscar"
                            value="Enviar">Buscar</button>
                        <hr>
                        <!--consulta nombre del centro y dirección por provincia-->
                        <?php
                        require_once('../../modelo/autorizado_centros.php');
                            if (isset($_POST['buscar'])) {
                                $centro = $_POST['nom_provincia'];
                            try{
                                $busqueda=obtener_centros_por_provincia($centro);
                            }catch(PDOException $e) {
                                echo 'Error en la búsqueda de la ciudad: ' . $e->getMessage();
                            }
                                echo "<table class='table table-hover'>";
                                echo "<thead><tr><th>Ciudad</th><th>Dirección</th><th>Teléfono</th></tr></thead>";
                                echo "<tbody>";
                            foreach ($busqueda as $resultado) {
                                echo '<tr>';
                                echo '<td>' . $resultado['Nombre'] . '</td>';
                                echo '<td>' . $resultado['direccion'] . '</td>';
                                echo '<td>' . $resultado['telefono'] . '</td>';
                                echo '</tr>';
                            }
                                echo "</tbody>";
                                echo "</table>";
                            }?>
                    </form>
                </div>
            </div>
            <!--En este div mostrará la información seleccionada por el personal del paciente-->
            <div class="float-right cont_especialista ">
                <!--El personal da información sobre los centros que hay-->
                <h1>Especialista</h1>
                <div class="texto_titulo">
                    <!--muestra los especialistas según el centro-->
                    <form method="post">
                        <span class="input-group-text" id="basic-addon3" onclick="location.href='agenda.php'">AGENDA
                        </span>
                        <input type="text" class="form-control" id="nom_centro" name="nom_centro"
                            aria-describedby="basic-addon3" placeholder="Centro" />
                        <button class="btn btn-primary" style="margin-top:10px" type="submit" id="buscar_especialista"
                            name="buscar_especialista" value="Enviar">Buscar</button>
                        <hr>
                        <?php
                      //consulta nombre especialista y especialidad según el nombre del centro introducido
                      require_once('../../modelo/autorizado_especialistas.php');
                      if (isset($_POST['buscar_especialista'])) {
                          $condicion = $_POST['nom_centro'];
                      try{
                          $busqueda=obtener_especililstas_por_centro($condicion);
                        
                      }catch(PDOException $e) {
                          echo 'Error en la búsqueda de la ciudad: ' . $e->getMessage();
                      }
                      echo "<table class='table table-hover'>";
                      echo "<thead><tr><th>Especialista</th><th>Especialidad</th><th>Centro</th></tr></thead>";
                      echo "<tbody>";
                      foreach ($busqueda as $resultado) {
                          echo '<tr>';
                          echo '<td>' . $resultado['NombrePersonal'] . '</td>';
                          echo '<td>' . $resultado['NombreDepartamento'] . '</td>';
                          echo '<td>' . $resultado['NombreCentro'] . '</td>';
                          echo '</tr>';
                      }
                      echo "</tbody>";
                      echo "</table>";
                      }  
                      ?>
                    </form>
                </div>
            </div>

            <div class="clearfix"></div>
        </div>




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>

    </body>

</html>