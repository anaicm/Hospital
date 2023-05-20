<?php
//según el nombre del centro dame todos los especilistas
function obtener_especililstas_por_centro($condicion){
    try {
        // Conectar a la base de datos utilizando PDO
        $dsn = 'mysql:host=localhost;dbname=hospital';
        $username = 'root';
        $password = '';
        $pdo = new PDO($dsn, $username, $password);
       //realiza la consulta
        $sql = "SELECT Personal.Nombre as NombrePersonal, Departamento.Nombre as NombreDepartamento, Centro.Nombre as NombreCentro
        FROM Personal 
        INNER JOIN Departamento_personal ON Personal.idPersonal = Departamento_personal.idPersonal 
        INNER JOIN Departamento ON Departamento_personal.idDepartamento = Departamento.idDepartamento 
        INNER JOIN centro_departamento ON Departamento.idDepartamento = centro_departamento.idDepartamento 
        INNER JOIN Centro ON centro_departamento.idCentro = Centro.idCentro 
        WHERE Centro.Nombre = '$condicion';";
        $stmt = $pdo->prepare($sql);//prepara la consulta
        $stmt->execute();//ejecuta

        // Retornar los resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);//devuelve todos los registros
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>