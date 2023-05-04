<?php
include("model/conexion.php");
$sentencia = $bd->prepare("DELETE FROM productos");
$resultado = $sentencia->execute([]);
if ($resultado === TRUE){
    header('Location: index.php?mensaje=vaciado');
} else {
    header('Location: index.php?mensaje=error');
}
?>