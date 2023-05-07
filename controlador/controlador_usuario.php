<?php
require_once('../modelo/crud.php');
    
if (isset($_POST['action'])){

    if ($_POST['action'] == 'seleccionar'){
        try {
            $usuario = crud_select('Usuario', 'idUsuario',$_POST['id'] );// consulta con la condición id
            header("Content-Type: application/json");
            echo json_encode($usuario);
            } catch (PDOException $e) {
                echo 'Error al insertar usuario: ' . $e->getMessage();
            }
    }
}
    
?>