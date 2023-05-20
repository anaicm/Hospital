include("../../controlador/controlador_usuario.php");

/*
    @function para buscar por id, mediante una llamada asíncrona con Ajax al servidor
    *
    */

function seleccionar(id) {

  var http = new XMLHttpRequest();
  var url = "/Hospital/controlador/controlador_usuario.php";
  var params = "action=seleccionar&id=" + id;
  http.open("POST", url, true);

  //
  http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  // maneja la respues del servidor
  http.onreadystatechange = function () {
    //respuesta ajax correcta
    if (http.readyState == 4 && http.status == 200) {
      var usuario = JSON.parse(http.response);
      document.getElementById("nombre").value = usuario[0].Nombre; //datos mapeados
      document.getElementById("apellidos").value = usuario[0].Apellido;
      document.getElementById("dni").value = usuario[0].Dni;
      document.getElementById("dni").disabled = true;
      document.getElementById("Telefono").value = usuario[0].Telefono;
      document.getElementById("FechaNacimiento").value =
        usuario[0].FechaNacimiento;
      document.getElementById("email").value = usuario[0].Email;
      document.getElementById("rol").value = usuario[0].Rol;
      document.getElementById("registrar").style.display = "none"; //cambia la visibilidad de los botones
      document.getElementById("modificar").style.display = "block";
      document.getElementById("idUsuario").value = id; //deja el id oculto para luego uasarlo en modificar
      document.getElementById("Anadir").style.display = "block";
    }
  };
  http.send(params);
}
/**
 * @Function limpiarFormulario() limpia los campos del formulario
 *
 */
function limpiarFormulario() {
  document.getElementById("nombre").value = "";
  document.getElementById("apellidos").value = "";
  document.getElementById("dni").value = "";
  document.getElementById("dni").enabled = false;
  document.getElementById("Telefono").value = "";
  document.getElementById("FechaNacimiento").value = "";
  document.getElementById("email").value = "";
  document.getElementById("rol").value = "Usuario";
  document.getElementById("dni").disabled = false;
  document.getElementById("registrar").style.display = "block";
  document.getElementById("modificar").style.display = "none";
  document.getElementById("Anadir").style.display = "none";
}
