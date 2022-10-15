<?php
require_once 'Usuario.php';
require_once 'credenciales.php';
// require_once 'repositorioUsuario.php';

class Repositorio
{
    protected static $conexion = null;

    //FIXME: Extraer funcionalidad común a una superclase.
    public function __construct()
    {
        if (is_null(self::$conexion)) {
            $credenciales = credenciales();
            self::$conexion = new mysqli(
                $credenciales['servidor'],
                $credenciales['usuario'],
                $credenciales['clave'],
                $credenciales['base_de_datos']
            );
            if(self::$conexion->connect_error) {
                $error = 'Error de conexión: '.self::$conexion->connect_error;
                self::$conexion = null;
                die($error);
            }
            self::$conexion->set_charset('utf8');  // para no tener problemas con los acentos, enies, etc
        }
    }

}