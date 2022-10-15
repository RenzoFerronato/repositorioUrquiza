<?php 
  require_once 'clases/RepositorioTrabajo.php';

  $rc = new RepositorioTrabajo();
  
  if ($rc->eliminarTrabajo($_POST['id'])) {
     $respuesta['resultado'] = "OK";
     $respuesta['idtrabajo'] = $_POST['id'];
  }else{
     $respuesta['resultado'] = "Error al realizar la operación";
  }

  echo json_encode($respuesta);
  
?>