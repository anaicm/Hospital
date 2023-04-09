<?php
require_once('../../modelo/crud.php');

$citas=crud_get_all('cita');//trae la tabla cita

echo "<table>";
    echo "<tr>
        <th>idCita</th>
        <th>Hora</th>
    </tr>";
    foreach ($citas as $cita) {
    echo "<tr>
        <td>" . $cita['idTipo_cita'] . "</td>
        <td>" . $cita['Hora'] . "</td>
    </tr>";
    }
    echo "</table>";
?>