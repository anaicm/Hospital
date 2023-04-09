<?php
require_once('../../modelo/crud.php');

$departamentos=crud_get_all('departamento');//trae la tabla departamentos

echo "<table>";
    echo "<tr>
        <th>idDepartamento</th>
        <th>Nombre</th>
        <th>Descripción</th>
    </tr>";
    foreach ($departamentos as $departamento) {
    echo "<tr>
        <td>" . $departamento['idDepartamento'] . "</td>
        <td>" . $departamento['Nombre'] . "</td>
        <td>" . $departamento['Descripcion'] . "</td>
    </tr>";
    }
    echo "</table>";
?>