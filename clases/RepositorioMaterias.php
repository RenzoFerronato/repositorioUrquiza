<?php
require_once 'Repositorio.php';
require_once 'ControladorSesion.php';

class RepositorioMaterias extends Repositorio
{

    public function getMaterias()
    {
        $q = "SELECT * FROM materias;";
        $query = self::$conexion->prepare($q);

        $query->execute();
        $resultado = $query->get_result();
        $arrayMaterias = [];
        while ($fila = $resultado->fetch_array(MYSQLI_NUM))
        {
            $arrayMaterias[] = $fila;
        }

        return $arrayMaterias;
    }

}