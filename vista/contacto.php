<!--@author Ana Isabel Cuéllar Maestro
 *  @since @since 22/04/2023
 *  
-->
<!DOCTYPE html>
<html>

<head>
    <title>Contacto</title>
    <meta charset="UTF-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="css/acerca_de.css" />
    <link rel="stylesheet" type="text/css" href="css/cabecera.css" />
    <link rel="stylesheet" type="text/css" href="css/barra_navegacion.css" />
</head>

<!--Cabecera página--------------------------------------------------------------------------------------------------------------->

<body class="body-fondo">
    <header class="main-header">
        <div class="logo-container">
            <a href="index.php"><img src="logos/logo_hospital4.png" /></a>
        </div>
        <div class="title-container">
            <h1>CenSalud</h1>
        </div>
        <div class="button-container">
            <a href="index.php" class="c-button user-button"><img src="logos/logo_volver-1.png"
                    class="logo-volver" /></a>
        </div>
    </header>
    <div class="main">
        <!--Barra de navegación------------------------------------------------------------------------------------------------------------>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="centros_hospitalarios.html">Hospitales</a></li>
                <li><a href="acerca_de.html">Acerca de</a></li>
                <li><a href="especialistas.html">Especialistas</a></li>
                <li><a href="contacto.php">Contacto</a></li>
            </ul>
        </nav>
        <!--Cuerpo------------------------------------------------------------------------------------------------------------------------->
        <div class="card mb-3 tam_contenedor_contacto">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="imagenes/imagenes-centros/contacto.png" class="img-fluid rounded-start imagen"
                        alt="contacto" />
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title titulo">Seleccione Ciudad</h5>
                        <hr />
                        <p class="card-text contacto">
                            Contacto: +900-100-200 | CenSalud@gmail.com
                        </p>
                        <form action="" method="post">
                            <input required type="text" class="form-control" id="nom_ciudad" name="nom_ciudad"
                                aria-describedby="basic-addon3" placeholder="Ciudad" />
                            <button class="btn btn-primary" style="margin-top:10px" type="submit" id="buscar"
                                name="buscar" value="Enviar">Buscar</button>
                            <!--Tabla para mostrar los datos -->
                            <?php
                              require_once('../modelo/modelo_contacto.php');
                              if (isset($_POST['buscar'])) {
                                $ciudad = $_POST['nom_ciudad'];
                                try{
                                  $busqueda=obtener_centros_por_ciudad($ciudad);
                                }catch(PDOException $e) {
                                  echo 'Error en la búsqueda de la ciudad: ' . $e->getMessage();
                              }
                              echo "<table class='table table-hover'>";
                              foreach($busqueda as $resultado){
                                echo '<tr>
                                        <td scope="row">' . $resultado['Direccion'] . '</td>
                                        <td scope="row">'. $resultado['Telefono'] .  '</td>
                                      </tr>';
                              }
                              echo "</table>";
                              }
                              ?>
                        </form>
                        <!--Bucle, según la ciudad que entre por el input, muestra los centros con las direcciones y teléfonos-->

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>