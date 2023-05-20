<?php
/**
 * Estas consultas se usan para el portal del especialista y en el portal del usuario autorizado
 * 
 * SELECT usuario.Nombre, usuario.Apellido,usuario.Dni,cita.Hora from usuario
        *inner join cita on usuario.idUsuario=cita.idUsuario
        *where cita.idPersonal=1 AND DATE (cita.Hora) = '2023-05-11';//
 */
// consulta nombre del centro y dirección por provincia
function obtener_cita_por_fecha($fecha,$idPersonal){
    try {
        // Conectar a la base de datos utilizando PDO
        $dsn = 'mysql:host=localhost;dbname=hospital';
        $username = 'root';
        $password = '';
        $pdo = new PDO($dsn, $username, $password);
       //realiza la consulta
       
       $sql = "SELECT usuario.Nombre AS nombre, usuario.Apellido AS apellido, usuario.Dni AS dni, cita.Hora AS fecha 
        FROM usuario
        INNER JOIN cita ON cita.idUsuario=usuario.idUsuario 
        WHERE cita.idPersonal='$idPersonal' AND DATE(cita.Hora) = '$fecha'";

        $stmt = $pdo->prepare($sql);//prepara la consulta
        $stmt->execute();//ejecuta

        // Retornar los resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);//devuelve todos los registros
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
function id_Personal($dni){
    try {
        // Conectar a la base de datos utilizando PDO
        $dsn = 'mysql:host=localhost;dbname=hospital';
        $username = 'root';
        $password = '';
        $pdo = new PDO($dsn, $username, $password);
       //realiza la consulta
       
       $sql = "SELECT * from personal
       where personal.Dni = '$dni';";

        $stmt = $pdo->prepare($sql);//prepara la consulta
        $stmt->execute();//ejecuta

        // Retornar los resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);//devuelve todos los registros
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
function obtener_dni_usuario($nombre,$apellido){
    try {
        // Conectar a la base de datos utilizando PDO
        $dsn = 'mysql:host=localhost;dbname=hospital';
        $username = 'root';
        $password = '';
        $pdo = new PDO($dsn, $username, $password);
       //realiza la consulta
       
       $sql = "SELECT * from usuario
       where Nombre = '$nombre' AND Apellido='$apellido';";

        $stmt = $pdo->prepare($sql);//prepara la consulta
        $stmt->execute();//ejecuta

        // Retornar los resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);//devuelve todos los registros
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

}

function obtenerIdPersonalPorNombre($nombre,$apellido){
    try {
        // Conectar a la base de datos utilizando PDO
        $dsn = 'mysql:host=localhost;dbname=hospital';
        $username = 'root';
        $password = '';
        $pdo = new PDO($dsn, $username, $password);
       //realiza la consulta

        $sql = "SELECT personal.idPersonal from usuario inner join 
        personal on personal.Dni = usuario.Dni
               where usuario.Nombre = '$nombre' AND usuario.Apellido='$apellido';";

        $stmt = $pdo->prepare($sql);//prepara la consulta
        $stmt->execute();//ejecuta

        // Retornar los resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);//devuelve todos los registros
        } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        }

}

?>