<!DOCTYPE html>
<html>

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
    }

    function submitForm() {
        alert('Buscando huecos para su cita...');
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
        border: 1px solid #ccc;
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
<!-- Script para la navegación de pasos -->


<body class="body-fondo">
    <header class="main-header">
        <div class="logo-container">
            <a href="index.html"><img src="logos/logo_hospital4.png"></a>
        </div>
        <div class="title-container">
            <h1>CenSalud</h1>
        </div>
        <div class="button-container">
            <a href="portal_usuario.html" class="c-button user-button"><img src="logos/logo_volver-1.png"
                    class="logo-volver"></a>
        </div>
    </header>
    <div class="main">
        <nav>
            <ul>
                <li><a href="index.html">Inicio</a></li>
                <li><a href="centros_hospitalarios.html">Hospitales</a></li>
                <li><a href="especialistas.html">Especialistas</a></li>
                <li><a href="portal_usuario.html">Portal del usuario</a></li>
                <li><a href="pedir_cita.html">Pedir Cita</a></li>
            </ul>
        </nav>
        <!-- Botón que abre el Modal -->
        <div class="container">
            <h3 class="text-center mb-4">Seleccione los datos para elegir su cita:</h3>

            <div class="step active" id="step-1">
                <label for="fecha" class="form-label">Paso 1: Selecciona una fecha</label>
                <div class="input-group mb-3">
                    <input type="date" class="form-control" id="fecha" aria-describedby="fecha-ayuda" required>
                    <button type="button" class="btn btn-primary" onclick="setToday(); nextStep()">Lo antes
                        posible</button>

                </div>
                <small id="fecha-ayuda" class="form-text text-muted">Selecciona una fecha disponible.</small>
                <button class="btn btn-primary mt-3" onclick="nextStep()">Siguiente</button>
            </div>

            <div class="step" id="step-2">
                <label for="especialidad" class="form-label">Paso 2: Selecciona una especialidad hospitalaria</label>
                <select class="form-select mb-3" id="especialidad" required>
                    <option value="">Selecciona una especialidad...</option>
                    <option value="1">Cardiología</option>
                    <option value="2">Dermatología</option>
                    <option value="3">Endocrinología</option>
                    <option value="4">Ginecología</option>
                    <option value="5">Oncología</option>
                    <option value="6">Pediatría</option>
                    <option value="7">Psiquiatría</option>
                </select>
                <button class="btn btn-secondary" onclick="prevStep()">Anterior</button>
                <button class="btn btn-primary ms-3" onclick="nextStep()">Siguiente</button>
            </div>

            <div class="step" id="step-3">
                <label for="localidad" class="form-label">Paso 3: Selecciona una localidad y centro</label>
                <div class="row">
                    <div class="col-md-6">
                        <select class="form-select mb-3" id="localidad" required>
                            <option value="">Selecciona una localidad...</option>
                            <option value="1">Madrid</option>
                            <option value="2">Barcelona</option>
                            <option value="3">Valencia</option>
                            <option value="4">Sevilla</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select class="form-select mb-3" id="centro" required>
                            <option value="">Selecciona un centro...</option>
                            <option value="1">Hospital Universitario La Paz</option>
                            <option value="2">Hospital Clínic de Barcelona</option>
                            <option value="3">Hospital Universitario y Politécnico La Fe</option>
                            <option value="4">Hospital Universitario Virgen del Rocío</option>
                        </select>
                    </div>
                </div>
                <button class="btn btn-secondary" onclick="prevStep()">Anterior</button>
                <button class="btn btn-primary ms-3" onclick="nextStep()">Siguiente</button>
            </div>

            <div class="step" id="step-4">
                <h4 class="mb-3">Buscar cita</h4>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Fecha:</strong> <span id="resumen-fecha"></span></p>
                        <p><strong>Especialidad:</strong> <span id="resumen-especialidad"></span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Localidad:</strong> <span id="resumen-localidad"></span></p>
                        <p><strong>Centro:</strong> <span id="resumen-centro"></span></p>
                    </div>
                </div>
                <button class="btn btn-secondary" onclick="prevStep()">Anterior</button>
                <button class="btn btn-primary ms-3" onclick="submitForm()">Buscar cita</button>
            </div>
        </div>
</body>
<!--cuerpo-->