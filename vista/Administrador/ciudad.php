<?php
require_once('../../modelo/crud.php');

$ciudades=crud_get_all('ciudad');//trae la tabla ciudad

echo "<table>";
    echo "<tr>
        <th>idCiudad</th>
        <th>Nombre</th>
    </tr>";
    foreach ($ciudades as $ciudad) {
    echo "<tr>
        <td>" . $ciudad['idCiudad'] . "</td>
        <td>" . $ciudad['Nombre'] . "</td>
    </tr>";
    }
    echo "</table>";
?>