<?php
$errores = [];

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $distancia = trim($_POST['distancia']);
    $tiempo = trim($_POST['minutos']);
    

    if(empty($distancia)){
        $errores['distancia'] = "Inserta distancia";
    }elseif(!is_numeric($distancia)){
        $errores['distancia'] = "La distancia debe ser un numero";

    }elseif($distancia <= 0){
        $errores['distancia'] = "La distancia debe ser un numero positivo";
    }else{
        $distancia_bien = $distancia;

    }

    if (empty($tiempo)){
        $errores['tiempo'] = "El tiempo es obligatorio";
    }elseif(filter_var($tiempo,FILTER_VALIDATE_INT)===false){
        $errores['tiempo'] = "el tiempo debe ser un numero entero";
    }elseif($tiempo < 0 || $tiempo > 120){
        $errores['tiempo'] ="el tiempo debe estar entre 0 a 120 minutos";
    }else{
        $tiempo_bien = $tiempo;
    }

    if(empty($errores)){
        $distancia_num = floatval($distancia_bien);
        $tiempo_num = intval($tiempo_bien);

        $tarifa_base = 3;
        $precio_km = $distancia_num * 1.50;
        $precio_min = $tiempo_num * 0.50;
        $precio_total = $precio_km + $precio_min + $tarifa_base;
            echo "El precio total es:". htmlspecialchars($precio_total);
    }

}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Calculadora del precio de servicio de taxi</h1>
    <form action="" method="post">
        <label for="distancia">
            Distancia: 
            <input type="number" name="distancia" id="distancia" required>
        </label>
        <label for="tiempo">
            Tiempo: 
            <input type="number" name="minutos" id="minutos" required>
        </label>
        <input type="submit" value="Enviar">
    </form>
    
</body>
</html>