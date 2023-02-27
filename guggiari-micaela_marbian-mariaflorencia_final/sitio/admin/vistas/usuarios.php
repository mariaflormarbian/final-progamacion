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


        </tr>
        </thead>
        <tbody>

        <?php
        foreach ($usuarios as $usuario):
        ?>
            <tr>


                <td>                                    <?= $usuario->getUsuariosId(); ?>
                </td>
                    <td>                                    <?= $usuario->getNombre(); ?>
                    </td>
                    <td>                                    <?= $usuario->getApellido(); ?>
                    </td>
                    <td>                                    <?= $usuario->getEmail(); ?>
                    </td>


            </tr>
        <?php
        endforeach;
        ?>

        </tbody>
    </table>
</section>