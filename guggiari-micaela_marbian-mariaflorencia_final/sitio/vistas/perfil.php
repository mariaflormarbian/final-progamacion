<?php
use DaVinci\Auth\Autenticacion;
use DaVinci\Modelos\Compra;

$autenticacion = new Autenticacion();
$usuario = $autenticacion->getUsuario();
$id = (new Autenticacion())->getId();
$orders = (new Compra)->getByUser($id);

$admin = (new Autenticacion)->esAdmin();

?>
<section>
    <h1 class="text-center fw-bold mt-5 mb-md-4 p-3">Mi perfil</h1>
    <div class="row justify-content-center p-3">
        <div class=" bg-light rounded text-center shadow-sm mt-md-5 mb-5 mi-perfil">
            <h2 class="text-title mb-4 fs-4">Datos</h2>
            <div class="d-flex flex-column  align-items-center gap-2 w-100">
                <div class="mb-3">
                    <p class="m-0 text-title">Usuario</p>
                    <p class="m-0"> <?= $autenticacion->getUsuario()->getNombreCompleto(); ?> </p>
                </div>
                <div class="mb-3">
                    <p class="m-0 text-title">Email</p>
                    <p class="m-0"> <?= $autenticacion->getUsuario()->getEmail(); ?> </p>
                </div>
                <?php
                if($autenticacion->estaAutenticado() && $autenticacion->esAdmin()):
                    ?>
                    <a class="btn btn-primary w-50" href="admin/index.php?v=productos">Panel de administración</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
    if($autenticacion->estaAutenticado() && !$autenticacion->esAdmin()):
    ?>
        <?php foreach($orders as $i =>$order): ?>
            <article class="border p-4 d-flex justify-content-between align-items-center mb-4">
                <span><i class="fa-solid fa-bag-shopping"></i></span>
                <div class="flex-grow-1 ps-4">
                    <div class="d-flex justify-content-between mb-4">
                        <h2 class="mb-0 text-title fs-5">Compra <?= $i + 1 ?></h2>
                        <p class="m-0 mini-text"><?= $order->getDate(); ?></p>
                    </div>
                    <ul class="p-0 m-0 list-unstyled mb-4">
                        <?php foreach($order->getProducts() as $item): ?>
                            <li class="mb-2"><?= $item ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="d-flex justify-content-between">
                        <p class="m-0">Cantidad total de productos: <span class="fw-bold"> x<?= $order->getQuantity(); ?></span></p>
                        <p class="m-0">Total: <span class="fw-bold"> $<?= $order->getTotal(); ?></span></p>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
    <?php
    endif;
    ?>
</section>
