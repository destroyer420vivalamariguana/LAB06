<?php
    include 'model/conexion.php';
    $codigo = $_POST['codigo'];
    $nombres = $_POST['txtNombres'];
    $precio = $_POST['txtPrecio'];
    $cantidad = $_POST['txtCantidad'];
    $descripcion = $_POST['txtDescripcion'];

    $sentencia = $bd->prepare("UPDATE productos SET nombreProducto = ?, precioProducto = ?, cantidad = ?,descripcion = ? where id = ?;");
    $resultado = $sentencia->execute([$nombres, $precio, $cantidad, $descripcion, $codigo]);

    if ($resultado === TRUE) {
        header('Location: index.php?mensaje=editado');
    } else {
        header('Location: index.php?mensaje=error');
        exit();
    }
?>