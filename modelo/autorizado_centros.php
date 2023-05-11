<?php
// consulta nombre del centro y dirección por provincia
function obtener_centros_por_provincia($condicion){
    try {
        // Conectar a la base de datos utilizando PDO
        $dsn = 'mysql:host=localhost;dbname=hospital';
        $username = 'root';
        $password = '';
        $pdo = new PDO($dsn, $username, $password);
       //realiza la consulta
        $sql = "SELECT c.direccion, c.telefono, ci.Nombre
        FROM Provincia p
        JOIN Ciudad ci ON p.idProvincia = ci.idProvincia
        JOIN Centro c ON ci.idCiudad = c.idCiudad
        WHERE p.Nombre = '$condicion';";
        $stmt = $pdo->prepare($sql);//prepara la consulta
        $stmt->execute();//ejecuta

        // Retornar los resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);//devuelve todos los registros
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


?>