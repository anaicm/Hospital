<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Administración BD Provincia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <script>
    /*
    @function para eliminar por id, usando una solicitud HTTP asíncrona que realiza la llamada al servidor 
    *sin recargar la página.
    */
    function borrar(id) {
        var dialog = confirm("Estas seguro?"); //muestra una caja para confirmar o cancelar
        if (dialog) { //si acepta
            var http = new XMLHttpRequest(); //se crea un objeto para realizar la solicitud asíncrona al servidor
            var url = '/Hospital/controlador/controlador_ciudad.php';
            var params = 'action=borrar&id=' + id; // indicador para eliminar cuando accione onclick en eliminar
            http.open('POST', url, true);

            //envía la información de encabezado junto con la solicitud
            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            //llama a la función para definir la respuesta al servidor cuando cambia de estado
            http.onreadystatechange = function() {
                if (http.readyState == 4 && http.status == 200) { //
                    location.reload(); //Refresca la página
                }
            }
            http.send(params); // envio del Ajax al servidor.

        }
    }
    /*
    @function para buscar por id, mediante una llamada asíncrona con Ajax al servidor
    *
    */

    function seleccionar(id) {
        debugger;
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

if (isset($_POST['registrar'])) {//
    $id = $_POST['idCiudad'];
    $nombre = $_POST['nombre'];
    $idprovincia = $_POST['idProvincia'];
    try {
    crud_insert('Ciudad', array('nombre' => $nombre, 'idCiudad' => $id , 'idProvincia' => $idprovincia));
    } catch (PDOException $e) {
        echo 'Error al insertar la ciudad en la provincia: ' . $e->getMessage();
    }
}

if (isset($_GET['modificar'])) {
    $idProvincia = $_GET['idProvincia'];
    $nombre = $_GET['nombre'];
    $id = $_GET['idCiudad'];
    try {//actualiza los datos por el id de provincia que se ha guardado en el hidden
        crud_update('Ciudad', array('nombre' => $nombre, 'idProvincia' => $idProvincia), "idCiudad = $id");
    } catch (PDOException $e) {
        echo 'Error al insertar la provincia: ' . $e->getMessage();
    }
}




// mostrar tabla ciudad
$ciudades=crud_get_all('ciudad');//trae la tabla ciudad

echo "<table class='table table-hover'>";
    echo "<tr>
        <th scope='col'>Ciudades</th>
        <th scope='col'>Provincia</th>
        <th scope=\"col\"></th>
    </tr>";
    foreach ($ciudades as $ciudad) {
        
        $provincia = crud_select('Provincia', 'idProvincia', $ciudad['idProvincia'] );
        echo json_encode($provincia);
        echo $provincia['Nombre'];
        echo '<tr onclick="seleccionar(' . $ciudad['idCiudad'] . ');">
            <td scope="row">' . $ciudad['Nombre'] . '</td>            
            <td>' . $provincia['Nombre']  . '</td>
            <td' . '<button class="btn btn-primary" onclick="borrar(' . $ciudad['idCiudad'] . ', \'ciudad\');" id="borrar" name="borrar" value="Borrar">Borrar</button>' . "</td>
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
        <form method="get" class="">
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