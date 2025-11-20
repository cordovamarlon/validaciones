<?php 
    
    $errores =[];
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nombre = trim($_POST['nombre']);
        $contacto = $_POST['contacto'];
        $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);

        if(empty($nombre)){
            $errores['nombre'] = "el nombre no puede estar vacio";

        }elseif(!preg_match('/^[a-zA-Z áéíóúÁÉÍÓÚ]{5,100}$/', $nombre)){
            $errores['nombre'] = "formato no valido";
        }else{
            $nombre_bien = $nombre;
        }

        //contacto
        $formas_contacto = ['correo','telefono','whatssap'];
        if(empty($contacto)){
            $errores['contacto'] = "Debes seleccionar un metodo de contacto";
        }elseif(!in_array($contacto, $formas_contacto)){
            $errores['contacto'] = "Metodo de contacto no valido";
        }else{
            $contacto_bien = $contacto;
        }

        //email
        if($contacto != 'correo' && empty($email)){
            $errores['email'] = "debes introducir un correo electronico";
        }elseif(filter_var($email, FILTER_VALIDATE_EMAIL)=== false){
            $errores['email'] = "necesitas un correo valido"; 
        }else{
            $email_bien = $email;
        }


        if(empty($errores)){
            echo "Nombre: $nombre_bien <br>";
            echo "Contacto: $contacto_bien <br>";
            echo "email: $email <br>";
        }





    }



?>




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validación 6</title>
</head>
<body>
    <form action="" method="post">
        <label for="nombre">
            Nombre:
            <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($nombre_bien ?? '')?>">
            <?php echo $errores['nombre'] ?? '' ?>
        </label>
        <br>
        <select name="contacto" id="contacto">
            <option value="">Selecciona un metodo de contacto</option>
            <option value="correo" <?php if(isset($contacto_bien) && $contacto_bien == 'correo') echo 'selected'?>>Correo Electronico</option>
            <option value="telefono" <?php if(isset($contacto_bien) && $contacto_bien == 'telefono') echo 'selected'?>>Teléfono</option>
            <option value="whatsapp" <?php if(isset($contacto_bien) && $contacto_bien == 'whatsapp') echo 'selected'?>>Whatsapp</option>       
        </select>
        <?php echo $errores['contacto'] ?? '' ?>
        <br>
        <label for="email">
            E-mail:
            <input type="text" name="email" id="email" value="<?php echo htmlspecialchars($email_bien ?? '' )?>">
            <?php echo $errores['email'] ?? '' ?>
        </label>
        <br>
        <label for="telefono">
            Teléfono:
            <input type="text" name="telefono" id="telefono">
        </label>
        <br>
        <p>Nivel de Satisfacción: </p>
        <input type="radio" name="satis" value="Muy Satisfecho"> Muy Satisfecho
        <br>
        <input type="radio" name="satis" value="Satisfecho"> Satisfecho
        <br>
        <input type="radio" name="satis" value="Neutral"> Neutral
        <br>
        <input type="radio" name="satis" value="Insatisfecho"> Insatisfecho
        <br>
        <input type="radio" name="satis" value="Muy Insatisfecho"> Muy Insatisfecho
        <br>
        <p>Tres aspectos a mejorar: </p>
        <input type="checkbox" name="mejorar[]" value="atencion"> Atención al Cliente
        <br>
        <input type="checkbox" name="mejorar[]" value="tiempo"> Tiempo de Espera
        <br>
        <input type="checkbox" name="mejorar[]" value="calidad"> Calidad del producto
        <br>
        <input type="checkbox" name="mejorar[]" value="precio"> Precio
        <br>
        <input type="checkbox" name="mejorar[]" value="experiencia"> Experiencia en la web
        <br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>