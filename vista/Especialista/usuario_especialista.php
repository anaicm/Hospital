<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario de consulta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/uasuario_especialista.css">

</head>

<body>
    <h1>Informe del paciente</h1>
    <hr />
    <div class="cont_iframe">
        <div id='panel-modificar' class='d-flex'>
            <!--Formulario para el informe del paciente-->
            <form method="post" class="">
                <div class="input-group mb-1 d-inline-flex p-1 bd-highlight">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">Nombre: </span>
                    </div>
                    <input required type="text" class="form-control" id="nombre" name="nombre"
                        aria-describedby="basic-addon3">

                    <div class="input-group-prepend">

                        <span class="input-group-text" id="basic-addon3">Apellidos: </span>
                    </div>
                    <input required type="text" class="form-control" id="apellidos" name="apellidos"
                        aria-describedby="basic-addon3">
                </div>
                <hr />
                <div>
                    <textarea class="input-group-text" id="basic-addon3" name="informe">Informe del paciente: 
                    </textarea>
                    <button class="btn btn-primary" type="submit" id="registrar" name="registrar"
                        value="Enviar">Registrar
                        informe</button>
                </div>
            </form>
        </div>
        <!--parte derecha del iframe, el especialista da cita a partir del dni del paciente-->
        <div class="cont_darCita">
            <form action="#" method="post">
                <div class="input-group-prepend">

                    <span class="input-group-text" id="basic-addon3">DNI: </span>
                </div>
                <input required type="tel" pattern="[0-9]{8}[A-Z]{1}" class="form-control" id="dni" name="dni"
                    aria-describedby="basic-addon3">
            </form>
            <button type="button" name="btn_darCita" id="btn_darCita" class="btn btn-primary" data-toggle="modal"
                onclick="location.href = '../pedir_cita.php'" data-target="#exampleModal">
                Dar cita
            </button>
        </div>


</body>

</html>