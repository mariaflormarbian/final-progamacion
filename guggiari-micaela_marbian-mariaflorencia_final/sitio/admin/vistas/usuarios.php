<?php

use DaVinci\Modelos\Usuario;

$usuarios = (new Usuario())->todo();
?>
<section class="container container-product">
    <h2 class="mb-1">Usuarios registrados</h2>

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
                    <td><?= $usuario->getEmail(); ?></td>

                <td><a href="index.php?v=compras&id=<?= $usuario->getUsuariosId(); ?>" class="text-highlight-color text-decoration-none text-highlight-hover">Ver compras</a></td>           </tr>
        <?php
        endforeach;
        ?>

        </tbody>
    </table>
</section>