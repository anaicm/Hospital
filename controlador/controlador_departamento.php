<?php
require_once('../modelo/crud.php');
    
if (isset($_POST['action'])){

    if ($_POST['action'] == 'seleccionar'){    
        try {       
            $departamento = crud_select('Departamento', 'idDepartamento',$_POST['id'] );
            header("Content-Type: application/json");
            echo json_encode($departamento);
            } catch (PDOException $e) {
                echo 'Error al insertar el departamento: ' . $e->getMessage();
            }
    }
}
    
?>