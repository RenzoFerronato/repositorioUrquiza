<?php
require_once 'clases/Usuario.php';
require_once 'clases/RepositorioCarreras.php';
require_once 'clases/RepositorioAños.php';
require_once 'clases/RepositorioMaterias.php';
require_once 'clases/RepositorioTrabajo.php';

session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $nomApe = $usuario->getNombreApellido();
    $userId = $usuario->getId();
} else {
    header('Location: index.php');
}

?>

<?php 
  $c = new RepositorioCarreras();
  $carreras = $c->getCarreras();

  $a = new RepositorioAños();
  $años = $a->getAños();

  $m = new RepositorioMaterias();
  $materias = $m->getMaterias();

  $tp = new RepositorioTrabajo();
  $trabajos = $tp->getAllTrabajos($userId);  
 
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
    <title>Inicio</title>
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
            <div class="boton">
                <a class="work" id="open" href="#">¡SUBIR TRABAJO!</a>
            </div>
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
                    <li> <a href="micuenta.php"> Mi Cuenta </a> </li>
                </ul>
            </div>
        </div>
    </header>

    <div class="banner">
        <h3>Repositorio Terciario Urquiza</h3>
        <h3 class="separity"> // </h3>
        <div class="login-usuario">
            <h3>Bienvenido <?php echo $nomApe;?></h3>
            <p><a href="logout.php">Cerrar sesión</a></p>
        </div>
    </div>

    <?php
        if (isset($_GET['mensaje'])) {
            echo '<div id="mensaje"  class="alert alert-primary text-center" <div class="close"> <a href="#" id="close">X</a>
                <p>'.$_GET['mensaje'].'</p></div>';
        }
    ?>
    <div class="works">
        <h2>Repositorio de trabajos //</h2>
    </div>
    <div class="table-contenedor">
        <h2 class="title">Filtrar trabajos</h2>
        <div class="filters">
            <!-- <h2 class="title">Filtrar trabajos:</h2> -->
            <button class="todos active">Todos</button>
            <button class="Practica_profesionalizante_1">Practica profesionalizante 1</button>
            <button class="Practica_profesionalizante_2">Practica profesionalizante 2</button>
            <button class="Infraestructura_de_Tecnología_de_la_Información">Infraestructura de Tecnología de la Información</button>
            <button class="Desarrollo_de_software">Desarrollo de software</button>
            <button class="Análisis_Funcional_de_Sistemas_Informáticos">Análisis Funcional de Sistemas Informáticos</button>
        </div>
        <table class="table table-striped">
            <tr class="table">
                <th>Nombre del proyecto:</th><th>Alumnos:</th><th>Archivo:</th><th>Materia que pertenece:<th>Carrera que pertenece:</th><th>Año:</th><th>Eliminar trabajo</th>
            </tr>
            <?php
            if (count($trabajos) == 0) {
                echo "<tr><td colspan='5'>No tienes trabajos adjuntos</td></tr>";
            } else {
                foreach ($trabajos as $trabajo) {
                    $materia = str_replace(' ', '_', $trabajo[3]);
                    $carrera = str_replace(' ', '_', $trabajo[4]);
                    echo '<tr id="trabajo-'.$trabajo[7].'" class="'.$materia.' '. $carrera.'">';
                    echo "<td>".$trabajo[0]."</td>";
                    echo "<td>".$trabajo[1]."</td>";
                    echo '<td>' . '<a class="archive" href="archivos/'. $trabajo[2]. '" target="_blank"> Ver archivo </a> </td>';
                    echo "<td>".$trabajo[3]."</td>";
                    echo "<td>".$trabajo[4]."</td>";
                    echo "<td>".$trabajo[5]."</td>";
                    // echo "<td>".$trabajo[6]."</td>";
                    echo '<td><button class="btn" onClick="eliminarTrabajo('.$trabajo[7].');">Eliminar</button></td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>
    </div>

    <div id="popup" style="display: none; " class="container-form">
        <div class="close"> <a href="#" id="close-popup">X</a></div>
        <div class="title">
            <h3>¡Subi el proyecto que quieras!</h3>
            <h4>Complete el siguiente formulario para almacenar el trabajo en el Repositorio Urquiza</h4>
        </div>
        <form class="cont" action="createTrabajo.php" method="post" enctype="multipart/form-data">  
            <label> Nombre del proyecto: 
                <input name="nombre" type="text" size="70" maxlength="70">
            </label> <br>
            <label class="especial"> Carrera que pertenece:
                <select name="carrera" size="1" class="carrera">
                <option disabled selected value> -- Seleccionar una opcion -- </option>
                <?php
                    foreach ($carreras as $carrera) {
                        echo '<option value="'.$carrera[0].'">'.$carrera[1].'</option>';
                    }
                ?>
                </select>
            </label>
            <label class="especial"> Materia que pertenece:
                <select name="materia" size="1" class="materia" disabled>
                    <?php
                        foreach ($materias as $materia) {
                            echo '<option value="'.$materia[0].'" carrera='.$materia[3].' año='.$materia[2].'>'.$materia[1].'</option>';
                        }
                    ?>
                </select>
            </label>
            <label class="especial"> Año:
                <select name="año" size="1" class="año">
                    <?php
                        foreach ($años as $año) {
                            echo '<option value="'.$año[0].'">'.$año[1].'</option>';
                        }
                    ?>
                </select>
            </label>
            <label> Alumnos: 
                <input name="alumnos" type="text" size="100" maxlength="250">
            </label>  <br>
            <label> Seleccione su ARCHIVO 
                <input name="archivo"  type="file" size="150" maxlength="150"> 
            </label>  <br>
            <input class="boton" name="submit" type="submit" value="SUBIR ARCHIVO">   
        </form>  
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            // filtros de carrera y materia
            jQuery('.filters button').on( "click", function() {
                jQuery('.filters button').removeClass('active');
                jQuery(this).addClass('active');

                if(jQuery(this).hasClass('todos')){
                    jQuery('.table-striped tr').show();
                }else{
                    filterClass = jQuery(this).attr('class').split(" ")[0];
                    console.log(filterClass);
                    jQuery('.table-striped tr:not(.table)').hide();
                    jQuery('.table-striped tr.'+ filterClass).show()
                }
            });
            // popup de trabajos, abrir y cerrar con FadeIn y FadeOut
            $("#open").on ("click", function() {
                $("#popup").fadeIn("slow");
            });

            $("#close-popup").on ("click", function() {
                $("#popup").fadeOut("slow");
            });

            $("#close").on ("click", function() {
                $("#mensaje").fadeOut("slow");
            });

            // validacion de carrera y materia
            $('select[name="carrera"]').on('change', function() {
                $('select[name="materia"]').prop("disabled", false);

                $('select[name="materia"] option').hide();
                $('select[name="materia"] option[carrera="'+this.value+'"').show();
            });

            // validacion de que si selecciona tal materia, se ponga automatico tal ano.
            $('select[name="materia"]').on('change', function() {
                var element = $(this).find('option:selected'); 
                var materiaAño = element.attr("año"); 
                console.log(materiaAño);
                $('select[name="año"]').val(materiaAño);
            });

        });

        function eliminarTrabajo($idtrabajo) {
            var cadenaDelete = "id="+$idtrabajo;
            var solicitudDelete = new XMLHttpRequest();

            solicitudDelete.onreadystatechange = function() {
            console.log('test1');
                if (this.readyState == 4 && this.status == 200) {
                    var respuesta = JSON.parse(this.responseText);

                    if(respuesta.resultado == "OK") {
                        var identificador = "#trabajo-" + respuesta.idtrabajo;
                        var fila = document.querySelector(identificador);
                        fila.style.display = 'none';
                    } else {
                        alert(respuesta.resultado);
                    }
                }
            };
            solicitudDelete.open("POST", "eliminarTrabajo.php", true);
            solicitudDelete.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            solicitudDelete.send(cadenaDelete);
        }

    </script>

</body>

</html>