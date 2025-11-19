<?php
$errores=[];

if($_SERVER['REQUEST_METHOD']=="POST"){
    $nombre = trim($_POST['nombre']);
    $correo = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL );
    $telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_NUMBER_INT);

    $asistentes = filter_var($_POST['asistentes'],FILTER_SANITIZE_NUMBER_INT);

    if(empty($nombre)){
        $errores['nombre'] = "el campo nombre no puede estar vacio";
    }elseif(mb_strlen($nombre) < 5 || mb_strlen($nombre) > 100 ){
        $errores['nombre'] = "EL nombre debe tener entre 5 y 100 caracteres";

    }elseif(!preg_match('/^[a-zA-ZáéíóíÁÉÍÓÚñÑ ]+$/',$nombre)){
        
            $errores['nombre'] = "El nombre solo puede contener letras y espacios";
    }else{
        $nombre_bien = $nombre;
    }

    if(empty($correo)){
        $errores['correo'] = "No puede estar vacio";
    }elseif(filter_var($correo,FILTER_VALIDATE_EMAIL)=== false){
        $errores['correo'] = "debes ingresar un correo valido";
    }else{
        $correo_bien = $correo;
    }

    if(empty($telefono)){
        $errores['telefono'] = "Telefono no puede estar vacio";
    }elseif(filter_var($telefono, FILTER_VALIDATE_INT) === false){
        $errores['telefono'] = "Solo puede tener digitos";
    }elseif(mb_strlen($telefono) != 10){
        $errores['telefono'] = "tiene que tener exactamente 10 numeros";
    }else{
        $telefono_bien = $telefono;
    }

    if(empty($asistentes)){
        $errores['asistentes'] = "El campo asistentes no puede estar vacio";
    }elseif(filter_var($asistentes,FILTER_SANITIZE_NUMBER_INT)=== false){
        $errores['asistentes'] = "DEBE SER DIGITOS";
    }elseif($asistentes < 1 | $asistentes > 10){
        $errores['asistentes'] = "el numero debe ser entre 1 y 10";
    }else{
        $asistentes_bien = $asistentes;
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
    <form action="" method="post">
        <label for="nombre">
            nombre:
            <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($nombre_bien) ?>">
            <?php echo $errores['nombre'] ?? ''?><br>
        </label><br>
        <label for="email">
            correo electronico:
            <input type="text" name="email" id="email" value="<?php echo htmlspecialchars($correo_bien) ?>">
            <?php echo $errores['correo'] ?? ''?>
        </label><br>
        <label for="telefono">
            numero de telefono:
            <input type="text" name="telefono" id="telefono" value="<?php echo htmlspecialchars($telefono_bien) ?>">
            <?php echo $errores['telefono'] ?? '' ?>
        </label><br>
        <label for="asistentes">
            cantidad de asistentes:
            <input type="text" name="asistentes" id="asistentes" value="<?php  echo $asistentes_bien?>">
            <?php echo $errores['asistentes'] ?? '' ?>
        </label><br>
        <input type="submit" value="enviar">
    </form>
</body>
</html>