<?php
/**
 * select usuario.Nombre, usuario.Apellido,cita.Hora from usuario
*inner join cita on usuario.idUsuario=cita.idUsuario
*inner join personal on cita.idPersonal=personal.idPersonal
*where personal.Nombre='Isabel' AND personal.Apellido like 'Montes Alpes%' AND DATE (cita.Hora) = '2023-05-11'
 */
// consulta nombre del centro y dirección por provincia
function obtener_usuarios_por_especialista_fecha($fecha,$nombre,$apellido){
    try {
        // Conectar a la base de datos utilizando PDO
        $dsn = 'mysql:host=localhost;dbname=hospital';
        $username = 'root';
        $password = '';
        $pdo = new PDO($dsn, $username, $password);
       //realiza la consulta
        $sql = "SELECT usuario.Nombre, usuario.Apellido,cita.Hora from usuario
        inner join cita on usuario.idUsuario=cita.idUsuario
        inner join personal on cita.idPersonal=personal.idPersonal
        where personal.Nombre='$nombre' AND personal.Apellido like '$apellido%' AND DATE (cita.Hora) = '$fecha';";
        $stmt = $pdo->prepare($sql);//prepara la consulta
        $stmt->execute();//ejecuta

        // Retornar los resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);//devuelve todos los registros
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


?>