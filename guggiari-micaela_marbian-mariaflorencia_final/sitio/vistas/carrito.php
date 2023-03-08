<?php
use DaVinci\Modelos\Producto;
use DaVinci\Modelos\Carrito;
use DaVinci\Modelos\AgregarProducto;
use DaVinci\Auth\Autenticacion;

$productosDestacados= (new Producto)->publicadas();
$carritos = (new Carrito)->data();
$autenticadoUsuario = (new Autenticacion)->getId();
$productosAgregados = (new AgregarProducto)->data();
$list = (new AgregarProducto)->productList($productosAgregados, $autenticadoUsuario);
?>

<section class="contenedor-carrito">
    <h2 class="text-center fw-bold mt-5 p-3">Mi carrito</h2>

    <?php if ($productosAgregados != []) : ?>
        <div class="table-responsive ">
            <table class="table">
                <tr class="fondo1">
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th></th>
                </tr>
                <?php foreach($productosAgregados as $producto) : ?>
                    <?php if($product->getCarritoFk() == $autenticadoUsuario) : ?>
                        <tr>
                            <td class="p-2"><?= $product->getTitulo() ?></td>
                            <td class="p-2">x<?= $product->getCantidad(); ?></td>
                            <td class="p-2">$<?= $product->getSubtotal(); ?></td>
                            <td>
                                <form action="acciones/borrar-item-carrito.php" method="POST">
                                    <input type="hidden" name="productos_id" value="<?= $product->getAgregarProductoID(); ?>"/>
                                    <button type="submit" class="p-0 m-0 bg-transparent border-0 button button-small text-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </table>
        </div>
        <?php
        foreach($carritos as $i => $carrito):
            if($carrito->getCarritoID() == $autenticadoUsuario):
                ?>
                <div class=" d-flex flex-column align-items-end pb-4">
                    <p class="mb-2">Cantidad total de productos: <span class="fw-bold">x<?= $carrito->getCantidad(); ?></span></p>
                    <p class="mb-2 ">Total: <span class="fw-bold">$<?= $carrito->getTotal(); ?></span></p>
                    <form action="acciones/carrito-vacio.php" method="POST" class="">
                        <input type="hidden" name="productos_id" value="<?= $carrito->getCarritoID() ?>"/>
                        <button type="submit" class="p-3 m-0 bg-danger border-0 button button-small text-white">Vaciar carrito</button>
                    </form>
                </div>

                <form action="acciones/auth-compra.php" method="POST" class="text-end">
                    <input type="hidden" name="productos_cantidad" value="<?= $carrito->getCantidad() ?>"/>
                    <input type="hidden" name="productos_total" value="<?= $carrito->getTotal() ?>"/>
                    <input type="hidden" name="productos" value="<?= $list ?>"/>
                    <button type="submit" class="btn btn-primary mb-3">Comprar</button>
                </form>
            <?php
            endif;
        endforeach;
        ?>
    <?php else: ?>
        <div class="text-center carrito-vacio">
            <p class="mb-4">Tu carrito está vacío</p>
            <p class="mb-4">¿No sabés qué comprar? ¡Miles de productos te esperan!</p>
            <a href="index.php?v=catalogo" class="btn fs-5">Conocer productos</a></p>
        </div>
    <?php endif;?>
</section>