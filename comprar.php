<?php
include("model/conexion.php");
$sentencia = $bd->prepare("DELETE FROM productos");
$resultado = $sentencia->execute([]);
if ($resultado === TRUE){
    header('Location: index.php?mensaje=comprado');
} else {
    header('Location: index.php?mensaje=comprado');
}
?>