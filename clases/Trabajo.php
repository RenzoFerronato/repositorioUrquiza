<?php
class Trabajo
{
    protected $idtrabajo;
    protected $idusuario;
    protected $nombre;
    protected $idaño;
    protected $idmateria;
    protected $idcarrera;
    protected $alumnos;
    protected $archivo;

    public function __construct($idusuario, $nombre, $idaño, $idmateria, $idcarrera, $alumnos, $archivo, $idtrabajo)
    {
        $this->idusuario = $idusuario;
        $this->nombre = $nombre;
        $this->idaño = $idaño;
        $this->idmateria = $idmateria;
        $this->idcarrera = $idcarrera;
        $this->alumnos = $alumnos;
        $this->archivo = $archivo;
        $this->idtrabajo = $idtrabajo;
    }

    public function getIdtrabajo() {return $this->id;}
    public function setIdtrabajo($id) {$this->id = $id;}
    public function getIdUsuario() {return $this->idusuario;}
    public function getNombre() {return $this->nombre;}
    public function getIdaño() {return $this->idaño;}
    public function getMateria() {return "$this->idmateria";}
    public function getCarrera() {return "$this->idcarrera";}
    public function getAlumnos() {return "$this->alumnos";}
    public function getArchivo($file) {
        return $file;
    }
}