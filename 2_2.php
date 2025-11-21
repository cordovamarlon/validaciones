<?php
    $errores=[];
if($_SERVER['REQUEST_METHOD']=='POST'){
    $nombre = trim($_POST['nombre']);
    $correo = filter_var($_POST['correo'],FILTER_SANITIZE_EMAIL);
    $fecha = $_POST['fecha'];
    $participacion = $_POST['participacion'] ?? null;
//nombre

if(empty($nombre)){
        $errores['nombre'] = "Este campo no puede estar vacio";

    }elseif(!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚ]{5,100}$/', $nombre)){
        $errores['nombre'] = "formato no valido";
    }else{
        $nombre_bien = $nombre;
    }


//correo

if(empty($correo)){
    $errores['correo'] = "El campo no puede estar vacio";

}elseif(filter_var($correo, FILTER_VALIDATE_EMAIL) === false ){
    $errores['correo'] = "Formato no valido";

}else{
    $correo_bien = $correo;
}


//fecha

if(empty($fecha)){
    $errores['fecha'] = "No puede estar vacio";
}elseif(!preg_match('/^\d{2}\/\d{2}\/\d{4}$/',$fecha)){
    $errores['fecha'] = "formato no valido";
}else{
    $fecha_bien = $fecha;
}

//participacion

$formas_participacion = ['asistente','ponente'];

if(empty($participacion)){
    $errores['participacion'] = "debes seleccionar un metodo";
}elseif(!in_array($participacion,$formas_participacion)){
    
}




if(empty($errores)){
        echo "nombre: ".htmlspecialchars($nombre_bien)."<br>";
        echo "correo: ".htmlspecialchars($correo_bien)."<br>";
        echo "fecha: ".htmlspecialchars($fecha_bien)."<br>";
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
            Nombre:
            <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($nombre_bien  ?? '')?>">
            <?php echo $errores['nombre'] ?? '' ?>
        </label><br>
        <label for="correo">
            Correo:
            <input type="text" name="correo" id="correo" value="<?php echo htmlspecialchars($correo_bien ?? '')?>">
            <?php echo $errores['correo'] ?? '' ?>
        </label><br>
        
        <label for="fecha">
            Fecha de nacimiento:
            <input type="text" name="fecha" id="fecha" value="<?php echo htmlspecialchars($fecha_bien ?? '')?>">
            <?php echo $errores['fecha'] ?? '' ?>
        </label>
        <p>Tipo de participacion</p>
        <input type="radio" name="participacion" value="asistente"> Asistente <br>

        <input type="radio" name="participacion" value="ponente"> ponente<br>

        <p>Temas de interés</p>

        <input type="checkbox" name="interes[]" value="programacion"> Programacion <br>
        <input type="checkbox" name="interes[]" value="ciberseguridad">Ciberseguridad(solo Madrid o Sevilla)<br>
        <input type="checkbox" name="interes[]" value="inteligencia"> Inteligencia artificial<br>
        <input type="checkbox" name="interes[]" value="redes"> Redes <br>
        <input type="checkbox" name="interes[]" value="desarrollo"> Desarrollo Web <br>

        <p>Ciudad</p>

        <select name="ciudad" id="ciudad" multiple>
            <option value="madrid">Madrid</option><br>
            <option value="barcelona">Barcelona</option><br>
            <option value="sevilla">Sevilla</option><br>
            <option value="valencia">Valencia</option><br>
        </select>

        <input type="submit" value="enviar">



    </form>
</body>
</html>