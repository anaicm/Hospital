<?php
function paginacion($paginasTotales, $pagina, $url){
    $inicio = max(1, $pagina - 2);
    $fin = min($paginasTotales, $pagina + 2);
    $html = "<ul class='pagination'>";
     //verifica si la página actual no es la primera página y, si es así, agrega un botón "Anterior" que enlaza con la página anterior.
    if ($pagina > 1) {
        $html .= "<li class='page-item'><a class='page-link' href='$url&page=".($pagina-1)."'>Anterior</a></li>";
    }
   //si es mayor, agrega un botón para la página de inicio.
    if ($inicio > 1) {
        $html .= "<li class='page-item'><a class='page-link' href='$url&page=1'>1</a></li>";
        //si es mayor que dos agrega un botón para las páginas anteriores que están disponibles.
        if ($inicio > 2) {
            $html .= "<li class='page-item disabled'><a class='page-link'>...</a></li>";
        }
    }
    //recorre todas las páginas para agregar un botón y agrega la clase "active" para indicar en la página que está
    for ($i=$inicio; $i<=$fin; $i++) {
        $activo = ($pagina == $i) ? " active" : "";
        $html .= "<li class='page-item $activo'><a class='page-link' href='$url&page=$i'>$i</a></li>";
    }
    //es a la contra del inicio, si es menor que páginas totales agrega un botón para la última página.
    if ($fin < $paginasTotales) {
        //si es menor que páginas totales-1 un botón para las páginas siguientes que están disponibles.
        if ($fin < $paginasTotales - 1) {
            $html .= "<li class='page-item disabled'><a class='page-link'>...</a></li>";
        }
        $html .= "<li class='page-item'><a class='page-link' href='$url&page=$paginasTotales'>$paginasTotales</a></li>";
    }
    //verifica si la página actual no es la última página y, si es así, agrega un botón "Siguiente" que enlaza con la página siguiente.
    if ($pagina < $paginasTotales) {
        $html .= "<li class='page-item'><a class='page-link' href='$url&page=".($pagina+1)."'>Siguiente</a></li>";
    }
    $html .= "</ul>";
    //devuelve el HTML
    return $html;
}