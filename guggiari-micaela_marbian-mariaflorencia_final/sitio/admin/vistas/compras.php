<?php
use DaVinci\Modelos\Usuario;
use DaVinci\Modelos\Compra;
$id = $_GET['id'];
$usuario = (new Usuario)->traerPorId($id);
$orders = (new Compra)->getByUsuario($id);
?>

<section class="container-product">
    <h1 class="mb-3">Historial de compras <?= $usuario->getNombre() . ' ' . $usuario->getApellido()?></h1>
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
                        <td><?= $order->getFecha(); ?></td>
                        <td> <?php foreach($order->getProductos() as $item): ?>
                                <li class="mb-2"><?= $item ?></li>
                            <?php endforeach; ?></td>
                        <td><?= $order->getCantidad(); ?></td>
                        <td>$<?= $order->getTotal(); ?></td>
                    </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
</section>