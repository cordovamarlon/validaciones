<?php
#primer paso
    $errores = [];
#segundo paso 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        
        if(filter_var($_POST['numero'], FILTER_VALIDATE_INT) === false){
            $errores['numero']="el numero no es valido";
        }elseif($_POST['numero'] < 1 || $_POST['numero'] > 10){
                $errores['numero'] = "El numero debe estar entre 1 y 10";
        }else{
           
           $numero = $_POST['numero'];
        }
        if(empty($errores)){
            echo "todo es corecto <br>";
            echo htmlspecialchars($numero);
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
        <label for="numero">
            Numero:
            <input type="text" name="numero" id="numero" value="<?php echo htmlspecialchars($numero) ?? '' ?>" required>

        </label>
        
        <input type="submit" value="Enviar">
    </form>
    <?php if(isset($errores['numero'])) echo $errores['numero']; ?>
</body>
</html>