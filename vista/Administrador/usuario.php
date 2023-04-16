<!--CRUD tabla usuario-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Administración BD usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <script>
    /*
    @function para eliminar por id, usando una solicitud HTTP asíncrona que realiza la llamada al servidor 
    *sin recargar la página.
    *
    */
    function borrar(id) {
        var dialog = confirm("Estas seguro?"); //muestra una caja para confirmar o cancelar
        if (dialog) { //si acepta
            var http = new XMLHttpRequest(); //se crea un objeto para realizar la solicitud asíncrona al servidor
            var url = '/Hospital/controlador/controlador_usuario.php';
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
        var http = new XMLHttpRequest();
        var url = '/Hospital/controlador/controlador_usuario.php';
        var params = 'action=seleccionar&id=' + id;
        http.open('POST', url, true);

        //
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        // maneja la respues del servidor 
        http.onreadystatechange = function() {
            //respuesta ajax correcta
            if (http.readyState == 4 && http.status == 200) {
                var usuario = JSON.parse(http.response);
                document.getElementById('nombre').value = usuario[0].Nombre; //datos mapeados
                document.getElementById('apellidos').value = usuario[0].Apellido;
                document.getElementById('dni').value = usuario[0].Dni;
                document.getElementById('dni').disabled = true;
                document.getElementById('Telefono').value = usuario[0].Telefono;
                document.getElementById('FechaNacimiento').value = usuario[0].FechaNacimiento;
                document.getElementById('email').value = usuario[0].Email;
                document.getElementById('rol').value = usuario[0].Rol;
                document.getElementById('registrar').style.display = 'none'; //cambia la visibilidad de los botones
                document.getElementById('modificar').style.display = 'block';
                document.getElementById('idUsuario').value = id; //deja el id oculto para luego uasarlo en modificar
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
        document.getElementById('apellidos').value = "";
        document.getElementById('dni').value = "";
        document.getElementById('dni').enabled = false;
        document.getElementById('Telefono').value = "";
        document.getElementById('FechaNacimiento').value = "";
        document.getElementById('email').value = "";
        document.getElementById('rol').value = "Usuario";
        document.getElementById('dni').disabled = false;
        document.getElementById('registrar').style.display = "block";
        document.getElementById('modificar').style.display = "none";
        document.getElementById('Anadir').style.display = "none";
    }
    </script>
</head>

<body><?php
require_once('../../modelo/crud.php');

if (isset($_POST['registrar'])) {//
    $nombre = $_POST['nombre'];
	$apellido = $_POST['apellidos'];
    $dni = $_POST['dni'];
	$telefono = $_POST['Telefono'];
	$fnacimiento = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['FechaNacimiento'])));
	$email = $_POST['email'];
	$contrasenia = $_POST['password'];
    try {
    crud_insert('Usuario', array('dni' => $dni, 'nombre' => $nombre, 'apellido' => $apellido, 'telefono' => $telefono, 'FechaNacimiento' => $fnacimiento,'contrasenia' => $contrasenia, 'email' => $email, 'rol' => 'Administrador'));
    } catch (PDOException $e) {
        echo 'Error al insertar usuario: ' . $e->getMessage();
    }
}

if (isset($_POST['modificar'])) {
    $id = $_POST['idUsuario'];
    $nombre = $_POST['nombre'];
	$apellido = $_POST['apellidos'];
    $dni = $_POST['dni'];
	$telefono = $_POST['Telefono'];
	$fnacimiento = date('d-m-Y', strtotime(str_replace('-', '/', $_POST['FechaNacimiento'])));
	$email = $_POST['email'];
	$contrasenia = $_POST['password'];
    $rol = $_POST['rol'];
    try {//actualiza los datos por el id de usuario que se ha guardado en el hidden
        crud_update('Usuario', array('dni' => $dni, 'nombre' => $nombre, 'apellido' => $apellido, 'telefono' => $telefono, 'FechaNacimiento' => $fnacimiento,'contrasenia' => $contrasenia, 'email' => $email, 'rol' => $rol), "idUsuario = $id");
    } catch (PDOException $e) {
        echo 'Error al insertar usuario: ' . $e->getMessage();
    }
}
//mostrar la tabla usuarios
$usuarios=crud_get_all('usuario');//trae la tabla usuario

