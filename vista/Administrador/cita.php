<!DOCTYPE html>
<html lang="en">
<?php require_once '../paginacion.php'; ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Administraci�n BD Cita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/usu_admin.css">

    <script>
    /*
    @function para buscar por id, mediante una llamada as�ncrona con Ajax al servidor
    *
    */

    function seleccionar(id) {
        var http = new XMLHttpRequest();
        var url = '/Hospital/controlador/controlador_cita.php';
        var params = 'action=seleccionar&id=' + id;
        http.open('POST', url, true);

        //
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        // maneja la respues del servidor 
        http.onreadystatechange = function() {
            //respuesta ajax correcta
            if (http.readyState == 4 && http.status == 200) {
                var cita = JSON.parse(http.response);
                document.getElementById('hora').value = cita[0].Hora; //dato mapeados
                document.getElementById('idPersonal').value = cita[0].idPersonal; //dato mapeados
                document.getElementById('idUsuario').value = cita[0].idUsuario; //dato mapeados
                document.getElementById('idTipoCita').value = cita[0].idTipoCita; //dato mapeados
                document.getElementById('idUsuario').setAttribute("disabled", "disabled");
                document.getElementById('registrar').style.display = 'none'; //cambia la visibilidad de los botones
                document.getElementById('modificar').style.display = 'block';

                //deja el id oculto para luego uasarlo en modificar
                document.getElementById('idCita').value = id;
                document.getElementById('Anadir').style.display = "block";

            }
        }
        http.send(params);
    }
    /**
     * @Function limpiarFormulario() limpia los campos del formulario
     * 
     */
    function limpiarFormulario() {
        document.getElementById('hora').value = "";
        document.getElementById('idPersonal').value = "";
        document.getElementById('idUsuario').value = "";
        document.getElementById('idTipoCita').value = "";
        document.getElementById('registrar').style.display = "block";
        document.getElementById('modificar').style.display = "none";
        document.getElementById('Anadir').style.display = "none";
        document.getElementById('idUsuario').removeAttribute("disabled");
    }
    </script>
</head>

<body><?php
require_once('../../modelo/crud.php');

if (isset($_POST['registrar'])) {
    $hora = $_POST['hora'];
    $idPersonal = $_POST['idPersonal'];
    $idUsuario = $_POST['idUsuario'];
    $idTipoCita = $_POST['idTipoCita'];
    try {
    crud_insertar('cita', array('hora' => $hora, 'idPersonal' => $idPersonal, 'idUsuario' => $idUsuario, 'idTipoCita' => $idTipoCita));
    } catch (PDOException $e) {
        echo 'Error al insertar la cita: ' . $e->getMessage();
    }
}

if (isset($_POST['modificar'])) {
    $hora = $_POST['hora'];
    $idPersonal = $_POST['idPersonal'];
    $idTipoCita = $_POST['idTipoCita'];
    $id = $_POST['idCita'];
    try {//actualiza los datos por el id de provincia que se ha guardado en el hidden
        crud_actualizar('cita', array('hora' => $hora, 'idPersonal' => $idPersonal, 'idTipoCita' => $idTipoCita), "idCita = $id");
    } catch (PDOException $e) {
        echo 'Error al editar la cita: ' . $e->getMessage();
    }
}

if (isset($_POST['borrar'])) {
    $id = $_POST['idCita'];
    try {
        crud_borrar('cita', $id);
    } catch (PDOException $e) {
        echo "No se ha podido eliminar ya que el familiar está asiganda a un usuario";
    }
}

// mostrar tabla familiar
$citas=crud_get_all('cita');//trae la tabla familiar
$total = count($citas);/// empieza la paginación contando todos los usuarios
$pagina = isset($_GET['page']) ? $_GET['page'] : 1;//si me entra algo por página muestra esa página si no se va a la página 1
$porPagina = 2;//cantidad a mostrar por página
$paginasTotales = ceil($total / $porPagina);//ceil() redondea fracciones hacia arriba, realiza el cálculo de las páginas totales 
$inicio = ($pagina - 1) * $porPagina;//

