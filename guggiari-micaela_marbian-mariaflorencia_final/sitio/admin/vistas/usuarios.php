<?php
use DaVinci\Modelos\Usuario;
$usuarios = (new Usuario())->todo();
?>

<section class="container-product">
    <h1 class="mt-5">Usuarios registrados</h1>
    <div class="table-responsive mt-3 p-5 rounded shadow-sm mt-md-3 mb-5">
        <table class=" table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Compras</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($usuarios as $usuario):
                ?>
                <tr>
                    <td><?= $usuario->getUsuariosId(); ?></td>
                    <td><?= $usuario->getNombre(); ?></td>
                    <td><?= $usuario->getApellido(); ?></td>
                    <td><?= $usuario->getEmail(); ?>
                    </td>
                    <td>
                        <a class="link-info text-highlight-color text-decoration-none text-highlight-hover"
                            href="index.php?v=compras&id=<?= $usuario->getUsuariosId(); ?>">Ver compras</a>
                    </td>
                </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
    <a class="nav-link p-2 text-md-end" href="index.php?v=productos">
        <i class="bi bi-arrow-left-circle"></i> Volver al Panel de Administración
    </a>
</section>