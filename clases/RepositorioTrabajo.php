<?php
require_once 'Repositorio.php';
require_once 'Trabajo.php';
require_once 'ControladorTrabajo.php';

class RepositorioTrabajo extends Repositorio
{

    public function save(Trabajo $t)
    {
        $targetDir = "archivos/";
        $fileName = basename($_FILES["archivo"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

        $allowTypes = array('pdf');
        if(in_array($fileType, $allowTypes)){
            if(move_uploaded_file($_FILES["archivo"]["tmp_name"], $targetFilePath)){
            }else{
                return false;
            }
        }else{
            return false;
        }

        // bind_param se usa para insertar datos multiples, y bindValue para insertar solo una vez
        $q = "INSERT INTO trabajos (idusuario, nombre, idaño, idmateria, idcarrera, alumnos, archivo) ";
        $q.= "VALUES (?, ?, ?, ?, ?, ?, ?)";
        $query = self::$conexion->prepare($q);
        $query->bind_param("sssssss", $t->getIdUsuario(), $t->getNombre(),
            $t->getIdaño(), $t->getMateria(), $t->getCarrera(), $t->getAlumnos(), $t->getArchivo($fileName));

        if ( $query->execute() ) {
            // Retornamos el id del usuario recién insertado.
            return self::$conexion->insert_id;
        }
        else {
            return false;
        }
    }

    // funcion para traerme los datos de los trabajos y guardarlos en un array
    public function getAllTrabajos($userId){
        $q = 
            "SELECT t.nombre, t.alumnos, t.archivo, m.nombre, c.nombre, a.numeroaño, u.idusuario, t.idtrabajo
            FROM trabajos t
            JOIN materias m ON t.idmateria = m.idmateria
            JOIN carreras c ON t.idcarrera = c.idcarrera
            JOIN usuarios u ON t.idusuario = u.idusuario
            JOIN año a ON t.idaño = a.idaño
            WHERE u.idusuario = ?";
        
        $query = self::$conexion->prepare($q);
        $query->bind_param("i", $userId);
        
        $query->execute();
        $resultado = $query->get_result();
        $arrayTrabajos = [];
        while ($fila = $resultado->fetch_array(MYSQLI_NUM))
        {
            $arrayTrabajos[] = $fila;
        }

        return $arrayTrabajos;
    }

    public function eliminarTrabajo($idtrabajo)
    {
        $q = "DELETE FROM `trabajos` WHERE (`idtrabajo` = ?)";
        $query = self::$conexion->prepare($q);
        $query->bind_param("i", $idtrabajo);

        return $query->execute();
    }
}