<?php
require_once('../modelo/crud.php');
    
if (isset($_POST['action'])){
    if ($_POST['action'] == 'borrar'){    
        try {       
            crud_delete('Ciudad',$_POST['id']);
            } catch (PDOException $e) {
                echo 'Error al insertar la ciudad en la provincia: ' . $e->getMessage();
            }
    }

    if ($_POST['action'] == 'seleccionar'){    
        try {       
            $ciudad = crud_select('Ciudad', 'idCiudad',$_POST['id'] );
            header("Content-Type: application/json");
            echo json_encode($ciudad);
            } catch (PDOException $e) {
                echo 'Error al insertar la ciudad en la provincia: ' . $e->getMessage();
            }
    }
}
    
?>