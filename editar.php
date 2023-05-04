<?php
    include 'model/conexion.php';
    $codigo = $_POST['codigo'];
    $cantidad = $_POST['txtCantidad'];
    $nombre = $_POST['txtNombre'];

    $sentenciaItemParaCambiar=$bd->query("SELECT * FROM articulos where nombre='$nombre'");
    if (!$sentenciaItemParaCambiar) {
        header('Location: index.php?mensaje=error');
      }
      while($articuloAcambiar=$sentenciaItemParaCambiar->fetch()){
        $sentencia = $bd->prepare("UPDATE productos SET id_item=?,nombreProducto = ?, precioProducto = ?, cantidad = ?,descripcion = ? where id= ?;");
        $resultado = $sentencia->execute([$articuloAcambiar["id_articulo"],$articuloAcambiar["nombre"], $articuloAcambiar["precio"], $cantidad, $articuloAcambiar["url_image"],$codigo]);
    
        if ($resultado === TRUE) {
            header('Location: index.php?mensaje=editado');
        } else {
            header('Location: index.php?mensaje=error');
            exit();
        }
      }

?>