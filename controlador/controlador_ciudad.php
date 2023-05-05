<?php
require_once('../modelo/crud.php');
    
if (isset($_POST['action'])){

    if ($_POST['action'] == 'seleccionar'){    
        try {       
            $ciudad = crud_select('Ciudad', 'idCiudad',$_POST['id'] );
            header("Content-Type: application/json");
            echo json_encode($ciudad);
            } catch (PDOException $e) {
                echo 'Error al insertar la ciudad: ' . $e->getMessage();
            }
    }
}
    
?>