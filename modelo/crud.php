<?php

function crud_get_all($tabla) {//consulta toda la tabla
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

function crud_select($tabla, $campo, $condicion) {//busca por condición
    try {
        // Conectar a la base de datos utilizando PDO
        $dsn = 'mysql:host=localhost;dbname=hospital';
        $username = 'root';
        $password = '';
        $pdo = new PDO($dsn, $username, $password);
        // Crear una consulta dinámica utilizando los parámetros proporcionados
        $sql = "SELECT * FROM $tabla WHERE $campo = '$condicion'";//realiza la consulta
        $stmt = $pdo->prepare($sql);//prepara la consulta
        $stmt->execute();//ejecuta

        // Retornar los resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);//devuelve todos los registros
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function crud_insertar($tabla, $campos) {//inserta
    try {
        // Conectar a la base de datos utilizando PDO
        $dsn = 'mysql:host=localhost;dbname=hospital';
        $username = 'root';
        $password = '';
        $pdo = new PDO($dsn, $username, $password);

        // Crear una consulta dinámica utilizando los parámetros proporcionados
        $clave = implode(', ', array_keys($campos));//saca las columnas de las Keys
        $placeholders = ':' . implode(', :', array_keys($campos));//prepara los placeholders para el funcionamiento de la función bindValue()
        $sql = "INSERT INTO $tabla ($clave) VALUES ($placeholders)";//consulta
        $stmt = $pdo->prepare($sql);//peraparción
        // Vincular los valores a los marcadores de posición
        foreach ($campos as $clave => $valor) {
            $stmt->bindValue(':' . $clave, $valor);//reemplaza los placeholders por los valores reales que vienen por parámetro campos
        }

        // Ejecutar la consulta y retornar el número de filas afectadas
        $stmt->execute();
        return $stmt->rowCount();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function crud_actualizar($tabla, $campos, $condicion) {//actuliza
    try {
        // Conectar a la base de datos utilizando PDO
        $dsn = 'mysql:host=localhost;dbname=hospital';
        $username = 'root';
        $password = '';
        $pdo = new PDO($dsn, $username, $password);

        // Crear una consulta dinámica utilizando los parámetros proporcionados
        $set = '';
        foreach ($campos as $key => $value) {
            $set .= "$key = :$key, ";//clave es igual a clave
        }
        $set = rtrim($set, ', ');// quita la última coma

        $sql = "UPDATE $tabla SET $set WHERE $condicion";//crea la consulta
        $stmt = $pdo->prepare($sql);//prepara la consulta

        // Vincular los valores a los marcadores de posición
        foreach ($campos as $key => $value) {
            $stmt->bindValue(':' . $key, $value);// se reemplaza con la función bindValue()
        }

        // Ejecutar la consulta y retornar el número de filas afectadas
        $stmt->execute();
        return $stmt->rowCount();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function crud_borrar($tabla, $id) {//elimina
    try {
        // Conectar a la base de datos utilizando PDO
        $dsn = 'mysql:host=localhost;dbname=hospital';
        $username = 'root';
        $password = '';
        $pdo = new PDO($dsn, $username, $password);

        // Crear una consulta dinámica utilizando los parámetros proporcionados
        $sql = "DELETE FROM $tabla WHERE id"  .$tabla . " = " . $id;// el id de la tabla es igual al id que entra por parámetro
        $stmt = $pdo->prepare($sql);

        // Ejecutar la consulta y retornar el número de filas afectadas
        $stmt->execute();
        return $stmt->rowCount();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function crud_borrar_relacion($tabla,$id1, $valor1, $id2, $valor2) {//elimina relación de muchos a muchos 
    try {
        // Conectar a la base de datos utilizando PDO
        $dsn = 'mysql:host=localhost;dbname=hospital';
        $username = 'root';
        $password = '';
        $pdo = new PDO($dsn, $username, $password);

        /* Crear una consulta dinámica
        * Tabla (M-M) si el id1 es igual al valor1 que entra y el id2 es igual al valor2 que entra
        * DELETE FROM hospital.centro_departamento where idCentro=1 AND idDepartamento=1
        */
        $sql = "DELETE FROM " . $tabla . " WHERE id"  .$id1 . " = " . $valor1 . " AND id" . $id2 . " = " . $valor2;
        $stmt = $pdo->prepare($sql);

        // Ejecutar la consulta y retornar el número de filas afectadas
        $stmt->execute();
        return $stmt->rowCount();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>