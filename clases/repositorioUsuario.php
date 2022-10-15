<?php
require_once 'Repositorio.php';
require_once 'Usuario.php';
require_once 'ControladorSesion.php';

class RepositorioUsuario extends Repositorio
{

    public function login($nombre_usuario, $clave) // creado en controlador sesion (metodo = function login)
    {
        $q = " SELECT idusuario, clave, nombre, apellido FROM usuarios "; // controlar en la BDD la tabla usuarios (profesores dsp) como se llaman las columnas
        $q.= "WHERE usuario = ?"; // parametro, ojo que aca va algo, todavia no sabemos que (en este caso renzoferro)
        $query = self::$conexion->prepare($q);  // me prepara la consulta a la base de datos (metodo prepare)
        $query->bind_param("s", $nombre_usuario); // la s es porque es solamente una cadena (nombre_usuario)
        if ( $query->execute() ) { //metodo para ejecutar la query
            $query->bind_result($idUsuario, $clave_encriptada, $nombre, $apellido); //el resultado lo quiero en 4 variables
            if ( $query->fetch() ) { 
                if( password_verify($clave, $clave_encriptada) === true) { // funcion que recibe las dos claves y verifica que este correcto
                    return new Usuario($nombre_usuario, $nombre, $apellido, $idUsuario); // si esta todo ok crea el nuevo usuario
                }
            }
        }
        return false;
    }

    public function save(Usuario $u, $clave)
    {
        $q = "INSERT INTO usuarios (usuario, nombre, apellido, clave) ";
        $q.= "VALUES (?, ?, ?, ?)";
        $query = self::$conexion->prepare($q);
        $query->bind_param("ssss", $u->getUsuario(), $u->getNombre(),
            $u->getApellido(), password_hash($clave, PASSWORD_DEFAULT));

        if ( $query->execute() ) {
            // Retornamos el id del usuario recién insertado.
            return self::$conexion->insert_id;
        }
        else {
            return false;
        }
    }

    public function actualizar(Usuario $usu, $clave)
    {
        $q = "UPDATE INTO usuarios (usuario, nombre, apellido, clave) ";
        $q.= "VALUES (?, ?, ?, ?)";
        $query = self::$conexion->prepare($q);
        $query->bind_param("ssss", $u->getUsuario(), $u->getNombre(),
            $u->getApellido(), password_hash($clave, PASSWORD_DEFAULT));

        if ( $query->execute() ) {
            // Retornamos el id del usuario recién insertado.
            return self::$conexion->insert_id;
        }
        else {
            return false;
        }
    }

    public function delete($idUsuario){

        //primero debo borrar los trabajos asociados a ese usuario por la foregein key.
        $t = "DELETE FROM `trabajos` WHERE (`idusuario` = ?)";
        $tQuery = self::$conexion->prepare($t);
        $tQuery->bind_param("i", $idUsuario);
        $tQuery->execute();


        $q = "DELETE FROM `usuarios` WHERE (`idusuario` = ?)";
        $query = self::$conexion->prepare($q);
        $query->bind_param("i", $idUsuario);

        return $query->execute();
    }
}