<?php
require_once 'clases/Usuario.php';
require_once 'clases/repositoriocuenta.php';

session_start();
    if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $userId = $usuario->getId();
    } else {
    header('Location: index.php');
}

if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $nomApe = $usuario->getNombreApellido();
    $userId = $usuario->getId();
    } else {
    header('Location: index.php');
}
?>

<?php
$c = new RepositorioCuenta();
// $cuentas = $c->miCuenta(); 
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
    <title>Mi cuenta</title>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- <link rel="icon" href="imagenes/logo.ico" type="image/png"> -->
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header>
        <div class="contenedor">
            <a href="#"><img src="imagenes/logo.png"></a>
            <div class="items">
                <a href="home.php">Trabajos</a>
                <a href="#">Busqueda</a>
                <a href="micuenta.php">Mi Cuenta</a>
            </div>
            <!-- <button class="work"> SUBIR TRABAJO</button> -->
            <!-- <div class="boton">
                <a class="work" id="open" href="#">¡SUBIR TRABAJO!</a>
            </div> -->
        </div>

        <div class="mobile">
            <a href="#"><img src="imagenes/logo.png"></a>

            <div class="icono-menu">
                <img src="hamburguer.png" id="icono-menu">
            </div>

            <div class="cont-menu active" id="menu">
                <a href="#"><img src="logo-blanco.svg"></a>
                <ul>
                    <li>Inicio</li>
                    <li>Opciones</li>
                    <li>Mi Cuenta</li>
                </ul>
            </div>
        </div>
    </header>

    <div class="banner">
        <h3>Repositorio Terciario Urquiza</h3>
        <h3 class="separity"> // </h3>
        <div class="login-usuario">
            <h3>Hola <?php echo $nomApe;?></h3>
            <p><a href="logout.php">Cerrar sesión</a></p>
        </div>
    </div>

    <?php
        if (isset($_GET['mensaje'])) {
            echo '<div id="mensaje"  class="alert alert-primary text-center" <div class="close"> <a href="#" id="close">X</a>
                <p>'.$_GET['mensaje'].'</p></div>';
        }
    ?>

    <div class="conteiner">
        <div class="title">
            <h2>¡Bienvenido a tu cuenta!</h2>
            <h3>Edite los datos de tu cuenta y presiona en guardar cambios</h3>
        </div>
                
        <form action="actualizar.php" method="post" class="boton">
            <div class="cont">
                <label for="#"> Usuario: </label>
                <input name="usuario" class="form-control form-control-lg" placeholder=""><br>
            </div>
            <div class="cont">
                <label for="#"> Contraseña: </label>
                <input name="clave" type="password" class="form-control form-control-lg" placeholder=""><br>
            </div>
            <div class="cont">
                <label for="#"> Nombre </label>
                <input name="nombre" type="text" class="form-control form-control-lg" placeholder=""><br>
            </div>
            <div class="cont">
                <label for="#"> Apellido </label>
                <input name="apellido" type="text" class="form-control form-control-lg" placeholder=""><br>
            </div>
            <input type="submit" value="Guardar cambios" class="btn">
        </form>

    </div>

    <div class="delete">
        <h3>Desear eliminar tu cuenta?</h3>
        <a id="open-delete" >Eliminar cuenta</a>
    </div>

    <div id="ventana" style="display: none; " class="alert-delete">
        <div class="title">
            <h3>¿Queres eliminar tu cuenta definitivamente?</h3>
            <h4>¡Advertencia! ¡Perderas tus trabajos guardados!</h4>
            <div class="cont">
                <form action="delete.php" method="post">
                    <input type="text" name="id" value="<?php echo $userId; ?>" style="display: none;">
                    <input type="submit" class="eliminar" value='Si, Eliminar'>
                </form>
                <div class="close"> <a href="#" href="delete.php" id="close-delete">Cancelar</a></div>
            </div>
        </div>
    </div>

</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        $("#open-delete").on ("click", function() {
            $("#ventana").fadeIn("slow");
        });

        $("#close-delete").on ("click", function() {
            $("#ventana").fadeOut("slow");
        });
        $("#close").on ("click", function() {
            $("#mensaje").fadeOut("slow");
        });


    });

</script>

</body>
</html>