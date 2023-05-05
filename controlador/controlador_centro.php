<?php
require_once('../modelo/crud.php');
    
if (isset($_POST['action'])){

    if ($_POST['action'] == 'seleccionar'){    
        try {       
            $centro = crud_select('Centro', 'idCentro',$_POST['id'] );
            header("Content-Type: application/json");
            echo json_encode($centro);
            } catch (PDOException $e) {
                echo 'Error al insertar el centro: ' . $e->getMessage();
            }
    }
}
    
?>