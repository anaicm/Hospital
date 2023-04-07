<?php
require_once('../../modelo/crud.php');

$provincias=crud_getall('provincia');

echo "<table>";
    echo "<tr>
        <th>Id</th>
        <th>Provincia</th>
    </tr>";
    foreach ($provincias as $provincia) {
    echo "<tr>
        <td>" . $provincia['idProvincia'] . "</td>
        <td>" . $provincia['Nombre'] . "</td>
    </tr>";
    }
    echo "</table>";
?>