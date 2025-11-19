<?php 
$errores= [];

if($_SERVER['REQUEST_METHOD']=='POST'){
    $nombre = $_POST['nombre'];
    $correo = filter_var($_POST['correo'],FILTER_SANITIZE_EMAIL);
    $contraseña = trim($_POST['contraseña']);
    $telefono = filter_var($_POST['telefono'],FILTER_SANITIZE_NUMBER_INT);
    $edad = trim($_POST['edad']);




    if(empty($nombre)){
        $errores['nombre'] = "El campo nombre no debe estar vacio";
    }elseif(!preg_match('/^[a-zA-Z0-9 ]{3,50}$/',$nombre)){
        $errores['nombre'] = "Has escrito un parametro incorrecto";
    }else{
        $nombre_bien = $nombre;
    }


    if(empty($correo)){
        $errores['correo'] = "El campo correo no puede estar vacio";
    }elseif(filter_var($correo,FILTER_VALIDATE_EMAIL) === false){
        $errores['correo'] = "El correo no es valido";
    }else{
        $correo_bien = $correo;
    }

    if(empty($contraseña)){
        $errores['contraseña'] = "El campo contraseña no puede estar vacia";
    }elseif(mb_strlen($contraseña, "UTF-8")< 8){
        $errores['contraseña'] = "la contraseña no puede ser menor de 8 carateres";
    }else{
        $contraseña_bien = $contraseña;
    }

    if(empty($telefono)){
        $errores['telefono'] = "El campo telefono no puede estar vacio";
    }elseif(strlen($telefono) != 10){
        $errores['telefono'] = "los digitos no pueden ser mayor de 10";
    }else{
        $telefono_bien = $telefono;
    }
    
    if(empty($edad)){
        $errores['edad'] = "el campo edad no puede estar vacio";
    }elseif(filter_var($edad, FILTER_VALIDATE_INT) === false ){
        $errores['edad'] = "la edad solo puede ser un numero entero";
    }elseif($edad < 0 || $edad > 120){
        $errores['edad'] = "La edad debe estar entre 0 y 120";
    }

    if(empty($errores)){
        echo "el nombre es: $nombre";
        echo "el correo es: $correo";
        echo "la contraseña es: $contraseña";
        echo "el telefono es: $telefono";
        echo "la edad es : $edad";


    }


}



?>





<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label for="nombre">
            Nombre:
            <input type="text" name="nombre" id="nombres">
            <?php echo $errores['nombre'] ?? ''?><br>
        </label>
        <label for="correo">
            Correo:
            <input type="text" name="correo" id="correo">
            <?php echo $errores['correo'] ?? '' ?><br>
            <br>
        </label>
        <label for="contraseña">
            Contraseña:
            <input type="text" name="contraseña" id="contraseña">
            <?php echo $errores['contraseña'] ?? '' ?>
            <br>
        </label>
        <label for="telefono">
            Telefono:
            <input type="text" name="telefono" id="telefono">
            <br>
            <?php echo $errores['telefono'] ?? '' ?>
        </label>
        <label for="edad">
            Edad:
            <input type="text" name="edad" id="edad">
            <br>
        </label>
        <input type="submit" value="Enviar">
        <br>
    </form>
    
</body>
</html>