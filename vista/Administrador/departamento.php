<!DOCTYPE html>
<html lang="en">
<?php require_once '../paginacion.php'; ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Administración BD Departamento</title>
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
        var url = '/Hospital2/controlador/controlador_departamento.php';
        var params = 'action=seleccionar&id=' + id;
        http.open('POST', url, true);

        //
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        // maneja la respues del servidor 
        http.onreadystatechange = function() {
            //respuesta ajax correcta
            if (http.readyState == 4 && http.status == 200) {
                var departamento = JSON.parse(http.response);
                document.getElementById('nombre').value = departamento[0].Nombre; //dato mapeados
                document.getElementById('descripcion').value = departamento[0].Descripcion; //dato mapeados
                document.getElementById('registrar').style.display = 'none'; //cambia la visibilidad de los botones
                document.getElementById('modificar').style.display = 'block';

                //deja el id oculto para luego uasarlo en modificar
                document.getElementById('idDepartamento').value = id;
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
        document.getElementById('descripcion').value = "";
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
    $descripcion = $_POST['descripcion'];
    try {
    crud_insertar('Departamento', array('nombre' => $nombre, 'descripcion' => $descripcion));
    } catch (PDOException $e) {
        echo 'Error al insertar el Departamento: ' . $e->getMessage();
    }
}

if (isset($_POST['modificar'])) {
    $nombre = $_POST['nombre'];   
    $descripcion = $_POST['descripcion'];
    $id = $_POST['idDepartamento'];
    try {
        crud_actualizar('Departamento', array('nombre' => $nombre, 'descripcion' => $descripcion), "idDepartamento = $id");
    } catch (PDOException $e) {
        echo 'Error al insertar el Departamento: ' . $e->getMessage();
    }
}

if (isset($_POST['borrar'])) {
    $id = $_POST['idDepartamento'];
    try {
        crud_borrar('Departamento', $id);
    } catch (PDOException $e) {
        echo "No se ha podido eliminar ya que el Departamento está asiganda a un usuario";
    }
}

if (isset($_POST['registrarDepartamentoPersonal'])) {
    $idDepartamento = $_POST['idDepartamentoPersonal_Departamento'];
    $idPersonal = $_POST['idDepartamentoPersonal_Personal'];
    try {
        crud_insertar('Departamento_Personal', array('idDepartamento' => $idDepartamento, 'idPersonal' => $idPersonal));
    } catch (PDOException $e) {
        echo "No se ha insertar.";
    }
}

if (isset($_POST['borrarPersonal'])) {
    $idDepartamento = $_POST['idDepartamento'];
    $idPersonal = $_POST['idDepartamentoPersonal'];
    try {
        crud_borrar_relacion('Departamento_Personal','Departamento', $idDepartamento, 'Personal', $idPersonal);
    } catch (PDOException $e) {
        echo "No se ha podido eliminar.";
    }
}

// mostrar tabla Departamento
$departamentos=crud_get_all('Departamento');//trae la tabla Departamento
$total = count($departamentos);/// empieza la paginación contando todos los usuarios
$pagina = isset($_GET['page']) ? $_GET['page'] : 1;//si me entra algo por página muestra esa página si no se va a la página 1
$porPagina = 2;//cantidad a mostrar por página
$paginasTotales = ceil($total / $porPagina);//ceil() redondea fracciones hacia arriba, realiza el cálculo de las páginas totales 
$inicio = ($pagina - 1) * $porPagina;//

echo '<table class="table table-hover">';
    echo '<tr>
        <th scope="col">Nombre</th>
        <th scope="col">Descripción</th>
        <th scope="col">Borrar</th>
    </tr>';
    $usar_pagina = array_slice($departamentos, $inicio, $porPagina);//recorre desde el inicio hasta cuantos tiene que mostrar"porPagina"
foreach ($usar_pagina as $departamento) {   

        echo '<tr onclick="seleccionar(' . $departamento['idDepartamento'] . ');">
            <td scope="row">' . $departamento['Nombre'] . '</td>
            <td scope="row">' . $departamento['Descripcion'] . '</td>         
            <td>' . ' <form action="" method="POST"><input type="hidden" name="idDepartamento" value="' . $departamento['idDepartamento'] . '">
            <button onclick="if(!confirm(\'¿Estás seguro de borrar el registro?\')) event.preventDefault();" class="btn btn-primary" type="submit" name="borrar" value="Borrar">Borrar</button>
          </form>' . "</td>
            </tr>";
        }
        echo "</table>";
?>
    <button class="btn btn-primary" onclick="limpiarFormulario()" type="submit" id="Anadir" name="Anadir" value="Anadir"
        style="display: none;">Cancelar</button>
    <!--formulario departamento-->
    <nav class="paginacion" aria-label="Paginacion">
        <?php echo paginacion($paginasTotales, $pagina, '?'); //llama a la función de la paginación?>
    </nav>
    <div id='panel-modificar' class='d-flex'>
        <form method="post" class="">
            <input type="hidden" name="idDepartamento" id="idDepartamento" value="">
            <div class="input-group mb-1 d-inline-flex p-1 bd-highlight">
                <!--clase de bootstrap-->
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Nombre: </span>
                </div>
                <input required type="text" class="form-control" id="nombre" name="nombre"
                    aria-describedby="basic-addon3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Descripción: </span>
                </div>
                <input required type="text" class="form-control" id="descripcion" name="descripcion"
                    aria-describedby="basic-addon3">
                <button class="btn btn-primary" type="submit" id="registrar" name="registrar"
                    value="Enviar">Registrar</button>
                <button class="btn btn-primary" type="submit" id="modificar" name="modificar" value="Modificar"
                    style="display: none;">Modificar</button>
            </div>
        </form>
    </div>
    <?php
    $departamento_personales=crud_get_all('Departamento_Personal');//trae la tabla centro_departamento

echo '<table class="table table-hover">';
    echo '<tr>
        <th scope="col">Departamento</th> 
        <th scope="col">Personal</th>        
        <th scope="col"></th>
    </tr>';
    foreach ($departamento_personales as $departamento_personal) {
        
        $departamento = crud_select('departamento', 'idDepartamento', $departamento_personal['idDepartamento'] )[0];
        $personal = crud_select('personal', 'idPersonal', $departamento_personal['idPersonal'] )[0];
        echo '<tr>
            <td scope="row">' . $departamento['Nombre'] . '</td>
            <td scope="row">' . $personal['Nombre'] . " " .$personal['Apellido'] . '</td>
            <td>' . ' <form action="" method="POST"><input type="hidden" name="idDepartamento" value="' . $departamento_personal['idDepartamento'] . '">
            <input type="hidden" name="idDepartamentoPersonal" value="' . $departamento_personal['idPersonal'] . '">
            <button onclick="confirm(\'¿Estas seguro de borrar el registro?\');" class="btn btn-primary" type="submit" name="borrarPersonal" value="Borrar">Borrar</button>
            </form>' . "</td>
            </tr>";
        }
        echo "</table>";

?>
    <div id='panel-departamento_empleado' class='d-flex'>
        <form method="post" class="">
            <div class="input-group mb-1 d-inline-flex p-1 bd-highlight">
                <?php
                echo '<div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Departamento: </span></div>';
                $departamentos=crud_get_all('departamento');//trae la tabla ciudad
                echo '<select id="idDepartamentoPersonal_Departamento" name="idDepartamentoPersonal_Departamento" class="form-select">'; //imprime el select con el idCiudad

                foreach ($departamentos as $departamento) { //Recorre las ciudades
                    echo '<option selected value=' . $departamento['idDepartamento'] . '>' . $departamento['Nombre'] . '</option>'; //Imprime una opcion por cada ciudad
                }
                    
                echo '</select>'; //Fin del select
                echo '<div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Personal: </span></div>';
                $personales=crud_get_all('personal');//trae la tabla ciudad
                echo '<select id="idDepartamentoPersonal_Personal" name="idDepartamentoPersonal_Personal" class="form-select">'; //imprime el select con el idCiudad

                foreach ($personales as $personal) { //Recorre las ciudades
                    echo '<option selected value=' . $personal['idPersonal'] . '>' . $personal['Nombre'] . " " . $personal['Apellido'] .'</option>'; //Imprime una opcion por cada ciudad
                }
                    
                echo '</select>'; //Fin del select
                ?>

                <button class="btn btn-primary" type="submit" id="registrarDepartamentoPersonal"
                    name="registrarDepartamentoPersonal" value="EnviarDepartamentoPersonal">Registrar personal en
                    departamento</button>
            </div>
        </form>
    </div>
</body>

</html>