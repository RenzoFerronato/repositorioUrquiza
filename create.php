<?php
require_once 'clases/ControladorSesion.php';
if (isset($_POST['usuario']) && isset($_POST['clave'])) {
    $cs = new ControladorSesion();
    $result = $cs->create($_POST['usuario'], $_POST['nombre'], 
                          $_POST['apellido'], $_POST['clave']);
    if( $result[0] === true ) {
        $redirigir = 'home.php?mensaje='.$result[1];
    }
    else {
        $redirigir = 'create.php?mensaje='.$result[1];
    }
    header('Location: ' . $redirigir);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@1,300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Neucha&display=swap" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="lightbox.min.css"/>
    <title>Registro</title>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- <link rel="icon" href="imagenes/logo.ico" type="image/png"> -->
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="css/inicio.css">
</head>

<body class="container" style="background-image: url(textura.png);">
    <div class="container">
        <h2>Repositorio Terciario Urquiza</h2>
        <img src="imagenes/logo.png">   
        <div class="inicio">
            <h3>Registrarse en el sistema</h3>
            <?php
                if (isset($_GET['mensaje'])) {
                    echo '<div id="mensaje" class="alert alert-primary text-center">
                        <p>'.$_GET['mensaje'].'</p></div>';
                }
            ?>

            <form id="formulario" action="create.php" method="post"  class="form">
                <input name="usuario" class="form-control form-control-lg" placeholder="Usuario" required><br>

                <input name="clave" id="password" type="password" class="form-control form-control-lg" placeholder="Contraseña" required><br>
                <label for="clave" >La contraseña debe tener al menos 8 caracteres de los cuales: una mayuscula, una minuscula y un numero.</label>
                <input name="nombre" class="form-control form-control-lg" placeholder="Nombre" required><br>
                <input name="apellido" class="form-control form-control-lg" placeholder="Apellido" required><br>

                <input type="submit" value="Registrarse" class="btn" disabled id="submit">
            </form>   

            <a class="register" href="index.php">Volver al inicio</a>

        </div> 
    </div> 

    <script>

        var upperCase= new RegExp('[A-Z]'); //expresion regular para ver si hay una mayuscula
        var lowerCase= new RegExp('[a-z]'); //expresion regular para ver si hay una minuscula
        var numbers = new RegExp('[0-9]'); //expresion regular para ver si hay almenos un numero
        var minimunChar = new RegExp('[a-zA-Z0-9]{8,}'); //expresion regular para ver si hay minimo de 8 caracteres

        //hago una validacion inicial la campo password, por si el usuario ya tiene pre-cargada una password al momento de entrar a la pag.

        if (jQuery('#password').val().match(upperCase) && jQuery('#password').val().match(lowerCase) && jQuery('#password').val().match(numbers) && jQuery('#password').val().match(minimunChar) ) {
            jQuery('#submit').prop('disabled', false);
        }else{
            jQuery('#submit').prop('disabled', true);
        }

        //voy validando mientras escribo, modifico y salgo del input password si cumple con las condiciones.
        //match es una function definida de jquery para validar expresiones regulares contra un string.
        jQuery('#password').on('input',function(e){
            if (jQuery(this).val().match(upperCase) && jQuery(this).val().match(lowerCase) && jQuery(this).val().match(numbers) && jQuery(this).val().match(minimunChar) ) {
                jQuery('#submit').prop('disabled', false);
            }else{
                jQuery('#submit').prop('disabled', true);
            }
        });

    </script>

</body>
</html>