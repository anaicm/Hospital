<?php
require_once('../modelo/crud.php');
    
if (isset($_POST['action'])){

    if ($_POST['action'] == 'seleccionar'){    
        try {       
            $personal = crud_select('Personal', 'idPersonal',$_POST['id'] );
            header("Content-Type: application/json");
            echo json_encode($personal);
            } catch (PDOException $e) {
                echo 'Error al obtener el personal: ' . $e->getMessage();
            }
    }
}
    
?>