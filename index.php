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
    <title>Inicio</title>
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
            <h3>Ingresar al sistema</h3>
            <?php
                if (isset($_GET['mensaje'])) {
                    echo '<div id="mensaje" class="alert alert-primary text-center">
                        <p>'.$_GET['mensaje'].'</p></div>';
                }
            ?>

            <form action="login.php" method="post" class="boton">
                <input name="usuario" class="form-control form-control-lg" placeholder="Usuario"><br>
                <input name="clave" type="password" class="form-control form-control-lg" placeholder="Contraseña"><br>
                <input type="submit" value="Ingresar" class="btn">
            </form>
            <a class="forgot" href="forgotPassword.php">¿Has olvidado la contraseña?</a> <br>
            <a class="register" href="create.php">Registrarse</a>
        </div> 
    </div> 

</body>
</html>