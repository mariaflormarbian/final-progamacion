<?php
use DaVinci\Modelos\Producto;
use DaVinci\Modelos\Cart;
use DaVinci\Modelos\AddProduct;
use DaVinci\Auth\Autenticacion;

$products_featured = (new Producto)->publicadas();

$carts = (new Cart)->data();
$authedUser = (new Autenticacion)->getId();
$addedProducts = (new AddProduct)->data();


$list = (new AddProduct)->productList($addedProducts, $authedUser);
?>

<section>
    <h2 class="text-center fw-bold mt-5 p-3">Mi carrito</h2>

    <?php if ($addedProducts != []) : ?>
        <div class="table-responsive ">
            <table class="table table-striped table-borderless w-100">
                <tr class="table-dark">
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th></th>
                </tr>
                <?php foreach($addedProducts as $product) : ?>
                    <?php if($product->getCartFk() == $authedUser) : ?>
                        <tr>
                            <td class="p-2"><?= $product->getTitle() ?></td>
                            <td class="p-2">x<?= $product->getQuantity(); ?></td>
                            <td class="p-2">USD$<?= $product->getSubtotal(); ?></td>

                            <td>
                                <form action="actions/delete-from-cart.php" method="POST">
                                    <input type="hidden" name="product_id" value="<?= $product->getAddProductID(); ?>"/>
                                    <button type="submit" class="p-0 m-0 bg-transparent border-0 text-highlight-color text-highlight-hover">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </table>
        </div>
        <?php
        foreach($carts as $i => $cart):
            if($cart->getCartID() == $authedUser):
                ?>
                <div class="bg-light p-4 mb-4">
                    <p class="mb-2 ">Cantidad total de productos: <span class="fw-bold">x<?= $cart->getQuantity(); ?></span></p>
                    <p class="mb-2 ">Total: <span class="fw-bold">USD$<?= $cart->getTotal(); ?></span></p>
                    <form action="actions/empty-cart.php" method="POST" class="">
                        <input type="hidden" name="product_id" value="<?= $cart->getCartID() ?>"/>
                        <button type="submit" class="p-0 m-0 bg-transparent border-0 text-highlight-color text-highlight-hover">Vaciar carrito</button>
                    </form>
                </div>

                <form action="actions/auth-buy.php" method="POST" class="text-end">
                    <input type="hidden" name="products_quantity" value="<?= $cart->getQuantity() ?>"/>
                    <input type="hidden" name="products_total" value="<?= $cart->getTotal() ?>"/>
                    <input type="hidden" name="products" value="<?= $list ?>"/>
                    <button type="submit" class="d-inline-block text-center text-decoration-none p-3 border-0 text-white text-uppercase bg-highlight-color mb-4">Comprar</button>
                </form>
            <?php
            endif;
        endforeach;
        ?>
    <?php else: ?>
        <div>
            <p class="mb-4">Tu carrito está vacío.</p>
            <p class="mb-4">Podés llenarlo <a href="index.php?v=listado" class="text-highlight-color text-highlight-hover">desde acá</a></p>
        </div>
    <?php endif;?>

</section>