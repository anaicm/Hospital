<?php
require_once('../modelo/crud.php');
    
if (isset($_POST['action'])){

    if ($_POST['action'] == 'seleccionar'){    
        try {       
            $provincia = crud_select('Provincia', 'idProvincia',$_POST['id'] );
            header("Content-Type: application/json");
            echo json_encode($provincia);
            } catch (PDOException $e) {
                echo 'Error al insertar la provincia: ' . $e->getMessage();
            }
    }
}
    
?>