<?php

function crud_getall($tabla) {
    try {
        // Conexión base de datos
        //require_once("Conexion_BD.php");
        $dsn = 'mysql:host=localhost;dbname=hospital';
        $username = 'root';
        $password = '';
        $pdo = new PDO($dsn, $username, $password);
        // Crear una consulta dinámica utilizando los parámetros proporcionados
        $sql = "SELECT * FROM $tabla";//realiza la consulta
        $stmt = $pdo->prepare($sql);//prepara la consulta
        $stmt->execute();//ejecuta

        // Retornar los resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);//devuelve todos los registros
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function crud_select($tabla, $campo, $condicion) {
    try {
        // Conexión base de datos
        require_once("Conexion_BD.php");
        // Crear una consulta dinámica utilizando los parámetros proporcionados
        $sql = "SELECT * FROM $tabla WHERE $campo = :condicion";//realiza la consulta
        $stmt = $pdo->prepare($sql);//prepara la consulta
        $stmt->bindParam(':condicion', $condicion);//asigna el valor de la condición
        $stmt->execute();//ejecuta

        // Retornar los resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);//devuelve todos los registros
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function crud_insert($tabla, $campos) {
    try {
        // Conectar a la base de datos utilizando PDO
        require_once("Conexion_BD.php");

        // Crear una consulta dinámica utilizando los parámetros proporcionados
        $clave = implode(', ', array_keys($campos));
        $placeholders = ':' . implode(', :', array_keys($campos));
        $sql = "INSERT INTO $tabla ($clave) VALUES ($placeholders)";
        $stmt = $pdo->prepare($sql);

        // Vincular los valores a los marcadores de posición
        foreach ($campos as $clave => $valor) {
            $stmt->bindValue(':' . $clave, $valor);
        }

        // Ejecutar la consulta y retornar el número de filas afectadas
        $stmt->execute();
        return $stmt->rowCount();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function crud_update($table_name, $fields, $condition) {
    try {
        // Conectar a la base de datos utilizando PDO
        $dsn = 'mysql:host=localhost;dbname=hospital';
        $username = 'root';
        $password = '';
        $pdo = new PDO($dsn, $username, $password);

        // Crear una consulta dinámica utilizando los parámetros proporcionados
        $set = '';
        foreach ($fields as $key => $value) {
            $set .= "$key = :$key, ";
        }
        $set = rtrim($set, ', ');
        $sql = "UPDATE $table_name SET $set WHERE $condition";
        $stmt = $pdo->prepare($sql);

        // Vincular los valores a los marcadores de posición
        foreach ($fields as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }

        // Ejecutar la consulta y retornar el número de filas afectadas
        $stmt->execute();
        return $stmt->rowCount();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function crud_delete($table_name, $condition) {
    try {
        // Conectar a la base de datos utilizando PDO
        $dsn = 'mysql:host=localhost;dbname=hospital';
        $username = 'root';
        $password = '';
        $pdo = new PDO($dsn, $username, $password);

        // Crear una consulta dinámica utilizando los parámetros proporcionados
        $sql = "DELETE FROM $table_name WHERE $condition";
        $stmt = $pdo->prepare($sql);

        // Ejecutar la consulta y retornar el número de filas afectadas
        $stmt->execute();
        return $stmt->rowCount();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>