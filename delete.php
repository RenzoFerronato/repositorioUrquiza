<?php

require_once 'clases/Repositorio.php';
require_once 'clases/repositorioUsuario.php';
session_start();


if (isset($_POST['id'])) {
    $cu = new RepositorioUsuario();
    $result = $cu->delete($_POST['id']);

    if( $result ) {
        session_destroy();
        $redirigir = 'index.php?mensaje=Usuario eliminado correctamente.';
    }
    else {
        $redirigir = 'micuenta.php?mensaje=Error al eliminar el usuario.';
    }
    header('Location: ' . $redirigir);
}


?>