<?php
    print_r($_POST);
    if(!isset($_POST['codigo'])){
        header('Location: index.php?mensaje=error');
    }

    include 'model/conexion.php';
    $codigo = $_POST['codigo'];
    $nombreProducto = $_POST['txtNombreProducto'];
    $precioProducto = $_POST['txtPrecioProducto'];
    $cantidad = $_POST['txtCantidad'];
    $descripcion = $_POST['txtDescripcion'];

    $sentencia = $bd->prepare("UPDATE productos SET nombreProducto = ?, precioProducto = ?, cantidad = ?, descripcion = ? where id = ?;");
    $resultado = $sentencia->execute([$nombreProducto, $precioProducto, $cantidad, $descripcion,$codigo]);

    if ($resultado === TRUE) {
        header('Location: index.php?mensaje=editado');
    } else {
        header('Location: index.php?mensaje=error');
        exit();
    }
