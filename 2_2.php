<?php
    $errores=[];
if($_SERVER['REQUEST_METHOD']=='POST'){
    $nombre = trim($_POST['nombre']);


if(empty($nombre)){
        $errores['nombre'] = "Este campo no puede estar vacio";

    }elseif(!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚ]{5,100}$/', $nombre)){
        $errores['nombre'] = "formato no valido";
    }else{
        $nombre_bien = $nombre;
    }


    if(empty($errores)){
        echo "nombre: $nombre_bien";
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
            <input type="text" name="correo" id="correo">
        </label><br>
        <label for="fecha">
            Fecha de nacimiento:
            <input type="text" name="fecha" id="fecha">
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