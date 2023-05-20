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
    <link rel="stylesheet" type="text/css" href="../css/uasuario_especialista.css">

    </head>
    <script>
    function seleccionar(idCita, nombre, apellido) {
        document.getElementById('nombre').value = nombre;
        document.getElementById('apellido').value = apellido;
        document.getElementById('idCita').value = idCita;

    }
    </script>

    <?php
    require_once('../../modelo/crud.php');
    
    session_start();//para poder leer y escribir en las variables de sesión 
    if (!isset($_SESSION['usuario'])) {
    header('location: ../login.php');
    exit();
    }
    //se obtienen el especialista por id usuario guardado en el login y se coje el DNI
    $usuario = crud_select('usuario', 'idUsuario', $_SESSION['idUsuario'] );
    $_SESSION['dni'] = $usuario[0]['Dni'];
    $rol = $_SESSION['rol'] = $usuario[0]['Rol'];

    if($rol !='Especialista'){
        header('location: ../login.php');
    }
    
    // se obtiene el id del personal mediante el Dni 
  
    if (isset($_POST['registrar'])) {
        $idCita = $_POST['idCita'];
        $informe = $_POST['informe'];

        try {//actualiza los datos por el id de provincia que se ha guardado en el hidden
            crud_actualizar('cita', array('informe' => $informe), "idCita = $idCita");
        } catch (PDOException $e) {
            echo 'Error al editar la cita: ' . $e->getMessage();
        }
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
                    <li><a href="../portal_usuario.php">Portal del usuario</a></li>
                    <li><a><?php echo "Hola" . " " . $_SESSION['usuario']; ?></a></li>
                    <li><a href="../cerrar_session.php">Cerrar sesión</a></li>
                </ul>
            </nav>
        </div>
        <!--cuerpo de la página------------------------------------------------------------------------------------------->
        <div class="cuerpo_columnas">
            <div class="contenedor_personal_autorizado_paciente columna_1  ">
                <div>
                    <!--div para elegir día y que el especialista vea los pacientes de el día en concreto-->
                    <form method='post' action='#'>
                        <div class="texto_titulo">
                            <h1>Agenda</h1>
                            <input type="date" class="form-control" id="fecha" name="fecha"
                                aria-describedby="fecha-ayuda">
                            <button class="btn btn-primary" style="margin-top:10px" type="submit" id="buscar_agenda"
                                name="buscar_agenda">Buscar</button>
                        </div>
                    </form>
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
                            <?php
                        require('../../modelo/epecialista_agenda.php');
                        $personal=id_Personal($_SESSION['dni'] = $usuario[0]['Dni']);
                        foreach($personal as $campo){
                            $idPersonal=$campo['idPersonal'];
                        }
                      if(isset($_POST['fecha'])){
                        $fecha = $_POST['fecha'];
                        if (isset($_POST['buscar_agenda'])) {
                            try{
                                //$arreglo_fecha = date('Y-m-d', strtotime($fecha));
                                $busqueda=obtener_cita_por_fecha($fecha,$idPersonal);
                                foreach ($busqueda as $resultado) {
                                    //al hacer onclick muestra el nombre y el apellido del usuario seleccionado
                                    echo ' <tr onclick="seleccionar(' . $resultado['idCita'] . ',\' ' . $resultado['nombre'] . '\',\' ' . $resultado['apellido'] . '\');" class="celdas">';
                                    echo "<td>" . $resultado['nombre'] ."</td>";
                                    echo "<td>" . $resultado['apellido'] ."</td>";
                                    echo "<td>" . $resultado['dni'] ."</td>";
                                    echo "<td>" . $resultado['fecha'] ."</td>";
                                }
                            }catch(PDOException $e) {
                                echo 'Error en la búsqueda de la ciudad: ' . $e->getMessage();
                            } 
                        }
                    }
                        ?>
                        </table>
                    </div>
                </div>
            </div>
            <!-----------------------------------Informe del paciente------------------------------------------------------->
            <div class="columna_2 contenedor_personal_autorizado_paciente">
                <h1>Informe del paciente</h1>
                <hr />
                <div class="cont_iframe">
                    <div id='panel-modificar' class='d-flex'>
                        <!--Formulario para el informe del paciente-->
                        <?php 
                        if (isset($_POST['registrar'])) {
                            echo '<div class="alert alert-primary" role="alert">
                            Se ha guardado el informe correctamente
                          </div>';
                        }
                        ?>
                        <form method="post" action="#">
                            <input type="hidden" name="idCita" id="idCita" value="">
                            <div class="input-group mb-1 d-inline-flex p-1 bd-highlight">
                                <div class="cuerpo_columnas">
                                    <div class="columna_1">
                                        <table>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Apellido</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                                        aria-describedby="fecha-ayuda" placeholder="Nombre paciente">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="apellido"
                                                        name="apellido" aria-describedby="fecha-ayuda"
                                                        placeholder="Apellido paciente">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="columna_2">
                                        <div class="tamaño_dar_cita" onclick="location.href = '../pedir_cita.php'">
                                            Dar cita
                                            <img src="../imagenes/imagenes_personal_autorizado/pedir_cita.png"
                                                class="imagenes-etiquetas-especialista">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div>
                                <textarea class="input-group-text" id="informe" placeholder="Informe del paciente: "
                                    name="informe">
                                </textarea>
                                <button class="btn btn-primary" type="submit" id="registrar" name="registrar"
                                    value="Enviar">Registrar
                                    informe</button>
                                <?php
                                //registra el informe segun el idUsuario en la tabla cita buscado por el dni
                                
                                
                                ?>


                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-----------------------------------Dar cita------------------------------------------------------->

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>

    </body>

</html>