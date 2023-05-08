<!DOCTYPE html>
<html lang="en">
<?php require_once '../paginacion.php'; ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Administración BD Tipo de cita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/usu_admin.css">

    <script>
    /*
    @function para buscar por id, mediante una llamada asíncrona con Ajax al servidor
    *
    */

    function seleccionar(id) {
        var http = new XMLHttpRequest();
        var url = '/Hospital/controlador/controlador_tipocita.php';
        var params = 'action=seleccionar&id=' + id;
        http.open('POST', url, true);

        //
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        // maneja la respues del servidor 
        http.onreadystatechange = function() {
            //respuesta ajax correcta
            if (http.readyState == 4 && http.status == 200) {
                var TipoCita = JSON.parse(http.response);
                document.getElementById('nombre').value = TipoCita[0].Nombre; //dato mapeados
                document.getElementById('duracion').value = TipoCita[0].Duracion; //dato mapeados
                document.getElementById('registrar').style.display = 'none'; //cambia la visibilidad de los botones
                document.getElementById('modificar').style.display = 'block';

                //deja el id oculto para luego uasarlo en modificar
                document.getElementById('idTipoCita').value = id;
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
        document.getElementById('nombre').value = "";
        document.getElementById('duracion').value = "";
        document.getElementById('registrar').style.display = "block";
        document.getElementById('modificar').style.display = "none";
        document.getElementById('Anadir').style.display = "none";
    }
    </script>
</head>

<body><?php
require_once('../../modelo/crud.php');

if (isset($_POST['registrar'])) {
    $nombre = $_POST['nombre'];   
    $duracion = $_POST['duracion'];
    try {
    crud_insertar('TipoCita', array('nombre' => $nombre, 'duracion' => $duracion));
    } catch (PDOException $e) {
        echo 'Error al insertar el TipoCita: ' . $e->getMessage();
    }
}

if (isset($_POST['modificar'])) {
    $nombre = $_POST['nombre'];
    $duracion = $_POST['duracion'];    
    $id = $_POST['idTipoCita'];
    try {//actualiza los datos por el id de provincia que se ha guardado en el hidden
        crud_actualizar('TipoCita', array('nombre' => $nombre, 'duracion' => $duracion), "idTipoCita = $id");
    } catch (PDOException $e) {
        echo 'Error al insertar el TipoCita: ' . $e->getMessage();
    }
}

if (isset($_POST['borrar'])) {
    $id = $_POST['idTipoCita'];
    try {
        crud_borrar('TipoCita', $id);
    } catch (PDOException $e) {
        echo "No se ha podido eliminar ya que el TipoCita está asiganda a un usuario";
    }
}


if (isset($_POST['registrarDepartamentoTipoCita'])) {
    $idDepartamento = $_POST['idDepartamentoTipoCita_Departamento'];
    $idTipoCita = $_POST['idDepartamentoTipoCita_TipoCita'];
    try {
        crud_insertar('Departamento_TipoCita', array('idDepartamento' => $idDepartamento, 'idTipoCita' => $idTipoCita));
    } catch (PDOException $e) {
        echo "No se ha insertar.";
    }
}

if (isset($_POST['borrarTipoCita'])) {
    $idDepartamento = $_POST['idDepartamento'];
    $idTipoCita = $_POST['idDepartamentoTipoCita'];
    try {
        crud_borrar_relacion('Departamento_TipoCita','Departamento', $idDepartamento, 'TipoCita', $idTipoCita);
    } catch (PDOException $e) {
        echo "No se ha podido eliminar.";
    }
}

// mostrar tabla TipoCita
$tipos_cita=crud_get_all('TipoCita');//trae la tabla TipoCita
$total = count($tipos_cita);/// empieza la paginación contando todos los usuarios
$pagina = isset($_GET['page']) ? $_GET['page'] : 1;//si me entra algo por página muestra esa página si no se va a la página 1
$porPagina = 2;//cantidad a mostrar por página
$paginasTotales = ceil($total / $porPagina);//ceil() redondea fracciones hacia arriba, realiza el cálculo de las páginas totales 
$inicio = ($pagina - 1) * $porPagina;//

echo '<table class="table table-hover">';
    echo '<tr>
        <th scope="col">Nombre</th>
        <th scope="col">Duracion</th>
        <th scope="col">Borrar</th>
    </tr>';
    $usar_pagina = array_slice($tipos_cita, $inicio, $porPagina);//recorre desde el inicio hasta cuantos tiene que mostrar"porPagina"
    foreach ($usar_pagina as $TipoCita) {    

        echo '<tr onclick="seleccionar(' . $TipoCita['idTipoCita'] . ');">
            <td scope="row">' . $TipoCita['Nombre'] . '</td>
            <td scope="row">' . $TipoCita['Duracion'] . '</td>         
            <td>' . ' <form action="" method="POST"><input type="hidden" name="idTipoCita" value="' . $TipoCita['idTipoCita'] . '">
            <button onclick="if(!confirm(\'¿Estás seguro de borrar el registro?\')) event.preventDefault();" class="btn btn-primary" type="submit" name="borrar" value="Borrar">Borrar</button>
          </form>' . "</td>
            </tr>";
        }
        echo "</table>";
?>
    <button class="btn btn-primary" onclick="limpiarFormulario()" type="submit" id="Anadir" name="Anadir" value="Anadir"
        style="display: none;">Cancelar</button>
    <!--formulario de tipo citas-->
    <nav class="paginacion" aria-label="Paginacion">
        <?php echo paginacion($paginasTotales, $pagina, '?'); //llama a la función de la paginación?>
    </nav>
    <div id='panel-modificar' class='d-flex'>
        <form method="post" class="">
            <input type="hidden" name="idTipoCita" id="idTipoCita" value="">
            <div class="input-group mb-1 d-inline-flex p-1 bd-highlight">
                <!--clase de bootstrap-->
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Nombre: </span>
                </div>
                <input required type="text" class="form-control" id="nombre" name="nombre"
                    aria-describedby="basic-addon3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Duracion: </span>
                </div>
                <input required type="text" class="form-control" id="duracion" name="duracion"
                    aria-describedby="basic-addon3">
                <button class="btn btn-primary" type="submit" id="registrar" name="registrar"
                    value="Enviar">Registrar</button>
                <button class="btn btn-primary" type="submit" id="modificar" name="modificar" value="Modificar"
                    style="display: none;">Modificar</button>
            </div>
        </form>
    </div>
    <?php
    $departamento_tiposcitas=crud_get_all('Departamento_TipoCita');//trae la tabla

echo '<table class="table table-hover">';
    echo '<tr>
        <th scope="col">Departamento</th> 
        <th scope="col">Tipo de Cita</th>        
        <th scope="col"></th>
    </tr>';
    foreach ($departamento_tiposcitas as $departamento_tiposcita) {
        
        $departamento = crud_select('Departamento', 'idDepartamento', $departamento_tiposcita['idDepartamento'] )[0];
        $tipo_cita = crud_select('TipoCita', 'idTipoCita', $departamento_tiposcita['idTipoCita'] )[0];
        echo '<tr>
            <td scope="row">' . $departamento['Nombre'] . '</td>
            <td scope="row">' . $tipo_cita['Nombre'] . '</td>
            <td>' . ' <form action="" method="POST"><input type="hidden" name="idDepartamento" value="' . $departamento_tiposcita['idDepartamento'] . '">
            <input type="hidden" name="idDepartamentoTipoCita" value="' . $departamento_tiposcita['idTipoCita'] . '">
            <button onclick="confirm(\'¿Estas seguro de borrar el registro?\');" class="btn btn-primary" type="submit" name="borrarTipoCita" value="Borrar">Borrar</button>
            </form>' . "</td>
            </tr>";
        }
        echo "</table>";

?>
    <div id='panel-departamento_tipocita' class='d-flex'>
        <form method="post" class="">
            <div class="input-group mb-1 d-inline-flex p-1 bd-highlight">
                <?php
                echo '<div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Departamento: </span></div>';
                $departamentos=crud_get_all('departamento');//trae la tabla ciudad
                echo '<select id="idDepartamentoTipoCita_Departamento" name="idDepartamentoTipoCita_Departamento" class="form-select">'; //imprime el select con el idCiudad

                foreach ($departamentos as $departamento) { //Recorre las ciudades
                    echo '<option selected value=' . $departamento['idDepartamento'] . '>' . $departamento['Nombre'] . '</option>'; //Imprime una opcion por cada ciudad
                }
                    
                echo '</select>'; //Fin del select
                echo '<div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Tipo de cita: </span></div>';
                $tipos_citas=crud_get_all('tipoCita');//trae la tabla ciudad
                echo '<select id="idDepartamentoTipoCita_TipoCita" name="idDepartamentoTipoCita_TipoCita" class="form-select">'; //imprime el select con el idCiudad

                foreach ($tipos_citas as $tipo_cita) { //Recorre las ciudades
                    echo '<option selected value=' . $tipo_cita['idTipoCita'] . '>' . $tipo_cita['Nombre'] .'</option>'; //Imprime una opcion por cada ciudad
                }
                    
                echo '</select>'; //Fin del select
                ?>

                <button class="btn btn-primary" type="submit" id="registrarDepartamentoTipoCita"
                    name="registrarDepartamentoTipoCita" value="EnviarDepartamentoTipoCita">Registrar tipo de cita en
                    departamento</button>
            </div>
        </form>
    </div>
</body>

</html>