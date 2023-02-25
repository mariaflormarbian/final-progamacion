<?php
use DaVinci\Auth\Autenticacion;

$autenticacion = new Autenticacion();
$usuario = $autenticacion->getUsuario();

$admin = (new Autenticacion)->esAdmin();

?>
<section>
    <h1 class="text-center fw-bold mt-5 p-3">Mi perfil</h1>
    <div class="row">
        <div class="col-12 col-md-4 bg-light p-4 rounded py-5 text-center shadow-sm mb-4">
            <h2 class="text-title mb-4 fs-4">Datos</h2>
            <div class="d-flex flex-column gap-2 w-100">
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
                    <a class="btn btn-primary" href="admin/index.php?v=productos">Panel de administración</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
