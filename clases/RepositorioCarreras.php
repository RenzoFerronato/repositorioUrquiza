<?php
require_once 'Repositorio.php';
require_once 'ControladorSesion.php';

class RepositorioCarreras extends Repositorio
{

    public function getCarreras()
    {
        $q = "SELECT * FROM carreras;";
        $query = self::$conexion->prepare($q);

        $query->execute();
        $resultado = $query->get_result();
        $arrayCarreras = [];
        while ($fila = $resultado->fetch_array(MYSQLI_NUM))
        {
            $arrayCarreras[] = $fila;
        }

        return $arrayCarreras;
    }

}