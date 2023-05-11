<?php
function obtener_familiares_por_dni($condicion){
    try {
        // Conectar a la base de datos utilizando PDO
        $dsn = 'mysql:host=localhost;dbname=hospital';
        $username = 'root';
        $password = '';
        $pdo = new PDO($dsn, $username, $password);
       //realiza la consulta
        $sql = "SELECT familiar.Nombre AS familiarNombre, familiar.Apellido AS familiarApellido
        FROM usuario 
        JOIN familiar  ON usuario.idUsuario = familiar.idUsuario
        WHERE usuario.Dni = '$condicion';";
        $stmt = $pdo->prepare($sql);//prepara la consulta
        $stmt->execute();//ejecuta

        // Retornar los resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);//devuelve todos los registros
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


?>