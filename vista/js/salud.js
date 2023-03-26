$(document).ready(function(){
    var tarjetas=document.querySelectorAll("#tarjeta1","#tarjeta2","#tarjeta3");//almacena los elementos de la lista identificando los selectores
    //recorrer los elementos y ponerlos a la escucha
    for(var i=0; i<tarjetas.length;i++){
        tarjetas[i].addEventListener("mouseover", poner_texto(),false);// a la escucha del evento mouseover
        tarjetas[i].addEventListener("mouseout", quitar_texto(),false);// a la escucha del evento mouseout

    }




function poner_texto(e){//parametro para detectar quien ha sido el objeto desencadenante del evento
    if(e.target==tarjeta1){
        $("#elemento1").addClass("fondo-bienestar");//al pasar por el elemento tarjeta 1 pone el fondo del elemento bienestar
        $("#elemento1").attr("src","ruta");// muestra la imagen de la ruta
    }else if(e.target==tarjeta2){
        $("#elemento2").addClass("fondo-prevencion");//al pasar por el elemento tarjeta 2 pone el fondo del elemento bienestar
        $("#elemento2").attr("src","ruta");
    }else if(e.target==tarjeta3){
        $("#elemento3").addClass("fondo-investigar");//al pasar por el elemento tarjeta 3 pone el fondo del elemento bienestar
        $("#elemento3").attr("src","ruta");
    }
}
function quitar_texto(e){
    if(e.target==tarjeta1){
        $("#elemento1").removeClass("fondo-bienestar");//al pasar por el elemento tarjeta 1 quita el fondo del elemento bienestar
        $("#elemento1").removeattr("src");// quita el atributo
    }else if(e.target==tarjeta2){
        $("#elemento2").removeClass("fondo-prevencion");//al pasar por el elemento tarjeta 2 quita el fondo del elemento bienestar
        $("#elemento2").removeattr("src");
    }else if(e.target==tarjeta3){
        $("#elemento3").removeClass("fondo-investigar");//al pasar por el elemento tarjeta 3 quita el fondo del elemento bienestar
        $("#elemento3").removeattr("src"
        );
    }

}
});
