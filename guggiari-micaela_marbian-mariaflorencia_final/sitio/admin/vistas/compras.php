<?php
use DaVinci\Modelos\Usuario;
use DaVinci\Modelos\Compra;
$id = $_GET['id'];
$usuario = (new Usuario)->traerPorId($id);
$orders = (new Compra)->getByUsuario($id);
?>

<section class="container-product">
    <h1 class="mb-1 text-center">Historial de compras <?= $usuario->getNombre() . ' ' . $usuario->getApellido()?></h1>
    <div class="table-responsivebg-light p-5 rounded shadow-sm mt-md-5 mb-5">
        <table class=" table">
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
                        <?= $item ?>
                        <?php endforeach; ?>
                    </td>
                    <td><?= $order->getCantidad(); ?></td>
                    <td>$<?= $order->getTotal(); ?></td>
                </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
    <a class="nav-link p-2 text-md-end" href="index.php?v=usuarios">
        <i class="bi bi-arrow-left-circle"></i> Volver al Panel de Administración
    </a>
</section>