echo "<table class='table table-hover'>";
    echo "<tr>
        <th scope=\"col\">Dni</th>
        <th scope=\"col\">Nombre</th>
        <th scope=\"col\">Apellidos</th>
        <th scope=\"col\">Teléfono</th>
        <th scope=\"col\">Email</th>
        <th scope=\"col\">Rol</th>
        <th scope=\"col\">Fecha_Nacimiento</th>
        <th scope=\"col\"></th>
        <th scope=\"col\"></th>
    </tr>";
/////
    foreach ($usuarios as $usuario) {
    echo '<tr onclick="seleccionar(' . $usuario['idUsuario'] . ');">
        <td scope="row">' . $usuario['Dni'] . "</td>
        <td>" . $usuario['Nombre'] . "</td>
        <td>" . $usuario['Apellido'] . "</td>
        <td>" . $usuario['Telefono'] . "</td>
        <td>" . $usuario['Email'] . "</td>
        <td>" . $usuario['Rol'] . "</td>
        <td>" . date('d-m-Y', strtotime(str_replace('-', '/', $usuario['FechaNacimiento']))) . "</td>
        <td>" . '<button class="btn btn-primary" onclick="borrar(' . $usuario['idUsuario'] . ', \'usuario\');" id="borrar" name="borrar" value="Borrar">Borrar</button>' . "</td>
        </tr>";
    }
    echo "</table>";
    //mostrar la tabla usuarios     
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
            <input type="hidden" name="idUsuario" id="idUsuario" value="">
            <div class="input-group mb-1 d-inline-flex p-1 bd-highlight">
                <!--clase de bootstrap-->
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Nombre: </span>
                </div>
                <input required type="text" class="form-control" id="nombre" name="nombre"
                    aria-describedby="basic-addon3">

                <div class="input-group-prepend">

                    <span class="input-group-text" id="basic-addon3">Apellidos: </span>
                </div>
                <input required type="text" class="form-control" id="apellidos" name="apellidos"
                    aria-describedby="basic-addon3"><br>
            </div>
            <div class="input-group mb-1 d-inline-flex p-1 bd-highlight">
                <div class="input-group-prepend">

                    <span class="input-group-text" id="basic-addon3">DNI: </span>
                </div>
                <input required type="tel" pattern="[0-9]{8}[A-Z]{1}" class="form-control" id="dni" name="dni"
                    aria-describedby="basic-addon3">

                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Fecha de nacimiento: </span>
                </div>
                <input required type="date" class="form-control" id="FechaNacimiento" name="FechaNacimiento"
                    aria-describedby="basic-addon3">
            </div>
            <div class="input-group mb-1 d-inline-flex p-1 bd-highlight">
                <div class="input-group-prepend">

                    <span class="input-group-text" id="basic-addon3">Teléfono: </span>
                </div>
                <input required type="tel" pattern="[0-9]{9}" class="form-control" id="Telefono" name="Telefono"
                    aria-describedby="basic-addon3">

                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Email: </span>
                </div>

                <input type="email" class="form-control" id="email" name="email" aria-describedby="basic-addon3">
            </div>
            <div class="input-group mb-1 d-inline-flex p-1 bd-highlight">
                <div class="input-group-prepend">

                    <span class="input-group-text" id="basic-addon3">Contraseña: </span>
                </div>
                <input type="password" class="form-control" id="password" name="password"
                    aria-describedby="basic-addon3">

                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Rol: </span>
                </div>
                <select id='rol' name='rol' class="form-select" aria-label="Default select example">
                    <option selected value="Usuario">Usuario</option>
                    <option value="Administrador">Administrador</option>
                    <option value="Administrador">Especialista</option>
                    <option value="Administrador">Usuario Autorizado</option>
                </select>
                <button class="btn btn-primary" type="submit" id="registrar" name="registrar"
                    value="Enviar">Registrar</button>
                <button class="btn btn-primary" type="submit" id="modificar" name="modificar" value="Modificar"
                    style="display: none;">Modificar</button>
            </div>
        </form>
    </div>
</body>