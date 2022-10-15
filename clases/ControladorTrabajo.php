<?php
require_once 'Trabajo.php';
require_once 'RepositorioTrabajo.php';

class ControladorTrabajo
{
    protected $trabajo = null;

    public function create($idusuario, $nombre, $idaño, $idmateria, $idcarrera, $alumnos, $archivo, $idtrabajo = null)
    {
        $repo = new RepositorioTrabajo();
        $trabajo = new Trabajo($idusuario, $nombre, $idaño, $idmateria, $idcarrera, $alumnos, $archivo, $idtrabajo);
        $id = $repo->save($trabajo);
        if ($id === false) {
            return [ false, "Error al guardar el trabajo"];
        }
        else {
            $trabajo->setIdtrabajo($id);
            return [ true, "Trabajo guardado correctamente" ];
        }
    }
}
