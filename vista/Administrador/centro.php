<?php
require_once('../../modelo/crud.php');

$centros=crud_get_all('centro');//trae la tabla centro

echo "<table>";
    echo "<tr>
        <th>idCentro</th>
        <th>Nombre</th>
        <th>Dirección</th>
        <th>Teléfono</th>
    </tr>";
    foreach ($centros as $centro) {
    echo "<tr>
        <td>" . $centro['idCentro'] . "</td>
        <td>" . $centro['Nombre'] . "</td>
        <td>" . $centro['Direccion'] . "</td>
        <td>" . $centro['Telefono'] . "</td>

    </tr>";
    }
    echo "</table>";
?>