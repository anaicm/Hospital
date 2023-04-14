<!--CRUD tabla usuario-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Administración BD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script>
    /*
    @function para eliminar por id
    *
    */
    function borrar(id) {
        var dialog = confirm("Estas seguro?"); //muestra una caja para confirmar o cancelar
        if (dialog) {
            var http = new XMLHttpRequest();
            var url = '/Hospital/controlador/controlador_usuario.php';
            var params = 'action=borrar&id=' + id;
            http.open('POST', url, true);

            //envía la información de encabezado junto con la solicitud
            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            http.onreadystatechange = function() { //llama a la función cuando cambia de estado
                if (http.readyState == 4 && http.status == 200) {
                    location.reload();
                }
            }
            http.send(params);

        }
    }
    /*
    @function para buscar por id
    *
    */

    function seleccionar(id) {
        var http = new XMLHttpRequest();
        var url = '/Hospital/controlador/controlador_usuario.php';
        var params = 'action=seleccionar&id=' + id;
        http.open('POST', url, true);

        //Send the proper header information along with the request
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        http.onreadystatechange = function() {
            if (http.readyState == 4 && http.status == 200) {
                var usuario = JSON.parse(http.response);
                document.getElementById('nombre').value = usuario[0].Nombre;
                document.getElementById('apellidos').value = usuario[0].Apellido;
                document.getElementById('dni').value = usuario[0].Dni;
                document.getElementById('Telefono').value = usuario[0].Telefono;
                document.getElementById('FechaNacimiento').value = usuario[0].FechaNacimiento;
                document.getElementById('email').value = usuario[0].Email;
                document.getElementById('rol').value = usuario[0].Rol;
            }
        }
        http.send(params);
    }
    </script>
</head>

<body>
    <?php
require_once('../../modelo/crud.php');

if (isset($_POST['registrar'])) {
    $nombre = $_POST['nombre'];
	$apellido = $_POST['apellidos'];
    $dni = $_POST['dni'];
	$telefono = $_POST['Telefono'];
	$fnacimiento = date('d-m-Y', strtotime(str_replace('-', '/', $_POST['FechaNacimiento'])));
	$email = $_POST['email'];
	$contrasenia = $_POST['password'];

    try {
    crud_insert('Usuario', array('nombre' => $nombre, 'apellido' => $apellido, 'telefono' => $telefono, 'FechaNacimiento' => $fnacimiento,'contrasenia' => $contrasenia, 'email' => $email, 'rol' => 'Administrador'));
    header("Refresh:0");
    } catch (PDOException $e) {
        echo 'Error al insertar usuario: ' . $e->getMessage();
    }
}
//mostrar la tabla usuarios
$usuarios=crud_get_all('usuario');//trae la tabla usuario

echo "<table class=\"table table-hover\">";
    echo "<tr>
        <th scope=\"col\">idUsuario</th>
        <th scope=\"col\">Nombre</th>
        <th scope=\"col\">Apellidos</th>
        <th scope=\"col\">Teléfono</th>
        <th scope=\"col\">Email</th>
        <th scope=\"col\">Rol</th>
        <th scope=\"col\">Fecha_Nacimiento</th>
        <th scope=\"col\"></th>
        <th scope=\"col\"></th>
    </tr>";
    //falta el campo del DNI
    foreach ($usuarios as $usuario) {
    echo "<tr onclick=\"seleccionar('" . $usuario['idUsuario'] . "');\" >
        <td scope='row'>" . $usuario['idUsuario'] . "</td>
        <td>" . $usuario['Nombre'] . "</td>
        <td>" . $usuario['Apellido'] . "</td>
        <td>" . $usuario['Telefono'] . "</td>
        <td>" . $usuario['Email'] . "</td>
        <td>" . $usuario['Rol'] . "</td>
        <td>" . $usuario['FechaNacimiento'] . "</td>
        <td>" . "<button class=\"btn btn-primary\" onclick=\"borrar(". $usuario['idUsuario'] .");\" id=\"borrar\" name=\"borrar\" value=\"Borrar\">Borrar</button>" . "</td>
    </tr>";
    }
    echo "</table>";
    //mostrar la tabla usuarios   

    
?>

    <!--formulario de usuarios-->
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>

    <div class='d-flex'>
        <form method="post" class="">
            <div class="input-group mb-1 d-inline-flex p-1 bd-highlight">
                <!--clase de bootstrap-->
                <div class="input-group-prepend">

                    <span class="input-group-text" id="basic-addon3">Nombre: </span>
                </div>
                <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="basic-addon3"
                    require>

                <div class="input-group-prepend">

                    <span class="input-group-text" id="basic-addon3">Apellidos: </span>
                </div>
                <input type="text" class="form-control" id="apellidos" name="apellidos"
                    aria-describedby="basic-addon3"><br>
            </div>
            <div class="input-group mb-1 d-inline-flex p-1 bd-highlight">
                <div class="input-group-prepend">

                    <span class="input-group-text" id="basic-addon3">DNI: </span>
                </div>
                <input type="text" class="form-control" id="dni" name="dni" aria-describedby="basic-addon3">

                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Fecha de nacimiento: </span>
                </div>
                <input type="date" class="form-control" id="FechaNacimiento" name="FechaNacimiento"
                    aria-describedby="basic-addon3">
            </div>
            <div class="input-group mb-1 d-inline-flex p-1 bd-highlight">
                <div class="input-group-prepend">

                    <span class="input-group-text" id="basic-addon3">Teléfono: </span>
                </div>
                <input type="text" class="form-control" id="Telefono" name="Telefono" aria-describedby="basic-addon3">

                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Email: </span>
                </div>
                <input type="text" class="form-control" id="email" name="email" aria-describedby="basic-addon3">
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
                <input type="text" class="form-control" id="rol" name="rol" aria-describedby="basic-addon3">
                <button class="btn btn-primary" type="submit" id="registrar" name="registrar"
                    value="Enviar">Enviar</button>
            </div>
        </form>
    </div>
</body>