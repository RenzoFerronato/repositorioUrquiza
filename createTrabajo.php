<?php
require_once 'clases/ControladorTrabajo.php';

session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $idUsuario = $usuario->getId();
}

if (
    isset($_POST['nombre'])
) {
    $cs = new ControladorTrabajo();
    $result = $cs->create($idUsuario, $_POST['nombre'], 
                          $_POST['año'], $_POST['materia'], $_POST['carrera'], $_POST['alumnos'], $_POST['archivo']);

    if( $result[0] === true ) {
        $redirigir = 'home.php?mensaje='.$result[1];
    }
    else {
        $redirigir = 'home.php?mensaje='.$result[1];
    }
    header('Location: ' . $redirigir);
}
?>