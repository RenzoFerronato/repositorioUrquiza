<?php
require_once 'credenciales.php';
require_once 'Repositorio.php';
// require_once 'Usuario.php';
// require_once 'ControladorSesion.php';

class RepositorioCuenta extends Repositorio
{

    // public function miCuenta()
    // {
    //     $q = " SELECT * FROM usuarios " ;
    //     $query = self::$conexion->prepare($q);
    //     $query->bind_param();

    //     return $query->execute();

    //     $query->execute();
    //     $resultado = $query->get_result();
    //     $arrayCuenta = [];
    //     while ($fila = $resultado->fetch_array(MYSQLI_NUM))
    //     {
    //         $arrayCuenta[] = $fila;
    //     }

    //     return $arrayCuenta;
    // }


    public function nombre()
    {
        $q = "SELECT nombre FROM usuarios ";
        $query = self::$conexion->prepare($q);
        $query->execute();
        $resultado = $query->get_result();

        return ' '. $resultado->fetch_array()[0];
    }

    public function apellido()
    {
        $q = "SELECT apellido  FROM usuarios ";
        $query = self::$conexion->prepare($q);
        $query->execute();
        $resultado = $query->get_result();

        return ' '. $resultado->fetch_array()[0];
        // $query = self::$conexion->prepare($q);
        // $query->bind_param("i", $idtrabajo);

        // return $query->execute();
    }

    public function usuario()
    {
        $q = "SELECT usuario  FROM usuarios ";
        $query = self::$conexion->prepare($q);
        $query->execute();
        $resultado = $query->get_result();

        return ' '. $resultado->fetch_array()[0];
    }

    public function password()
    {
        $q = "SELECT clave  FROM usuarios ";
        $query = self::$conexion->prepare($q);
        $query->execute();
        $resultado = $query->get_result();

        return ' '. $resultado->fetch_array()[0];
    }
    
}