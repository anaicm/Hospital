<?php
require_once('../../modelo/crud.php');

$personas=crud_get_all('personal');//trae la tabla personal

echo "<table>";
    echo "<tr>
        <th>idPersonal</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Teléfono</th>
    </tr>";
    foreach ($personas as $persona) {
    echo "<tr>
        <td>" . $persona['idPersonal'] . "</td>
        <td>" . $persona['Nombre'] . "</td>
        <td>" . $persona['Apellido'] . "</td>
        <td>" . $persona['Telefono'] . "</td>
    </tr>";
    }
    echo "</table>";
?>