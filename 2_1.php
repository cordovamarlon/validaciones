<?php 
    
    $errores =[];
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nombre = trim($_POST['nombre']);
        $contacto = $_POST['contacto'];
        $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $telefono = filter_var($_POST['telefono'],FILTER_SANITIZE_NUMBER_INT);
        $satis = $_POST['satis'] ?? null;
        $mejorar = $_POST['mejorar'] ?? null;
        
   
        if(empty($nombre)){
            $errores['nombre'] = "el nombre no puede estar vacio";

        }elseif(!preg_match('/^[a-zA-Z áéíóúÁÉÍÓÚ]{5,100}$/', $nombre)){
            $errores['nombre'] = "formato no valido";
        }else{
            $nombre_bien = $nombre;
        }

        //contacto
        $formas_contacto = ['correo','telefono','whatsapp'];
        if(empty($contacto)){
            $errores['contacto'] = "Debes seleccionar un metodo de contacto";
        }elseif(!in_array($contacto, $formas_contacto)){
            $errores['contacto'] = "Metodo de contacto no valido";
        }else{
            $contacto_bien = $contacto;
        }

        //email
        if ($contacto == 'correo'){
            if (empty($email)){
                $errores['email'] = "Debe ingresar un correo electronico";
            }elseif(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
                $errores['email'] = "Formato de correo electronico invalidado";
            }else{
                $email_bien = $email;
            }
        }

        //telefono
        if ($contacto == 'telefono' || $contacto == 'whatsapp'){
            if(empty($telefono)){
                $errores['telefono'] = "El campo telefono no puede estar vacio";
            }elseif(strlen($telefono) != 9){
                $errores['telefono'] = "el telefono debe tener 9 digitos";
            }else{
                $telefono_bien = $telefono;
            }
        }
        //nivel de satisfacción
        $formas_satis = ['muy satisfecho','satisfecho','neutral','insatisfecho','muy insatisfecho'];

        if(empty($satis)){
            $errores['satis'] = "debes selecionar uno";
            
        }elseif(!in_array($satis,$formas_satis)){
            $errores['satis']="opcion no";
        }else{
            $satis_bien = $satis;
        }

        //mejoras
        
        if(empty($mejorar)){
            $errores['mejorar'] = "este campo esta vacio";
        }elseif(count($mejorar) > 3){
            $errores['mejorar'] = "Se deben seleccionar como máximo 3 mejoras";
        }else{
            $mejorar_bien = $mejorar;
        }
       


        if(empty($errores)){
            echo "Nombre: $nombre_bien <br>";
            echo "Contacto: $contacto_bien <br>";
            echo "email: $email_bien<br>";
            echo "telefono: $telefono_bien";
            echo "nivel de satisfacción: $satis_bien<br>";
            echo "mejoras: $mejorar_bien";
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
            <input type="text" name="telefono" id="telefono" value="<?php echo htmlspecialchars($telefono_bien ?? '')?>">
            <?php echo $errores['telefono'] ?? ''?>
        </label>
        <br>
        <p>Nivel de Satisfacción: </p>
    
         <?php echo $errores['satis']?? '' ?>
        <br>
        <input type="radio" name="satis" value="muy satisfecho" <?php if(isset($satis_bien) && $satis_bien == 'muy satisfecho') echo "checked"?>> Muy Satisfecho
        
        <br>
        <input type="radio" name="satis" value="satisfecho" <?php if(isset($satis_bien) && $satis_bien == 'satisfecho') echo "checked"?>> Satisfecho
        <br>
        <input type="radio" name="satis" value="neutral"<?php if(isset($satis_bien) && $satis_bien == 'neutral') echo "checked"?>> Neutral
        <br>
        <input type="radio" name="satis" value="insatisfecho" <?php if(isset($satis_bien) && $satis_bien == 'insatisfecho') echo "checked"?>> Insatisfecho
        <br>
        <input type="radio" name="satis" value="muy insatisfecho" <?php if(isset($satis_bien) && $satis_bien == 'muy insatisfecho') echo "checked"?>> Muy Insatisfecho
        <br>

        
        <p>Tres aspectos a mejorar: </p>
        <?php echo $errores['mejorar'] ?? '' ?><br>
        <input type="checkbox" name="mejorar[]" value="atencion" <?php if(isset($mejorar_bien) && in_array("atencion",$mejorar_bien))echo "checked" ?>> Atención al Cliente
        <br>
        <input type="checkbox" name="mejorar[]" value="tiempo" <?php if(isset($mejorar_bien) && in_array("tiempo",$mejorar_bien))echo "checked" ?>> Tiempo de Espera
        <br>
        <input type="checkbox" name="mejorar[]" value="calidad" <?php if(isset($mejorar_bien) && in_array("calidad",$mejorar_bien))echo "checked" ?>> Calidad del producto
        <br>
        <input type="checkbox" name="mejorar[]" value="precio" <?php if(isset($mejorar_bien) && in_array("precio",$mejorar_bien))echo "checked"?>> Precio
        <br>
        <input type="checkbox" name="mejorar[]" value="experiencia" <?php if(isset($mejorar_bien) && in_array("experiencia",$mejorar_bien))echo "checked"?>> Experiencia en la web
        <br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>