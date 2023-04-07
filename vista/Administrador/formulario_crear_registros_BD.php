<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crear registros segun la tabla</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>+
    <input type="text" placeholder="Tabla del nuevo registro" id="tabla_regis" name="tabla_regis">
    <?php
    $tabla="tabla_regis";//tabla que entra por input
    switch($crear_tabla){
        case"":
            echo"<table><thead><tr><th>Provincia</th></tr></thead>";
            echo"</tbody><tr><td></td></tr></tbody>";
            break;
        case"":
            echo"";
            break;
        case"":
            echo"";
            break;
        case"":
            echo"";
            break;
        case"":
            echo"";
            break;
        case"":
            echo"";
            break;
        case"":
            echo"";
            break;
        case"":
            echo"";
            break;
        case"":
            echo"";
            break;
        default:
            echo"No existe la tabla";
                                    
}


?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

</body>

</html>