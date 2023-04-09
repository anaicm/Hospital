<?php
require_once('../../modelo/crud.php');

$familiares=crud_get_all('familiar');//trae la tabla familiar

echo "<table>";
    echo "<tr>
        <th>idFamiliar</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Teléfono</th>
        <th>FechaNacimiento</th>
    </tr>";
    foreach ($familiares as $familiar) {
    echo "<tr>
        <td>" . $usuario['idFamiliar'] . "</td>
        <td>" . $usuario['Nombre'] . "</td>
        <td>" . $usuario['Apellido'] . "</td>
        <td>" . $usuario['Telefono'] . "</td>
        <td>" . $usuario['FechaNacimiento'] . "</td>
    </tr>";
    }
    echo "</table>";
?>