<!DOCTYPE html>
<html>
<?php
require_once('../modelo/crud.php');
?>

<head>
    <title>Mis citas</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/pedir_cita.css">
    <link rel="stylesheet" type="text/css" href="css/cabecera.css">
    <link rel="stylesheet" type="text/css" href="css/barra_navegacion.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Agrega los scripts de Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {

        steps = document.querySelectorAll('.step');
    });
    let currentStep = 0;
    let steps;

    function nextStep() {
        // Validar campos del formulario antes de avanzar al siguiente paso
        if (currentStep === 0 && !document.getElementById('fecha').checkValidity()) {
            alert('Por favor, seleccione una fecha válida');
            return;
        }
        if (currentStep === 1 && !document.getElementById('especialidad').checkValidity()) {
            alert('Por favor, seleccione una especialidad');
            return;
        }
        if (currentStep === 2 && (!document.getElementById('localidad').checkValidity() || !document
                .getElementById(
                    'centro').checkValidity())) {
            alert('Por favor, seleccione una localidad y un centro');
            return;
        }

        steps[currentStep].classList.remove('active');
        currentStep++;
        steps[currentStep].classList.add('active');

        updateSummary();
    }

    function prevStep() {
        steps[currentStep].classList.remove('active');
        currentStep--;
        steps[currentStep].classList.add('active');

        updateSummary();
    }

    function setToday() {
        const today = new Date().toISOString().substr(0, 10);
        document.getElementById('fecha').value = today;
    }

    function updateCentros() {
        const localidad = document.getElementById('localidad').value;
        let centroSelect = document.getElementById('centro');

        // Limpiar opciones antiguas
        while (centroSelect.firstChild) {
            centroSelect.removeChild(centroSelect.firstChild);
        }

        // Añadir nuevas opciones
        let centros = [];
        switch (localidad) {
            case 'Madrid':
                centros = ['Hospital Universitario La Paz', 'Hospital Universitario Gregorio Marañón',
                    'Hospital Universitario Ramón y Cajal'
                ];
                break;
            case 'Barcelona':
                centros = ['Hospital Clínic de Barcelona', 'Hospital Universitario Vall d\'Hebron',
                    'Hospital de la Santa Creu i Sant Pau'
                ];
                break;
            case 'Valencia':
                centros = ['Hospital General Universitario de Valencia',
                    'Hospital Clínico Universitario de Valencia',
                    'Hospital Universitari i Politècnic La Fe'
                ];
                break;
            case 'Sevilla':
                centros = ['Hospital Universitario Virgen del Rocío',
                    'Hospital Universitario Virgen Macarena',
                    'Hospital Universitario Virgen de Valme'
                ];
                break;
            default:
                break;
        }

        for (let i = 0; i < centros.length; i++) {
            let option = document.createElement('option');
            option.value = centros[i];
            option.innerHTML = centros[i];
            centroSelect.appendChild(option);
        }

        updateSummary();
    }

    function updateSummary() {
        document.getElementById('resumen-fecha').innerHTML = document.getElementById('fecha').value;
        document.getElementById('resumen-especialidad').innerHTML = $("#especialidad option:selected").text();
        document.getElementById('resumen-localidad').innerHTML = $("#localidad option:selected").text();
        document.getElementById('resumen-centro').innerHTML = $("#centro option:selected").text();
        document.getElementById('idCentro').value = $("#centro option:selected").val();
        document.getElementById('idDepartamento').value = $("#especialidad option:selected").val();
        document.getElementById('fechaseleccionada').value = document.getElementById('fecha').value;
    }
    </script>
    <style>
    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 50%;
        width: 60%;
        margin: auto;
        margin-top: 5%;
        padding: 30px;
        border: 2px solid #1F736A;
        border-radius: 10px;
    }

    .step {
        display: none;
    }

    .step.active {
        display: block;
    }
    </style>
</head>

<?php
if (isset($_POST['buscar_cita'])) {//
  $idCentro = $_POST['idCentro'];
  $idDepartamento = $_POST['idDepartamento'];
  $fecha = $_POST['fechaseleccionada'];

  $departamento_personales=crud_get_all('Departamento_Personal');//trae la tabla centro_departamento
    foreach ($departamento_personales as $departamento_personal) {
        if($departamento_personal["idDepartamento"] == $idDepartamento){   
            try {
            crud_borrar('cita', array('hora' => $fecha, 'idPersonal' => $idPersonal, 'idUsuario' => $_SESSION['idUsuario'], 'idTipoCita' => $idTipoCita));
            } catch (PDOException $e) {
                echo 'Error al insertar la cita: ' . $e->getMessage();
            }
        }
    }
    

  $personalDepartamento = 
  $personal = crud_select('Personal', 'idPersonal',$_POST['id'] );

  
}
?>

<body class="body-fondo">
    <header class="main-header">
        <div class="logo-container">
            <a href="index.php"><img src="logos/logo_hospital4.png"></a>
        </div>
        <div class="title-container">
            <h1>CenSalud</h1>
        </div>
        <div class="button-container">
            <a href="portal_usuario.php" class="c-button user-button"><img src="logos/logo_volver-1.png"
                    class="logo-volver"></a>
        </div>
    </header>
    <div class="main">
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="centros_hospitalarios.html">Hospitales</a></li>
                <li><a href="especialistas.html">Especialistas</a></li>
                <li><a href="portal_usuario.php">Portal del usuario</a></li>
                <li><a href="pedir_cita.php">Pedir Cita</a></li>
            </ul>
        </nav>
        <!-- Botón que abre el Modal -->
        <div class="container">
            <h3 class="text-center mb-4">Seleccione los datos para elegir su cita:</h3>

            <div class="step active" id="step-1">
                <label for="fecha" class="form-label">Paso 1: Selecciona una fecha</label>
                <form action="pedir_cita_p2.php" method="post" name="mostrar-datos-usuario">
                    <div class="input-group mb-3">
                        <input type="datetime-local" class="form-control" id="fecha" name="fecha"
                            aria-describedby="fecha-ayuda">
                        <button type="submit" class="btn btn-primary">Lo antes
                            posible</button>

                    </div>
                    <small id="fecha-ayuda" class="form-text text-muted">Selecciona una fecha disponible.</small>
                    <button type="submit" id="siguientep1" name="siguientep1" value="siguientep1"
                        class="btn btn-primary">Siguiente</button>
                </form>
            </div>
        </div>
</body>
<!--cuerpo-->