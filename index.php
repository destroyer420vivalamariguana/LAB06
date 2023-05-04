<?php include 'page/header.php'?>

<?php
    include_once "model/conexion.php";
    $sentencia = $bd -> query("select * from productos");
    $productos = $sentencia->fetchAll(PDO::FETCH_OBJ);
    $sql = "SELECT COUNT(id) as total FROM productos";
    $statement = $bd->prepare($sql);
    $statement->execute();
    $resultado = $statement->fetch(PDO::FETCH_ASSOC);
    $total_registros = $resultado['total'];
    //print_r($persona);
?>

<html>
  <body>
    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- inicio alerta -->
            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Rellena todos los campos.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>


            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Registrado!</strong> Se agregaron los datos.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>   
            
            

            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Vuelve a intentar.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>   



            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Cambiado!</strong> Articulo Actualizado.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?> 


            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado'){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Eliminado!</strong> Los datos fueron borrados.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?> 

            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'vaciado'){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Eliminado!</strong> Carrito Vaciado.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?> 

            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'comprado'){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Eliminado!</strong> Compra realizada.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?> 
            <!-- fin alerta -->
            <div class="card">
                <div class="card-header">
                    Lista de Productos
                </div>
                <div class="p-4">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre Producto</th>
                                <th scope="col">Precio Producto</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php 
                            $orden=0;
                                foreach($productos as $dato){ 
                                    $orden=$orden+1;
                            ?>

                            <tr>
                                <td scope="row"><?php 
                                echo $orden;
                                 ?></td>
                                <td><?php echo $dato->nombreProducto; ?></td>
                                <td><?php echo $dato->precioProducto; ?></td>
                                <td><?php echo $dato->cantidad; ?></td>
                                <td><?php echo $dato->descripcion; ?></td>
                                <td>    
                                <a class="text-success" data-bs-toggle="modal" data-bs-target="#message<?php echo $dato->id;?>"><i class="bi bi-pencil-square"></i>
                                </a>
                                <div class="modal fade" id="message<?php echo $dato->id;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php 
                                                $id = $dato->id;
                                                $sentencia = $bd->prepare("select * from productos where id = ?;");
                                                $sentencia->execute([$id]);
                                                
                                                $producto = $sentencia->fetch(PDO::FETCH_OBJ);
                                                
                                            ?>
                                            <form class="p-4" method="POST" action="editar.php">
                                                <div class="mb-3">
                                                    <label class="form-label">Nombre del Producto: </label>
                                                    <input type="text" class="form-control" name="txtNombres" required 
                                                    value="<?php echo $producto->nombreProducto; ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Precio del Producto: </label>
                                                    <input type="number" class="form-control" name="txtPrecio" required 
                                                    value="<?php echo $producto->precioProducto; ?>">
                                                    
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Cantidad: </label>
                                                    <input type="number" class="form-control" name="txtCantidad" required 
                                                    value="<?php echo $producto->cantidad; ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Descripcion del Producto: </label>
                                                    <input type="text" class="form-control" name="txtDescripcion" required 
                                                    value="<?php echo $producto->descripcion; ?>">
                                                </div>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <div class="d-grid">
                                                <input type="hidden" name="codigo" value="<?php echo $producto->id; ?>">
                                                <input type="submit" class="btn btn-primary" data-bs-dismiss="modal"value="Editar">
                                            </div>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                </td>
                                <td><a class="text-danger" data-bs-toggle="modal" data-bs-target="#message<?php echo $dato->id;?>"><i class="bi bi-trash"></i></a></td>
                                <div class="modal fade" id="message<?php echo $dato->id;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php 
                                                $id = $dato->id;
                                                $sentencia = $bd->prepare("select * from productos where id = ?;");
                                                $sentencia->execute([$id]);
                                                
                                                $producto = $sentencia->fetch(PDO::FETCH_OBJ);
                                                
                                            ?>

                                            <h4>
                                                Estas seguro de que quieres eliminar: <?php echo $producto->nombreProducto." ?"?> 
                                            </h4>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <div class="d-grid">
                                            <a class="btn btn-danger" data-bs-dismiss="modal" onclick="window.location.href='eliminar.php?codigo=<?php echo $id;?>'">Confirmar</a>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>

                            <?php 
                                }
                            ?>

                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Registra el producto:
                </div>
                <form class="p-4" method="POST" action="registrar.php">
                    <div class="mb-3">
                        <label class="form-label">Nombre del Producto: </label>
                        <input type="text" class="form-control" name="txtNombreProducto" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Precio del Producto: </label>
                        <input type="text" class="form-control" name="txtPrecioProducto" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cantidad: </label>
                        <input type="number" class="form-control" name="txtCantidad" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripción: </label>
                        <input type="text" class="form-control" name="txtDescripcion" autofocus required>
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="oculto" value="1">
                        <input type="submit" class="btn btn-primary" value="Registrar Producto">
                    </div>
                </form>
            </div>
        </div>
        <div class="row text-start">
            <div class="col-md-4">
                 <h1>
                    Total a Pagar: <?php 
                    $consulta= $bd -> query("select * from productos");
                    $precios = $consulta->fetchAll(PDO::FETCH_OBJ);
                    $total=0;
                    foreach($precios as $dato){
                        $precio=$dato->precioProducto;
                        $cantidad=$dato->cantidad;
                        $subtotal=$precio*$cantidad;
                        $total=$total+$subtotal;
                    }
                    echo $total
                    ?>    
                </h1>              
            </div>
            <div class="col-md-2">
                <div class="d-grid">
                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#message"> Comprar</a>
                    <div class="modal fade" id="message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Confirmar Compra</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">


                                            <h4>
                                                Confirma compra de: 
                                                <?php 
                                                foreach($productos as $producto){
                                                    echo $producto->nombreProducto. "por " $producto->precio;
                                                }
                                                ?> 
                                            </h4>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <div class="d-grid">
                                            <a class="btn btn-danger" data-bs-dismiss="modal" onclick="window.location.href='eliminar.php?codigo=<?php echo $id;?>'">Confirmar</a>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="d-grid">
                    <a class="btn btn-primary" href="vaciar.php"> Vaciar</a>
                </div>
            </div>
        </div>
    </div>


</div>

<?php include 'page/footer.php'?>
