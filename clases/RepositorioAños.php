<?php
require_once 'Repositorio.php';
require_once 'ControladorSesion.php';

class RepositorioAños extends Repositorio
{

    public function getAños()
    {
        $q = "SELECT * FROM año;";
        $query = self::$conexion->prepare($q);

        $query->execute();
        $resultado = $query->get_result();
        $arrayAños = [];
        while ($fila = $resultado->fetch_array(MYSQLI_NUM))
        {
            $arrayAños[] = $fila;
        }

        return $arrayAños;
    }

}