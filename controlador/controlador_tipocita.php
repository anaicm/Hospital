<?php
require_once('../modelo/crud.php');
    
if (isset($_POST['action'])){

    if ($_POST['action'] == 'seleccionar'){    
        try {       
            $tipo_cita = crud_select('TipoCita', 'idTipoCita',$_POST['id'] );
            header("Content-Type: application/json");
            echo json_encode($tipo_cita);
            } catch (PDOException $e) {
                echo 'Error al insertar el tipo de cita: ' . $e->getMessage();
            }
    }
}
    
?>