<!DOCTYPE html>
<html>

<head>
    <title>Mi perfil</title>
    <meta charset="UTF-8">
    <!--Estilos--------------------------------------------------------------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/area_perfil.css">
    <link rel="stylesheet" type="text/css" href="css/cabecera.css">
    <link rel="stylesheet" type="text/css" href="css/formulario_actualizar_anadir_farmiliares.css">
    <link rel="stylesheet" type="text/css" href="css/barra_navegacion.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!--JavaScript------------------------------------------------------------------------------------------------------------>
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/area_perfil.js"></script>
</head>
<?php
require_once('../modelo/crud.php');
session_start();//para poder leer y escribir en las variables de sesión 
if (!isset($_SESSION['usuario'])) {
    header('location: ./login.php');
    exit();
}

if (isset($_POST['actualizar_contra'])) {//
  $contrasenia = $_POST['contra'];
    $contrasenia1 = $_POST['contra1'];
  $contrasenia2 = $_POST['contra2'];
  $id = $_SESSION['idUsuario'];
  if(password_verify($contrasenia, $_SESSION['contraseniaHash'])){    
    if($contrasenia1 == $contrasenia2){
      try {//actualiza los datos por el id de usuario que se ha guardado en el hidden
        $hashNuevo = password_hash($contrasenia1, PASSWORD_DEFAULT);
        crud_actualizar('Usuario', array('contrasenia' => $hashNuevo), "idUsuario = $id");
        $_SESSION['contraseniaHash'] = $hashNuevo;//Actualiza el hash para que la proxima que quiera cambiar la contraseña, el hash se actualiza en el login entonces se queda el de antes
        $msg = "Contraseña cambiada correctamente";   
    } catch (PDOException $e) {
        echo 'Error al insertar usuario: ' . $e->getMessage();
    }
    }
  }else{   
    $msg = "Contraseña incorrecta";    
  }
}

if (isset($_POST['modificar_datos'])) {//
    $id = $_SESSION['idUsuario'];
    $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];    
  $telefono = $_POST['telefono'];
  $fnacimiento = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['fnacimiento'])));
  $email = $_POST['email'];
  $id = $_SESSION['idUsuario'];
  try {//actualiza los datos por el id de usuario que se ha guardado en el hidden
      crud_actualizar('Usuario', array('nombre' => $nombre, 'apellido' => $apellido, 'telefono' => $telefono, 'FechaNacimiento' => $fnacimiento, 'email' => $email), "idUsuario = $id");
      $_SESSION['usuario'] = $nombre;
      $_SESSION['idUsuario'] = $id;
      $_SESSION['apellido'] = $apellido;
      $_SESSION['telefono'] = $telefono;
      $_SESSION['fnacimiento'] = date('d-m-Y', strtotime(str_replace('-', '/', $_POST['fnacimiento'])));
      $_SESSION['email'] = $email;
  } catch (PDOException $e) {
      echo 'Error al insertar usuario: ' . $e->getMessage();
  }
}
?>

