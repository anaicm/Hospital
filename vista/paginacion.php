<?php

function paginacion($paginasTotales, $pagina, $url){
    $inicio = max(1, $pagina - 2);
    $fin = min($paginasTotales, $pagina + 2);
    $html = "<ul class='pagination'>";
    if ($pagina > 1) {
        $html .= "<li class='page-item'><a class='page-link' href='$url&page=".($pagina-1)."'>Anterior</a></li>";
    }
    if ($inicio > 1) {
        $html .= "<li class='page-item'><a class='page-link' href='$url&page=1'>1</a></li>";
        if ($inicio > 2) {
            $html .= "<li class='page-item disabled'><a class='page-link'>...</a></li>";
        }
    }
    for ($i=$inicio; $i<=$fin; $i++) {
        $activo = ($pagina == $i) ? " active" : "";
        $html .= "<li class='page-item $activo'><a class='page-link' href='$url&page=$i'>$i</a></li>";
    }
    if ($fin < $paginasTotales) {
        if ($fin < $paginasTotales - 1) {
            $html .= "<li class='page-item disabled'><a class='page-link'>...</a></li>";
        }
        $html .= "<li class='page-item'><a class='page-link' href='$url&page=$paginasTotales'>$paginasTotales</a></li>";
    }
    if ($pagina < $paginasTotales) {
        $html .= "<li class='page-item'><a class='page-link' href='$url&page=".($pagina+1)."'>Siguiente</a></li>";
    }
    $html .= "</ul>";
    return $html;
}