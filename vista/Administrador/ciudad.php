<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Administración BD Ciudad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <script>
    /*
    @function para buscar por id, mediante una llamada asíncrona con Ajax al servidor
    *
    */

    function seleccionar(id) {
        var http = new XMLHttpRequest();
        var url = '/Hospital/controlador/controlador_ciudad.php';
        var params = 'action=seleccionar&id=' + id;
        http.open('POST', url, true);

        //
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        // maneja la respues del servidor 
        http.onreadystatechange = function() {
            //respuesta ajax correcta
            if (http.readyState == 4 && http.status == 200) {
                var ciudad = JSON.parse(http.response);
                document.getElementById('nombre').value = ciudad[0].Nombre; //dato mapeados
                document.getElementById('idProvincia').value = ciudad[0].idProvincia; //dato mapeados
                document.getElementById('registrar').style.display = 'none'; //cambia la visibilidad de los botones
                document.getElementById('modificar').style.display = 'block';
                //deja el id oculto para luego uasarlo en modificar
                document.getElementById('idCiudad').value = id;
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

if (isset($_POST['registrar'])) {
    $nombre = $_POST['nombre'];
    $idprovincia = $_POST['idProvincia'];
    try {
    crud_insert('Ciudad', array('nombre' => $nombre, 'idProvincia' => $idprovincia));
    } catch (PDOException $e) {
        echo 'Error al insertar la ciudad en la provincia: ' . $e->getMessage();
    }
}

if (isset($_POST['modificar'])) {
    $idProvincia = $_POST['idProvincia'];
    $nombre = $_POST['nombre'];
    $id = $_POST['idCiudad'];
    echo $idProvincia . " " . $nombre . " " .$id . " " ;
    try {//actualiza los datos por el id de provincia que se ha guardado en el hidden
        crud_update('Ciudad', array('nombre' => $nombre, 'idProvincia' => $idProvincia), "idCiudad = $id");
    } catch (PDOException $e) {
        echo 'Error al insertar la provincia: ' . $e->getMessage();
    }
}

if (isset($_POST['borrar'])) {
    $id = $_POST['idCiudad'];
    try {
        crud_delete('Ciudad', $id);
    } catch (PDOException $e) {
        echo "No se ha podido eliminar ya que la provincia esta provincia está asiganda en otro elemento.";
    }
}

// mostrar tabla ciudad
$ciudades=crud_get_all('ciudad');//trae la tabla ciudad

echo '<table class="table table-hover">';
    echo '<tr>
        <th scope="col">Ciudades</th>
        <th scope="col">Provincia</th>
        <th scope="col">Borrar</th>
    </tr>';
    foreach ($ciudades as $ciudad) {
        
        $provincia = crud_select('Provincia', 'idProvincia', $ciudad['idProvincia'] )[0];
        echo '<tr onclick="seleccionar(' . $ciudad['idCiudad'] . ');">
            <td scope="row">' . $ciudad['Nombre'] . '</td>            
            <td>' . $provincia['Nombre']  . '</td>            
            <td>' . ' <form action="" method="POST"><input type="hidden" name="idCiudad" value="' . $ciudad['idCiudad'] . '">
            <button onclick="confirm(\'¿Estas seguro de borrar el registro?\');" class="btn btn-primary" type="submit" name="borrar" value="Borrar">Borrar</button>
          </form>' . "</td>
            </tr>";
        }
        echo "</table>";
?>
    <button class="btn btn-primary" onclick="limpiarFormulario()" type="submit" id="Anadir" name="Anadir" value="Anadir"
        style="display: none;">Cancelar</button>
    <!--formulario de usuarios-->
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Página</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
    <div id='panel-modificar' class='d-flex'>
        <form method="post" class="">
            <input type="hidden" name="idCiudad" id="idCiudad" value="">
            <div class="input-group mb-1 d-inline-flex p-1 bd-highlight">
                <!--clase de bootstrap-->
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Nombre: </span>
                </div>
                <input required type="text" class="form-control" id="nombre" name="nombre"
                    aria-describedby="basic-addon3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Provincia: </span>
                </div>
                <?php
                //pk
                $provincias=crud_get_all('provincia');//trae la tabla provincia
                echo '<select id="idProvincia" name="idProvincia" class="form-select">'; //imprime el select con el idProvincia

                foreach ($provincias as $provincia) { //Recorre las provincias
                    echo '<option selected value=' . $provincia['idProvincia'] . '>' . $provincia['Nombre'] . '</option>'; //Imprime una opcion por cada provincia
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