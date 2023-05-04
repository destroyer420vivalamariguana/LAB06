<?php

if(!isset($_GET['codigo'])){
    header('Location: index.php?mensaje=error');
    exit();
}
include 'model/conexion.php';
$codigo = $_GET['codigo'];
$consulta = $bd->query('SELECT * FROM articulos WHERE id_articulo='.$codigo.';');
if (!$consulta) {
    header('Location: index.php?mensaje=error');
  }
  while ($articuloSeleccionado = $consulta->fetch()) {
    $insercion=$bd->prepare('INSERT INTO productos(id_item,nombreProducto,precioProducto,cantidad,descripcion) VALUES (?,?,?,?,?) ON DUPLICATE KEY UPDATE cantidad = cantidad + 1;');
    $resultado=$insercion->execute([$articuloSeleccionado["id_articulo"],$articuloSeleccionado["nombre"],$articuloSeleccionado["precio"],1,$articuloSeleccionado["url_image"]]);
    if ($resultado === TRUE){
        header('Location: index.php?mensaje=registrado');
    }
    else {
        header('Location: index.php?mensaje=error');
    }
}

?>