echo '<table class="table table-hover">';
    echo '<tr>
        <th scope="col">Hora</th>
        <th scope="col">Usuario</th>
        <th scope="col">Personal</th>
        <th scope="col">Tipo Cita</th>
        <th scope="col">Borrar</th>
    </tr>';
    $usar_pagina = array_slice($citas, $inicio, $porPagina);//recorre desde el inicio hasta cuantos tiene que mostrar"porPagina"
foreach ($usar_pagina as $cita) {  

        $usuario = crud_select('usuario', 'idUsuario', $cita['idUsuario'] )[0];
        $personal = crud_select('personal', 'idPersonal', $cita['idPersonal'] )[0];
        $tipocita = crud_select('tipocita', 'idTipoCita', $cita['idTipoCita'] )[0];

        echo '<tr onclick="seleccionar(' . $cita['idCita'] . ');">
          <td scope="row">' . $cita['Hora']. '</td>
            <td scope="row">' . $usuario['Nombre']  . " " . $usuario['Apellido'] . '</td>
            <td scope="row">' . $personal['Nombre']  . " " . $personal['Apellido'] .'</td>
            <td scope="row">' . $tipocita['Nombre'] . '</td>         
            <td>' . ' <form action="" method="POST"><input type="hidden" name="idCita" value="' . $cita['idCita'] . '">
            <button onclick="if(!confirm(\'¿Estás seguro de borrar el registro?\')) event.preventDefault();" class="btn btn-primary" type="submit" name="borrar" value="Borrar">Borrar</button>
          </form>' . "</td>
            </tr>";
        }
        echo "</table>";
?>
    <button class="btn btn-primary" onclick="limpiarFormulario()" type="submit" id="Anadir" name="Anadir" value="Anadir"
        style="display: none;">Cancelar</button>
    <!--formulario de citas-->
    <nav class="paginacion" aria-label="Paginacion">
        <?php echo paginacion($paginasTotales, $pagina, '?'); //llama a la función de la paginación?>
    </nav>
    <div id='panel-modificar' class='d-flex'>
        <form method="post" class="">
            <input type="hidden" name="idCita" id="idCita" value="">
            <div class="input-group mb-1 d-inline-flex p-1 bd-highlight">
                <!--clase de bootstrap-->
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Hora: </span>
                </div>
                <input required type="datetime-local" class="form-control" id="hora" name="hora"
                    aria-describedby="basic-addon3">

                <?php
                $usuarios=crud_get_all('usuario');
                echo '<select id="idUsuario" name="idUsuario" class="form-select">'; 
                foreach ($usuarios as $usuario) {
                    echo '<option selected value=' . $usuario['idUsuario'] . '>' . $usuario['Dni'] . " " . $usuario['Apellido'] . " , " . $usuario['Nombre'] . '</option>'; //Imprime una opcion por cada ciudad
                }
                echo '</select>';//Fin del select

                $personales=crud_get_all('personal');
                echo '<select id="idPersonal" name="idPersonal" class="form-select">'; 
                foreach ($personales as $personal) { 
                    echo '<option selected value=' . $personal['idPersonal'] . '>' . " " . $personal['Apellido'] . " , " . $personal['Nombre'] . '</option>'; //Imprime una opcion por cada ciudad
                }                    
                echo '</select>'; //Fin del select

                $tipocitas=crud_get_all('TipoCita');
                echo '<select id="idTipoCita" name="idTipoCita" class="form-select">';  
                foreach ($tipocitas as $tipocita) { 
                    echo '<option selected value=' . $tipocita['idTipoCita'] . '>' . " " . $tipocita['Nombre'] . '</option>'; //Imprime una opcion por cada ciudad
                }                    
                echo '</select>'; //Fin del select
                ?>

                <button class="btn btn-primary" type="submit" id="registrar" name="registrar"
                    value="Enviar">Registrar</button>
                <button class="btn btn-primary" type="submit" id="modificar" name="modificar" value="Modificar"
                    style="display: none;">Modificar</button>
            </div>
        </form>
    </div>

</body>

</html>