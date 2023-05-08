<!DOCTYPE html>
<html lang="en">
<?php require_once '../paginacion.php'; ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Administración BD Centro</title>
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
        var url = '/Hospital/controlador/controlador_centro.php';
        var params = 'action=seleccionar&id=' + id;
        http.open('POST', url, true);

        //
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        // maneja la respues del servidor 
        http.onreadystatechange = function() {
            //respuesta ajax correcta
            if (http.readyState == 4 && http.status == 200) {
                var centro = JSON.parse(http.response);
                debugger;
                document.getElementById('nombre').value = centro[0].Nombre; //dato mapeados
                document.getElementById('direccion').value = centro[0].Direccion; //dato mapeados
                document.getElementById('telefono').value = centro[0].Telefono; //dato mapeados
                document.getElementById('idCiudad').value = centro[0].idCiudad; //dato mapeados
                document.getElementById('registrar').style.display = 'none'; //cambia la visibilidad de los botones
                document.getElementById('modificar').style.display = 'block';
                //deja el id oculto para luego uasarlo en modificar
                document.getElementById('idCentro').value = id;
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
        document.getElementById('direccion').value = "";
        document.getElementById('telefono').value = "";
        document.getElementById('idCiudad').value = "";
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
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $idCiudad = $_POST['idCiudad'];
    try {
    crud_insertar('centro', array('nombre' => $nombre, 'direccion' => $direccion, 'telefono' => $telefono, 'idCiudad' => $idCiudad));
    } catch (PDOException $e) {
        echo 'Error al insertar la centro en la provincia: ' . $e->getMessage();
    }
}

if (isset($_POST['modificar'])) {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $idCiudad = $_POST['idCiudad'];
    $idCentro = $_POST['idCentro'];
    try {//actualiza los datos por el id de provincia que se ha guardado en el hidden
        crud_actualizar('centro', array('nombre' => $nombre, 'direccion' => $direccion, 'telefono' => $telefono, 'idCiudad' => $idCiudad), "idCentro = $id");
    } catch (PDOException $e) {
        echo 'Error al insertar la provincia: ' . $e->getMessage();
    }
}

if (isset($_POST['borrar'])) {
    $id = $_POST['idcentro'];
    try {
        crud_borrar('centro', $id);
    } catch (PDOException $e) {
        echo "No se ha podido eliminar ya que la provincia esta provincia está asiganda en otro elemento.";
    }
}
// acciones en la tabla M:M Centro_Departamento
if (isset($_POST['registrarCentroDepartamento'])) {
    $idCentro = $_POST['idCentroDepartamento_Centro'];
    $idDepartamento = $_POST['idCentroDepartamento_Departamento'];
    try {
        crud_insertar('Centro_Departamento', array('idCentro' => $idCentro, 'idDepartamento' => $idDepartamento));
    } catch (PDOException $e) {
        echo "No se ha insertar.";
    }
}
//borra un elementos de la tabla M:M Centro_Departamento
if (isset($_POST['borrarDepartamento'])) {
    $idDepartamento = $_POST['idDepartamento'];
    $idCentro = $_POST['idCentroDepartamento'];
    try {
        crud_borrar_relacion('Centro_Departamento','Centro', $idCentro, 'Departamento', $idDepartamento);
    } catch (PDOException $e) {
        echo "No se ha podido eliminar el departamento ya que está asigando en otro elemento.";
    }
}
// mostrar tabla centro
$centros=crud_get_all('centro');//trae la tabla centro
$total = count($centros);/// empieza la paginación contando todos los usuarios
$pagina = isset($_GET['page']) ? $_GET['page'] : 1;//si me entra algo por página muestra esa página si no se va a la página 1
$porPagina = 2;//cantidad a mostrar por página
$paginasTotales = ceil($total / $porPagina);//ceil() redondea fracciones hacia arriba, realiza el cálculo de las páginas totales 
$inicio = ($pagina - 1) * $porPagina;//

echo '<table class="table table-hover">';
    echo '<tr>
        <th scope="col">Nombre</th>
        <th scope="col">Direccion</th>
        <th scope="col">Telefono</th>
        <th scope="col">Ciudad</th>
        <th scope="col">Borrar</th>
    </tr>';
    $usar_pagina = array_slice($centros, $inicio, $porPagina);//recorre desde el inicio hasta cuantos tiene que mostrar"porPagina"
    foreach ($usar_pagina as $centro) {
        $ciudad = crud_select('ciudad', 'idCiudad', $centro['idCiudad'] )[0];
        echo '<tr onclick="seleccionar(' . $centro['idCentro'] . ');">
            <td scope="row">' . $centro['Nombre'] . '</td>
            <td scope="row">' . $centro['Direccion'] . '</td>
            <td scope="row">' . $centro['Telefono'] . '</td> 
            <td>' . $ciudad['Nombre']  . '</td>            
            <td>' . ' <form action="" method="POST"><input type="hidden" name="idcentro" value="' . $centro['idCentro'] . '">
            <button onclick="if(!confirm(\'¿Estás seguro de borrar el registro?\')) event.preventDefault();" class="btn btn-primary" type="submit" name="borrar" value="Borrar">Borrar</button>
          </form>' . "</td>
            </tr>";
        }
        echo "</table>";
?>
    <button class="btn btn-primary" onclick="limpiarFormulario()" type="submit" id="Anadir" name="Anadir" value="Anadir"
        style="display: none;">Cancelar</button>
    <!--formulario Centros-->
    <nav class="paginacion" aria-label="Paginacion">
        <?php echo paginacion($paginasTotales, $pagina, '?'); //llama a la función de la paginación?>
    </nav>
    <div id='panel-modificar' class='d-flex'>
        <form method="post" class="">
            <input type="hidden" name="idCentro" id="idCentro" value="">
            <div class="input-group mb-1 d-inline-flex p-1 bd-highlight">
                <!--clase de bootstrap-->
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Centro: </span>
                </div>
                <input required type="text" class="form-control" id="nombre" name="nombre"
                    aria-describedby="basic-addon3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Dirección: </span>
                </div>
                <input required type="text" class="form-control" id="direccion" name="direccion"
                    aria-describedby="basic-addon3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Telefono: </span>
                </div>
                <input required type="text" class="form-control" id="telefono" name="telefono"
                    aria-describedby="basic-addon3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Ciudad: </span>
                </div>
                <?php
                //pk
                $ciudades=crud_get_all('ciudad');//trae la tabla ciudad
                echo '<select id="idCiudad" name="idCiudad" class="form-select">'; //imprime el select con el idCiudad

                foreach ($ciudades as $ciudad) { //Recorre las ciudades
                    echo '<option selected value=' . $ciudad['idCiudad'] . '>' . $ciudad['Nombre'] . '</option>'; //Imprime una opcion por cada ciudad
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
    <?php

// tabla M:M
$centroDepartamentos=crud_get_all('Centro_Departamento');//trae la tabla centro_departamento
//pinta la tabla "Centro_Departamento"
echo '<table class="table table-hover">';
    echo '<tr>
        <th scope="col">Centro</th> 
        <th scope="col">Departamento</th>        
        <th scope="col"></th>
    </tr>';
    foreach ($centroDepartamentos as $centroDepartamento) {
        //recorre la tabla para tener el nombre correspondiente a cada id
        $departamento = crud_select('departamento', 'idDepartamento', $centroDepartamento['idDepartamento'] )[0];
        $centro = crud_select('centro', 'idCentro', $centroDepartamento['idCentro'] )[0];
        //cojo los nombres de ambas tablas, oculta los id para cuando le de a la acción borrar, esos id pasaran a la acción isset
        // borrarDepartamento.
        echo '<tr>
            <td scope="row">' . $centro['Nombre'] . '</td>
            <td scope="row">' . $departamento['Nombre'] . '</td>
            <td>' . ' <form action="" method="POST"><input type="hidden" name="idDepartamento" value="' . $centroDepartamento['idDepartamento'] . '">
            <input type="hidden" name="idCentroDepartamento" value="' . $centroDepartamento['idCentro'] . '">
            <button onclick="confirm(\'¿Estas seguro de borrar el registro?\');" class="btn btn-primary" type="submit" name="borrarDepartamento" value="Borrar">Borrar</button>
            </form>' . "</td>
            </tr>";
        }
        echo "</table>";

?>
    <div id='panel-centro_departamento' class='d-flex'>
        <form method="post" class="">
            <div class="input-group mb-1 d-inline-flex p-1 bd-highlight">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Centro: </span>
                </div>
                <?php
                //igual que en la tabla ciudad    
                $centros=crud_get_all('centro');//trae la tabla ciudad
                echo '<select id="idCentroDepartamento_Centro" name="idCentroDepartamento_Centro" class="form-select">'; //imprime el select con el idCiudad

                foreach ($centros as $centro) { //Recorre las ciudades
                    echo '<option selected value=' . $centro['idCentro'] . '>' . $centro['Nombre'] . '</option>'; //Imprime una opcion por cada ciudad
                }
                ?>
                </select>

                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Departamento: </span>
                </div>
                <?php
                $departamentos=crud_get_all('departamento');//trae la tabla ciudad?>
                <select id="idCentroDepartamento_Departamento" name="idCentroDepartamento_Departamento"
                    class="form-select">
                    <!--imprime el select con el idCiudad-->
                    <?php
                foreach ($departamentos as $departamento) { //Recorre las ciudades
                    echo '<option selected value=' . $departamento['idDepartamento'] . '>' . $departamento['Nombre'] . '</option>'; //Imprime una opcion por cada ciudad
                }
                ?>
                </select>
                <!--Fin del select-->
                <button class="btn btn-primary" type="submit" id="registrarCentroDepartamento"
                    name="registrarCentroDepartamento" value="EnviarCentroDepartamento">Registrar departamento en
                    centro</button>
            </div>
        </form>
    </div>
</body>

</html>