<body class="body-fondo">
    <!--Cabecera cuerpo-------------------------------------------------------------------------------------------------------->
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
    <!--Barra de navegación---------------------------------------------------------------------------------------------------->
    <div class="main">
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="centros_hospitalarios.html">Hospitales</a></li>
                <li><a href="especialistas.html">Especialistas</a></li>
                <li><a href="portal_usuario.php">Portal del usuario</a></li>
                <li><a href="area_perfil.php">Mi perfil</a></li>
            </ul>
        </nav>
        <!--Cuerpo página-->
        <!--contenedor izquierdo----------------------------------------------------------------------------------------------------->
        <div class="contenedor-perfil">
            <!--caja para mostrar los datos registrados-->
            <div class="contenedor-datos">
                <table>
                    <div class="contenedor-perfil">
                        <div class="etiqueta-datos"><b>FOTO: </b></div>
                        <!--traer con php los datos del usuario-->
                        <div class="contenedor-imagen">
                            <img src="imagenes/imagenes_portal_de_usuario/aniadir_foto_perfil_editada.png"
                                class="etiqueta-datos-foto">
                        </div>
                        <div class="contenedor-cambiar-imagen">
                            <div class="logo-modificar"><img
                                    src="imagenes/imagenes_portal_de_usuario/logo_cambiar_imagen.png"
                                    class="etiqueta-datos-foto"></div>
                            <div class="etiqueta-datos"><b>Cambiar foto </b></div>
                        </div>
                    </div>
                    <hr>
                    <tr>
                        <td>
                            <div class="etiqueta-datos"><b>NOMBRE: </b><span class="datos"><i>
                                        <?php echo $_SESSION['usuario']?></i></span></div>
                            <!------------------------------------------------------------------->
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="etiqueta-datos"><b>APELLIDOS: </b><span class="datos"><i>
                                        <?php echo $_SESSION['apellido']?></i></span></div>
                            <!------------------------------------------------------------------->
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="etiqueta-datos"><b>FECHA DE NACIMIENTO: </b><span class="datos"><i>
                                        <?php echo $_SESSION['fnacimiento']?></i></span></div>
                            <!------------------------------------------------------------------------>
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="etiqueta-datos"><b>TELÉFONO: </b><span class="datos"><i>
                                        <?php echo $_SESSION['telefono']?></i></span></div>
                            <!-------------------------------------------------------------------------->
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="etiqueta-datos"><b>EMAIL: </b><span class="datos"><i>
                                        <?php echo $_SESSION['email']?></i></span></div>
                            <!-------------------------------------------------------------------------->
                            <hr>
                        </td>
                    </tr>
                    <td>
                        <div class="etiqueta-datos"><b>DNI: </b><span class="datos"><i>
                                    <?php echo $_SESSION['dni']?></i></span></div>
                        <!----------------------------------------------------------------------------->
                        <hr>
                    </td>
                    </tr>
                </table>
            </div>
            <!--contenedor derecho----------------------------------------------------------------------------------------------->
            <div class="contenedor-datos-modificar">
                <div class="contenedor-cambiar-imagen">
                    <!--menú modificar datos--------------------------------->
                    <div class="contenedor-cambiar-imagen">
                        <!--error de las validaciones de servidor-->
                        <?php if (!empty($msg)): ?>
                        <p><?php 
              echo '<div class="alert alert-danger" role="alert">
              ' . $msg .'
              </div>';
              ?></p>
                        <?php endif; ?>
                        <div id="datos" class="menu etiqueta-datos" onclick="mostrar_formulario_datos('form_datos')">
                            Restablecer datos
                            <hr>
                        </div>
                        <!--formulario modificar datos-->
                        <div id="form_datos" class="submenu">
                            <form action="#" method="post" name="form-actualizar-datos">
                                <table>
                                    <tr>
                                        <td>
                                            <input type="text" name="nombre" id="nombre" placeholder="Nombre"
                                                value="<?php echo $_SESSION['usuario']?>" required>
                                            <hr>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" name="apellido" id="apellido" placeholder="Apellidos"
                                                value="<?php echo $_SESSION['apellido']?>" required>
                                            <hr>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" name="telefono" id="telefono"
                                                placeholder="Teléfono de contacto"
                                                value="<?php echo $_SESSION['telefono']?>" required>
                                            <hr>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" name="fnacimiento" id="fnacimiento"
                                                placeholder="Fecha de nacimiento"
                                                value="<?php echo $_SESSION['fnacimiento']?>" required>
                                            <hr>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input disabled type="text" name="dni" id="dni"
                                                placeholder="Documento nacional (DNI)"
                                                value="<?php echo $_SESSION['dni']?>" required>
                                            <hr>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" name="email" id="email" placeholder="Email"
                                                value="<?php echo $_SESSION['email']?>" required>
                                            <hr>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="boton">
                                                <input type="submit" name="modificar_datos" id="modificar_datos"
                                                    value="Enviar" class="boton-actualizar">
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                    <!--menú modificar contraseña------------------------------>
                    <div class="contenedor-perfil">
                        <div id="contra" class="menu etiqueta-datos" onclick="mostrar_formulario_datos('form_contra')">
                            Restablecer contraseña
                            <hr>
                        </div>
                        <!--formulario modificar contraseña-->
                        <div id="form_contra" class="submenu">
                            <form action="#" method="post" name="form-cambiar-contra">
                                <table>
                                    <tr>
                                        <td>
                                            <input type="text" name="contra" id="contra" placeholder="Contraseña actual"
                                                required>
                                            <hr>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" name="contra1" id="contra1"
                                                placeholder="Nueva contraseña" required>
                                            <hr>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" name="contra2" id="contra2"
                                                placeholder="Verificar nueva contraseña" required>
                                            <hr>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="boton">
                                                <input type="submit" name="actualizar_contra" id="actualizar_contra"
                                                    value="Enviar" class="boton-actualizar">
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>