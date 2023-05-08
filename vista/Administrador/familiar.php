<!DOCTYPE html>
<html lang="en">
<?php require_once '../paginacion.php'; ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Administración BD Familiar</title>
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
        var url = '/Hospital/controlador/controlador_familiar.php';
        var params = 'action=seleccionar&id=' + id;
        http.open('POST', url, true);

        //
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        // maneja la respues del servidor 
        http.onreadystatechange = function() {
            //respuesta ajax correcta
            if (http.readyState == 4 && http.status == 200) {
                var familiar = JSON.parse(http.response);
                document.getElementById('nombre').value = familiar[0].Nombre; //dato mapeados
                document.getElementById('apellido').value = familiar[0].Apellido; //dato mapeados
                document.getElementById('telefono').value = familiar[0].Telefono; //dato mapeados
                document.getElementById('idUsuario').value = familiar[0].idUsuario; //dato mapeados
                document.getElementById('idUsuario').setAttribute("disabled", "disabled");
                document.getElementById('registrar').style.display = 'none'; //cambia la visibilidad de los botones
                document.getElementById('modificar').style.display = 'block';

                //deja el id oculto para luego uasarlo en modificar
                document.getElementById('idFamiliar').value = id;
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
        document.getElementById('apellido').value = "";
        document.getElementById('telefono').value = "";
        document.getElementById('idUsuario').value = "";
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
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $idUsuario = $_POST['idUsuario'];
    try {
    crud_insertar('familiar', array('nombre' => $nombre, 'apellido' => $apellido, 'telefono' => $telefono, 'idUsuario' => $idUsuario));
    } catch (PDOException $e) {
        echo 'Error al insertar el familiar: ' . $e->getMessage();
    }
}

if (isset($_POST['modificar'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $id = $_POST['idFamiliar'];
    try {//actualiza los datos por el id de provincia que se ha guardado en el hidden
        crud_actualizar('familiar', array('nombre' => $nombre,'apellido' => $apellido, 'telefono' => $telefono), "idFamiliar = $id");
    } catch (PDOException $e) {
        echo 'Error al insertar el familiar: ' . $e->getMessage();
    }
}

if (isset($_POST['borrar'])) {
    $id = $_POST['idFamiliar'];
    try {
        crud_borrar('familiar', $id);
    } catch (PDOException $e) {
        echo "No se ha podido eliminar ya que el familiar está asiganda a un usuario";
    }
}

// mostrar tabla familiar
$familiares=crud_get_all('familiar');//trae la tabla familiar
$total = count($familiares);/// empieza la paginación contando todos los usuarios
$pagina = isset($_GET['page']) ? $_GET['page'] : 1;//si me entra algo por página muestra esa página si no se va a la página 1
$porPagina = 2;//cantidad a mostrar por página
$paginasTotales = ceil($total / $porPagina);//ceil() redondea fracciones hacia arriba, realiza el cálculo de las páginas totales 
$inicio = ($pagina - 1) * $porPagina;//

echo '<table class="table table-hover">';
    echo '<tr>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Telefono</th>
        <th scope="col">Familiar</th>
        <th scope="col">Borrar</th>
    </tr>';
    $usar_pagina = array_slice($familiares, $inicio, $porPagina);//recorre desde el inicio hasta cuantos tiene que mostrar"porPagina"
    foreach ($usar_pagina as $familiar) { 
        $usuario = crud_select('usuario', 'idUsuario', $familiar['idUsuario'] )[0];

        echo '<tr onclick="seleccionar(' . $familiar['idFamiliar'] . ');">
            <td scope="row">' . $familiar['Nombre'] . '</td>
            <td scope="row">' . $familiar['Apellido'] . '</td>
            <td scope="row">' . $familiar['Telefono'] . '</td> 
            <td>' . $usuario['Nombre']  . " " . $usuario['Apellido']  . '</td>            
            <td>' . ' <form action="" method="POST"><input type="hidden" name="idFamiliar" value="' . $familiar['idFamiliar'] . '">
            <button onclick="if(!confirm(\'¿Estás seguro de borrar el registro?\')) event.preventDefault();" class="btn btn-primary" type="submit" name="borrar" value="Borrar">Borrar</button>
          </form>' . "</td>
            </tr>";
        }
        echo "</table>";
?>
    <button class="btn btn-primary" onclick="limpiarFormulario()" type="submit" id="Anadir" name="Anadir" value="Anadir"
        style="display: none;">Cancelar</button>
    <!--formulario de familiares-->
    <nav class="paginacion" aria-label="Paginacion">
        <?php echo paginacion($paginasTotales, $pagina, '?'); //llama a la función de la paginación?>
    </nav>
    <div id='panel-modificar' class='d-flex'>
        <form method="post" class="">
            <input type="hidden" name="idFamiliar" id="idFamiliar" value="">
            <div class="input-group mb-1 d-inline-flex p-1 bd-highlight">
                <!--clase de bootstrap-->
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Nombre: </span>
                </div>
                <input required type="text" class="form-control" id="nombre" name="nombre"
                    aria-describedby="basic-addon3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Apellido: </span>
                </div>
                <input required type="text" class="form-control" id="apellido" name="apellido"
                    aria-describedby="basic-addon3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Telefono: </span>
                </div>
                <input required type="text" class="form-control" id="telefono" name="telefono"
                    aria-describedby="basic-addon3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Usuario: </span>
                </div>
                <?php
                //pk
                $usuarios=crud_get_all('usuario');//trae la tabla ciudad
                echo '<select id="idUsuario" name="idUsuario" class="form-select">'; //imprime el select con el idCiudad
        

                foreach ($usuarios as $usuario) { //Recorre las ciudades
                    echo '<option selected value=' . $usuario['idUsuario'] . '>' . $usuario['Dni'] . " " . $usuario['Apellido'] . " , " . $usuario['Nombre'] . '</option>'; //Imprime una opcion por cada ciudad
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