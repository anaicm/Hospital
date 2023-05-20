/*Función que oculta el div que entra por parámetro y despues lo hace visible*/
/*En el CSS del contenedor que se quiere ocultar "display:none" para hacerlo invisible */
/*En el CSS de la página una clase ".visible{display:block}*/
/*En el div donde se hace click y aparece se llama al evento onclick=funcion("div_invisible")*/
//funcion para la página portal Usuario autorizado
function mostrar_datos (div){

  var continformación_paciente = document.getElementById('información_paciente');
  if (!continformación_paciente.classList.contains('oculta')) {
    continformación_paciente.classList.toggle('oculta');
  }
  var contEspecialistas_centros = document.getElementById('Especialistas_centros');
  if (!contEspecialistas_centros.classList.contains('oculta')) {
    contEspecialistas_centros.classList.toggle('oculta');
  }
  var contagenda_especialista = document.getElementById('agenda_especialista');
  if (!contagenda_especialista.classList.contains('oculta')) {
    contagenda_especialista.classList.toggle('oculta');
  }
  var continformacion_centros = document.getElementById('informacion_centros');
  if (!continformacion_centros.classList.contains('oculta')) {
    continformacion_centros.classList.toggle('oculta');
  }

  var contenedor_formulario_datos=document.getElementById(div);
    contenedor_formulario_datos.classList.toggle("oculta");
  }
  // función para la página área de perfil
  function mostrar_datos2 (div){
   
    var contenedor_formulario_datos=document.getElementById(div);
    contenedor_formulario_datos.classList.toggle("visible");
    }

   

