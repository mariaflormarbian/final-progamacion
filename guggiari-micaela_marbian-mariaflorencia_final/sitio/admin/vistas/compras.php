<?php
use DaVinci\Modelos\Usuario;
use DaVinci\Modelos\Compra;
$id = $_GET['id'];
$user = (new Usuario)->traerPorId($id);
$orders = (new Compra)->getByUser($id);
?>

<section class="container-product">
    <h1 class="mb-3">Historial de compras <?= $user->getNombre() . ' ' . $user->getApellido()?></h1>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Compra</th>
                <th>Fecha</th>
                <th>Productos</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach($orders as $i => $order): ?>

                <tr>
                    <td> <?= $i + 1 ?></td>
                    <td><?= $order->getDate(); ?></td>
                    <td> <?php foreach($order->getProducts() as $item): ?>
                            <li class="mb-2"><?= $item ?></li>
                        <?php endforeach; ?></td>
                    <td><?= $order->getQuantity(); ?></td>
                    <td>$<?= $order->getTotal(); ?></td>


                </tr>
            <?php
            endforeach;
            ?>

            </tbody>
        </table>
    </div>
</section>