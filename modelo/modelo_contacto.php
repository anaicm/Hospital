<?php
//Busca la direccion y telefono de los centros por ciudad
function obtener_centros_por_ciudad($condicion){
    try {
        // Conectar a la base de datos utilizando PDO
        $dsn = 'mysql:host=localhost;dbname=hospital';
        $username = 'root';
        $password = '';
        $pdo = new PDO($dsn, $username, $password);
       //realiza la consulta
        $sql = "SELECT c.Direccion, c.Telefono 
        FROM Centro c 
        JOIN Ciudad ci ON c.idCiudad = ci.idCiudad 
        WHERE ci.Nombre = '$condicion';";
        $stmt = $pdo->prepare($sql);//prepara la consulta
        $stmt->execute();//ejecuta

        // Retornar los resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);//devuelve todos los registros
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>