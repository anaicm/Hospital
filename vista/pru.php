<?php
require_once('../modelo/crud.php');
require('../modelo/epecialista_agenda.php');
//if(isset($_POST['fecha']) && isset( $_POST['nom_esp']) && isset( $_POST['nom_esp'])){
        $fecha = '2023-05-31';
        $nombre='Manuel';
        $apellido='Ramírez López';
        //if (isset($_POST['buscar_agendea_esp'])) {
            $especialista=obtener_dni_usuario($nombre,$apellido);//obtengo el dni del especialista mediante su nombre y apellidos
            foreach($especialista as $campos){
              echo $dni=$campos['Dni'];
              echo"<br>";
            //}
            $personal=id_Personal($dni);//con el dni obtengo el campo idPersonal
            foreach($personal as $campo){
               echo $idPersonal=$campo['idPersonal'];
               echo"<br>";
            }
            try{
                //$arreglo_fecha = date('Y-m-d', strtotime($fecha));
                $busqueda=obtener_cita_por_fecha($fecha,$idPersonal);
                echo "<table class='table table-hover'>";
                echo "<thead><tr><th>Paciente</th><th></th><th>Fecha</th></tr></thead>";
                echo "<tbody>";
                foreach ($busqueda as $resultado) {
                    echo ' <tr class="celdas">';
                    echo "<td>" . $resultado['nombre'] ."</td>";
                    echo "<td>" . $resultado['apellido'] ."</td>";
                    echo "<td>" . $resultado['fecha'] ."</td>";
                }
                echo "</tbody>";
                echo "</table>";
                  
            }catch(PDOException $e) {
                echo 'Error en la búsqueda de la ciudad: ' . $e->getMessage();
            } 
        }
   // } 





?>