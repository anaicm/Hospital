/*Función que oculta el div que entra por parámetro y despues lo hace visible*/
/*En el CSS del contenedor que se quiere ocultar "display:none" para hacerlo invisible */
/*En el CSS de la página una clase ".visible{display:block}*/
/*En el div donde se hace click y aparece se llama al evento onclick=funcion("div_invisible")*/

function mostrar_formulario_datos (div){
    var contenedor_formulario_datos=document.getElementById(div);
    contenedor_formulario_datos.classList.toggle("visible");
  }