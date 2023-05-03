<?php require_once '../paginacion.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Administración BD Provincia</title>
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
        var url = '/Hospital2/controlador/controlador_provincia.php';
        var params = 'action=seleccionar&id=' + id;
        http.open('POST', url, true);

        //
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        // maneja la respues del servidor 
        http.onreadystatechange = function() {
            //respuesta ajax correcta
            if (http.readyState == 4 && http.status == 200) {
                var provincia = JSON.parse(http.response);
                document.getElementById('nombre').value = provincia[0].Nombre; //dato mapeados
                document.getElementById('registrar').style.display = 'none'; //cambia la visibilidad de los botones
                document.getElementById('modificar').style.display = 'block';
                //deja el id oculto para luego uasarlo en modificar
                document.getElementById('idProvincia').value = id;
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
        document.getElementById('registrar').style.display = "block";
        document.getElementById('modificar').style.display = "none";
        document.getElementById('Anadir').style.display = "none";
    }
    </script>
</head>

<body><?php
require_once('../../modelo/crud.php');

if (isset($_POST['registrar'])) {//acción añadir
    $nombre = $_POST['nombre'];
    try {
    crud_insertar('Provincia', array('nombre' => $nombre));//pasa la tabla y los campos como array
    } catch (PDOException $e) {
        echo 'Error al insertar la provincia: ' . $e->getMessage();
    }
}
if (isset($_POST['modificar'])) {//acción modificar
    $id = $_POST['idProvincia'];//id que le pasa cuando hace onclick y llama a la función seleccionar
    $nombre = $_POST['nombre'];//campo que muestra

    try {//actualiza los datos por el id de provincia que se ha guardado en el hidden
        crud_actualizar('Provincia', array('nombre' => $nombre), "idProvincia = $id");//tabla, campos,condicion(id)
    } catch (PDOException $e) {
        echo 'Error al insertar la provincia: ' . $e->getMessage();
    }
}

if (isset($_POST['borrar'])) {//acción eliminar
    $id = $_POST['idProvincia'];

    try {//borra la provincia por id
        crud_borrar('Provincia', $id);
    } catch (PDOException $e) {
        echo "No se ha podido eliminar ya que la provincia está asiganda en otro elemento.";
    }
}

// mostrar tabla provincias
$provincias=crud_get_all('provincia');//trae la tabla provincia
$total = count($provincias);/// empieza la paginación contando todos los usuarios
$pagina = isset($_GET['page']) ? $_GET['page'] : 1;//si me entra algo por página muestra esa página si no se va a la página 1
$porPagina = 2;//cantidad a mostrar por página
$paginasTotales = ceil($total / $porPagina);//ceil() redondea fracciones hacia arriba, realiza el cálculo de las páginas totales 
$inicio = ($pagina - 1) * $porPagina;//

echo "<table class='table table-hover'>";
    echo "<tr>
        <th scope='col'>Provincia</th>
        <th scope=\"col\"></th>
    </tr>";
    $usar_pagina = array_slice($provincias, $inicio, $porPagina);//recorre desde el inicio hasta cuantos tiene que mostrar"porPagina"
    foreach ($usar_pagina as $provincia) {
        echo '<tr onclick="seleccionar(' . $provincia['idProvincia'] . ');">
            <td scope="row">' . $provincia['Nombre'] . '</td>
            <td>' . ' <form action="" method="POST"><input type="hidden" name="idProvincia" value="' . $provincia['idProvincia'] . '">
            <button onclick="confirm(\'¿Estas seguro de borrar el registro?\');" class="btn btn-primary" type="submit" name="borrar" value="Borrar">Borrar</button>
          </form>' . "</td>
            </tr>";
        }
        echo "</table>";
?>
    <button class="btn btn-primary" onclick="limpiarFormulario()" type="submit" id="Anadir" name="Anadir" value="Anadir"
        style="display: none;">Cancelar</button>
    <!--formulario de usuarios-->
    <nav class="paginacion" aria-label="Paginacion">
        <?php echo paginacion($paginasTotales, $pagina, '?'); //llama a la función de la paginación?>
    </nav>
    <div id='panel-modificar' class='d-flex'>
        <form method="post" class="">
            <input type="hidden" name="idProvincia" id="idProvincia" value="">
            <div class="input-group mb-1 d-inline-flex p-1 bd-highlight">
                <!--clase de bootstrap-->
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Nombre: </span>
                </div>
                <input required type="text" class="form-control" id="nombre" name="nombre"
                    aria-describedby="basic-addon3">
                <button class="btn btn-primary" type="submit" id="registrar" name="registrar"
                    value="Enviar">Registrar</button>
                <button class="btn btn-primary" type="submit" id="modificar" name="modificar" value="Modificar"
                    style="display: none;">Modificar</button>
            </div>
        </form>
    </div>
</body>

</html>