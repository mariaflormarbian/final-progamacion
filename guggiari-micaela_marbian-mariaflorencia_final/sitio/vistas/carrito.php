<?php
use DaVinci\Modelos\Producto;
use DaVinci\Modelos\Carrito;
use DaVinci\Modelos\AgregarProducto;
use DaVinci\Auth\Autenticacion;

$productosDestacados = (new Producto)->publicadas();
$carritos = (new Carrito)->data();
$autenticadoUsuario = (new Autenticacion)->getId();
$productosAgregados = (new AgregarProducto)->data();
$catalogo = (new AgregarProducto)->catalogoProductos($productosAgregados, $autenticadoUsuario);
?>

<section class="contenedor-carrito">
    <h2 class="text-center fw-bold mt-5 p-3">Mi carrito</h2>

    <?php if (!empty($productosAgregados)) : ?>
    <div class="table-responsive ">
        <table class="table">
            <tr class="fondo1">
                <th>Producto</th>
                <th>Precio por Unidad</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th></th>
            </tr>
            <?php foreach ($productosAgregados as $producto) : ?>
            <?php if ($producto->getCarritoFk() == $autenticadoUsuario) : ?>
            <tr>
                <td class="p-2"><?= $producto->getTitulo() ?></td>
                <td class="p-2">$<?= $producto->getPrecio() ?></td>
                <td class="p-2 ">

                    <?= $producto->getCantidad() ?>
                </td>
                <td class="p-2">$<?= $producto->getSubtotal(); ?></td>
                <td>
                    <form action="acciones/borrar-item-carrito.php" method="POST">
                        <input type="hidden" name="productos_id" value="<?= $producto->getAgregarProductoID(); ?>" />
                        <button type="submit"
                            class="p-0 m-0 bg-transparent border-0 button button-small text-danger">Eliminar</button>
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
        <p class="mb-2">Cantidad total de productos: <span class="fw-bold"
                id="cantidad-total">x<?= $carrito->getCantidad(); ?></span></p>


        <p class=" mb-2 ">Total: <span class=" fw-bold" id="precio-total">$<?= $carrito->getTotal(); ?></span></p>
        <form action=" acciones/carrito-vacio.php" method="POST" class="">
            <input type="hidden" name="productos_id" value="<?= $carrito->getCarritoID() ?>" />
            <button type="submit" class="p-1 m-0 bg-danger border-0 button button-small text-white">Vaciar
                carrito</button>
        </form>
    </div>

    <form action="acciones/auth-compra.php" method="POST" class="text-end">
        <input type="hidden" name="productos_cantidad" value="<?= $carrito->getCantidad() ?>" />
        <input type="hidden" name="productos_total" value="<?= $carrito->getTotal() ?>" />
        <input type="hidden" name="productos" value="<?= $catalogo ?>" />
        <button type="submit" class="btn btn-primary mb-3 p-3">Comprar</button>
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
<script>
function increment(productId) {
    var inputElement = document.getElementById('cantidad' + productId);
    var currentValue = parseInt(inputElement.value);
    inputElement.value = currentValue + 1;
    actualizarResumenCarrito();
}

function decrement(productId) {
    var inputElement = document.getElementById('cantidad' + productId);
    var currentValue = parseInt(inputElement.value);
    if (currentValue > 1) {
        inputElement.value = currentValue - 1;
        actualizarResumenCarrito();
    }
}

function actualizarResumenCarrito() {
    var cantidadTotal = 0;
    var precioTotal = 0;

    var productos = document.querySelectorAll('[data-carrito-id]');
    productos.forEach(function(producto) {
        var carritoId = producto.getAttribute('data-carrito-id');
        var cantidad = parseInt(producto.value);

        cantidadTotal += cantidad;
        var precio = parseFloat(producto.closest('form').querySelector('[name="productos_precio"]').value);
        precioTotal += cantidad * precio;
    });

    var cantidadTotalElement = document.getElementById('cantidad-total');
    cantidadTotalElement.innerText = 'x' + cantidadTotal;

    var precioTotalElement = document.getElementById('precio-total');
    precioTotalElement.innerText = '$' + precioTotal.toFixed(2);
}
</script>