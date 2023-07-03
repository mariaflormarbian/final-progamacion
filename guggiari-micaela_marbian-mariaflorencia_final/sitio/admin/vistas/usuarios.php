<?php
use DaVinci\Modelos\Usuario;
$usuarios = (new Usuario())->todo();
?>

<section class="container-product">
    <h2 class="mt-4 mb-4 text-center">Usuarios registrados</h2>
    <div class="table-responsive mb-5 mt-5 bg-light">
        <table class="table">
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
</section>