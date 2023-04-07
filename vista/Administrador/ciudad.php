<?php
require_once('../../modelo/crud.php');

$ciudades=crud_getall('ciudad');

echo "<table>";
    echo "<tr>
        <th>Centro</th>
        <th>Centro</th>
    </tr>";
    foreach ($ciudades as $ciudad) {
    echo "<tr>
        <td>" . $ciudad['idProvincia'] . "</td>
        <td>" . $ciudad['Nombre'] . "</td>
    </tr>";
    }
    echo "</table>";
?>