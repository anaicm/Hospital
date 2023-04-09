<?php
require_once('../../modelo/crud.php');

$Tipos_Citas=crud_get_all('tipo_cita');//trae la tabla tipo_citas

echo "<table>";
    echo "<tr>
        <th>idTipo_Cita</th>
        <th>Nombre</th>
        <th>Duración</th>
    </tr>";
    foreach ($Tipos_Citas as $Tipo_Cita) {
    echo "<tr>
        <td>" . $Tipo_Cita['idTipo_cita'] . "</td>
        <td>" . $Tipo_Cita['Nombre'] . "</td>
        <td>" . $Tipo_Cita['Duracion'] . "</td>
    </tr>";
    }
    echo "</table>";
?>