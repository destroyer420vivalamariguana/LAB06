<?php
//print_r($_POST);
    if (empty($_POST["oculto"]) || empty($_POST["txtNombreProducto"]) || empty($_POST["txtPrecioProducto"]) || empty($_POST["txtCantidad"]) || empty($_POST["txtDescripcion"])) {
        header('Location: index.php?mensaje=falta');
        exit();
    }

    include_once 'model/conexion.php';
    $nombreProducto = $_POST["txtNombreProducto"];
    $precioProducto = $_POST["txtPrecioProducto"];
    $cantidad = $_POST["txtCantidad"];
    $descripcion = $_POST["txtDescripcion"];

    $sentencia = $bd->prepare("INSERT INTO productos(nombreProducto,precioProducto,cantidad,descripcion) VALUES (?,?,?,?);");
    $resultado = $sentencia->execute([$nombreProducto, $precioProducto, $cantidad, $descripcion]);

    if ($resultado === TRUE) {
        header('Location: index.php?mensaje=producto registrado');
    } else {
        header('Location: index.php?mensaje=error');
        exit();
    }
?>