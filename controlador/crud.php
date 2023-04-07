<?php
function crud_select($tabla, $field_name, $condicion) {
    try {
        // Conectar a la base de datos utilizando PDO
        $dsn = 'mysql:host=localhost;dbname=hospital';
        $username = 'root';
        $password = '';
        $pdo = new PDO($dsn, $username, $password);

        // Crear una consulta dinámica utilizando los parámetros proporcionados
        $sql = "SELECT * FROM $tabla WHERE $field_name = :condicion";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':condicion', $condicion);
        $stmt->execute();

        // Retornar los resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function crud_insert($table_name, $fields) {
    try {
        // Conectar a la base de datos utilizando PDO
        $dsn = 'mysql:host=localhost;dbname=hospital';
        $username = 'root';
        $password = '';
        $pdo = new PDO($dsn, $username, $password);

        // Crear una consulta dinámica utilizando los parámetros proporcionados
        $keys = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));
        $sql = "INSERT INTO $table_name ($keys) VALUES ($placeholders)";
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