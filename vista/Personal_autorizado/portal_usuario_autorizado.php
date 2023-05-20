<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Usuario autorizado</title>
</head>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/Portal_especialista.css">
<link rel="stylesheet" type="text/css" href="../css/Portal_administrador.css">
<link rel="stylesheet" type="text/css" href="../css/cabecera.css">
<link rel="stylesheet" type="text/css" href="../css/barra_navegacion.css">
<link rel="stylesheet" type="text/css" href="../css/portal_usuario.css">
<script src="../js/jquery-3.6.3.min.js"></script>
<script src="../js/area_perfil.js"></script>
</head>

<?php
     require_once('../../modelo/crud.php');
        session_start();//para poder leer y escribir en las variables de sesión 
        if (!isset($_SESSION['usuario'])) {
            header('location: ../login.php');
        exit();
        }
         //se obtienen el rol del usuario para que si entra en otro portal distinto le pida acreditación y no pueda entrar 
         //en los que no le corresponde 
        $usuario = crud_select('usuario', 'idUsuario', $_SESSION['idUsuario'] );
        $rol = $_SESSION['rol'] = $usuario[0]['Rol'];

        if($rol !='Usuario_autorizado'){
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
    <div class="menu-tarjetas">
        <div class="tarjeta" onclick="mostrar_datos ('información_paciente')">
            Paciente <br>
            <img src="../imagenes/imagenes_personal_autorizado/Informacion_paciente.png"
                class="imagenes-etiquetas-autorizado">
        </div>
        <div class="tarjeta" onclick="mostrar_datos ('Especialistas_centros')">
            Especialistas
            <img src="../imagenes/imagenes_personal_autorizado/citas.png" class="imagenes-etiquetas-autorizado">
        </div>
        <div class="tarjeta" onclick="mostrar_datos ('informacion_centros')">
            centros
            <img src="../imagenes/imagenes_personal_autorizado/centros.png" class="imagenes-etiquetas-autorizado">
        </div>
        <div class="tarjeta" onclick="mostrar_datos ('agenda_especialista')">
            Agenda
            <img src="../imagenes/imagenes_personal_autorizado/agenda_especialista.png"
                class="imagenes-etiquetas-autorizado">
        </div>
        <div class="tarjeta" onclick="location.href = '../registro.php'">
            Nuevo usuario
            <img src="../imagenes/imagenes_personal_autorizado/nuevo_registro.png"
                class="imagenes-etiquetas-autorizado">
        </div>
        <div class="tarjeta" onclick="location.href = '../pedir_cita.php'">
            Dar cita
            <img src="../imagenes/imagenes_personal_autorizado/pedir_cita.png" class="imagenes-etiquetas-autorizado">
        </div>
    </div>
    <hr>
    <!----------------------------------------->
    <div class="" id="resultado">


    </div>
    <!----------------------------------------->
    <div class="contenedor_personal_autorizado <?php if (isset($_POST['btn_informacion'])) { echo ''; } else { echo 'oculta'; } ?>"
        id='información_paciente'>
        <h1>Paciente</h1>
        <form method='post' action='#'>
            <div class="texto_titulo">
                <input placeholder="NIF paciente" required type="text" class="form-control" id="dni_usuario"
                    name="dni_usuario" aria-describedby="basic-addon3"><br>
                <button type="submit" name="btn_informacion" id="btn_informacion" class="btn btn-primary">
                    Información
                </button>
                <hr>
                <div>
                    <!--Datos del paciente-->
                    <?php 
                        require_once('../../modelo/personal_autorizado/consulta_autorizado_paciente.php');//citas e informes de paciente
                        
                        if(isset($_POST['dni_usuario'])){
                            $dni=$_POST['dni_usuario'];
                            //busca el nombre del usuario según del dni para mostarlo en la cabecera de la búsqueda
                            $usu=crud_select('Usuario', 'Dni', $dni);
                            foreach($usu as $campo){
                                $nom_usu=$campo['Nombre'];
                                $apel_usu=$campo['Apellido'];
                            }
                            echo " $nom_usu" ." " . "$apel_usu ";
                            
                            if (isset($_POST['btn_informacion'])) {
                                try{
                                    $busqueda=obtener_citas_por_dni('cita',$dni);
                                    $busqueda2=obtener_citas_por_dni('hospital.familiar',$dni);
                                    
                                }catch(PDOException $e) {
                                    echo 'Error en la búsqueda de las citas: ' . $e->getMessage();
                                } 
                                echo "<table class='table table-hover tab_especialista texto'>";
                                echo "<thead><tr><th>Cita</th><th>Informe Clínico</th></tr></thead>";
                                echo "<tbody>";
                                foreach ($busqueda as $resultado) {
                                    echo "<tr class='celdas'><td>" . $resultado['Hora'] . "</td>";
                                    echo "<td>" . $resultado['Informe'] . "</td></tr>";
                                }
                                echo "<tr><th>Familiares</th><th></th></tr>";
                                echo "<tr><th>Nombre</th><th>Apellidos</th></tr>";
                                foreach($busqueda2 as $resultado){
                                    echo "<tr class='celdas'><td>" . $resultado['Nombre'] . "</td>";
                                    echo "<td>" . $resultado['Apellido'] . "</td></tr>";

                                } 
                                echo "</tbody>";
                                echo "</table>"; 
                                
                            }
                        }
                ?>
                </div>
            </div>
        </form>
    </div>
    <!-------------------Información del paciente---------------------->

    <div class="contenedor_personal_autorizado <?php if (isset($_POST['buscar_especialista'])) { echo ''; } else { echo 'oculta'; } ?>"
        id='Especialistas_centros'>

        <h1>Especialistas</h1>
        <!--muestra los especialistas según el centro-->
        <form method='post' action='#'>
            <input type="text" class="form-control" id="nom_centro" name="nom_centro" aria-describedby="basic-addon3"
                placeholder="Centro" />
            <button class="btn btn-primary" style="margin-top:10px" type="submit" id="buscar_especialista"
                name="buscar_especialista" value="Enviar">Buscar</button>
            <hr>
            <?php
                      //consulta nombre especialista y especialidad según el nombre del centro introducido
                      require_once('../../modelo/personal_autorizado/autorizado_especialistas.php');
                      if (isset($_POST['buscar_especialista'])) {
                          $condicion = $_POST['nom_centro'];
                      try{
                          $busqueda=obtener_especililstas_por_centro($condicion);
                        
                      }catch(PDOException $e) {
                          echo 'Error en la búsqueda de la ciudad: ' . $e->getMessage();
                      }
                      echo "<table class='table table-hover tab_especialista texto'>";
                      echo "<thead><tr><th>Especialista</th><th>Especialidad</th><th>Centro</th></tr></thead>";
                      echo "<tbody>";
                      foreach ($busqueda as $resultado) {
                          echo '<tr class="celdas">';
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

    <!------------------obtiene las citas del especialista mediante el nombre y apellido----------------------->
    <div class="contenedor_personal_autorizado <?php if (isset($_POST['buscar_agendea_esp'])) { echo ''; } else { echo 'oculta'; } ?>"
        id='agenda_especialista'>
        <!--El personal da información sobre los centros que hay-->
        <h1>Especialista</h1>
        <div class="texto_titulo">
            <!--muestra los especialistas según el centro-->
            <form method="post" action="">
                <input type="text" class="form-control" id="nom_esp" name="nom_esp" aria-describedby="basic-addon3"
                    placeholder="Nombre" />
                <input type="text" class="form-control" id="apel_esp" name="apel_esp" aria-describedby="basic-addon3"
                    placeholder="Apellido" />
                <input type="date" class="form-control" id="fecha" name="fecha" aria-describedby="fecha-ayuda">
                <button class="btn btn-primary" style="margin-top:10px" type="submit" id="buscar_agendea_esp"
                    name="buscar_agendea_esp" value="Enviar">Buscar</button>
                <hr>
                <?php
                     require('../../modelo/epecialista_agenda.php');
                        if(isset($_POST['fecha'])){
                            
                                $fecha = $_POST['fecha'];
                                $nombre=$_POST['nom_esp'];
                                $apellido=$_POST['apel_esp'];
                                
                                if (isset($_POST['buscar_agendea_esp'])) {
                                    $idPersonal=obtenerIdPersonalPorNombre($nombre,$apellido);//obtengo el dni del especialista mediante su nombre y apellidos
                                    
                                    // $personal=id_Personal($dni);//con el dni obtengo el campo idPersonal
                                    // foreach($personal as $campo){
                                    //     $idPersonal=$campo['idPersonal'];
                                    // }
                                    try{
                                        //$arreglo_fecha = date('Y-m-d', strtotime($fecha));
                                        $busqueda=obtener_cita_por_fecha($fecha,$idPersonal[0]['idPersonal']);
                                        echo "<table class='table table-hover tab_especialista texto'>";
                                        echo "<thead><tr><th>Paciente</th><th></th><th>Fecha</th></tr></thead>";
                                        echo "<tbody>";
                                        foreach ($busqueda as $resultado) {
                                            echo ' <tr class="celdas">';
                                            echo "<td>" . $resultado['nombre'] ."</td>";
                                            echo "<td>" . $resultado['apellido'] ."</td>";
                                            echo "<td>" . $resultado['fecha'] ."</td>";
                                        }
                                        echo "</tbody>";
                                        echo "</table>";
                                          
                                    }catch(PDOException $e) {
                                        echo 'Error en la búsqueda de la ciudad: ' . $e->getMessage();
                                    } 
                                }
                            }                   
                      ?>
            </form>
        </div>
    </div>
    <!-------------------obtiene los centros por provincia---------------------->
    <div class="contenedor_personal_autorizado <?php if (isset($_POST['buscar'])) { echo ''; } else { echo 'oculta'; } ?>"
        id='informacion_centros'>
        <!--Personal consulta la especialidad, agenda y especialista-->
        <h1>Centros</h1>

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
                        require_once('../../modelo/personal_autorizado/autorizado_centros.php');
                            if (isset($_POST['buscar'])) {
                                $centro = $_POST['nom_provincia'];
                            try{
                                $busqueda=obtener_centros_por_provincia($centro);
                            }catch(PDOException $e) {
                                echo 'Error en la búsqueda de la ciudad: ' . $e->getMessage();
                            }
                                echo "<table class='table table-hover tab_especialista texto'>";
                                echo "<thead><tr><th>Ciudad</th><th>Dirección</th><th>Teléfono</th><th></th></tr></thead>";
                                echo "<tbody>";
                            foreach ($busqueda as $resultado) {
                                echo '<tr class="celdas">';
                                echo '<td>' . $resultado['Nombre'] . '</td>';
                                echo '<td>' . $resultado['direccion'] . '</td>';
                                echo '<td>' . $resultado['telefono'] . '</td>';
                                echo '<td></td>';
                                echo '</tr>';
                            }
                                echo "</tbody>";
                                echo "</table>";
                            }?>
            </form>
        </div>
    </div>
    <div class="clearfix"></div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

</body>

</html>