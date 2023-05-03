<?php include 'page/header.php' ?>

<?php
    if(!isset($_GET['codigo'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include_once 'model/conexion.php';
    $codigo = $_GET['codigo'];

    $sentencia = $bd->prepare("select * from productos where id = ?;");
    $sentencia->execute([$codigo]);
    $persona = $sentencia->fetch(PDO::FETCH_OBJ);
    //print_r($persona);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Editar datos:
                </div>
                <form class="p-4" method="POST" action="editar.php">
                    <div class="mb-3">
                        <label class="form-label">Nombre Producto: </label>
                        <input type="text" class="form-control" name="txtNombreProducto" required 
                        value="<?php echo $producto->nombreProducto; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">precio Producto: </label>
                        <input type="text" class="form-control" name="txtPrecioProducto" autofocus required
                        value="<?php echo $producto->precioProducto; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cantidad: </label>
                        <input type="text" class="form-control" name="txtCantidad" autofocus required
                        value="<?php echo $producto->cantidad; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripcion: </label>
                        <input type="date" class="form-control" name="txtDescripcion" autofocus required
                        value="<?php echo $producto->descripcion; ?>">
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="codigo" value="<?php echo $persona->id; ?>">
                        <input type="submit" class="btn btn-primary" value="Editar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'page/footer.php' ?>