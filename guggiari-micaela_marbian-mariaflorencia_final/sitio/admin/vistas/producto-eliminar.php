<?php

use DaVinci\Modelos\Producto;

$productos = (new Producto())->traerPorId($_GET['id']);
?>
<section class="eliminar-container">
    <h2 class="mb-1">Confirmar Eliminación del producto</h2>

    <dl class="mb-1">

        <dt>Título</dt>
        <dd><?= e($productos->getTitulo()); ?></dd>
        <dt>Precio</dt>
        <dd><?= e($productos->getPrecio()); ?></dd>
        <dt>Texto</dt>
        <dd><?= e($productos->getTexto()); ?></dd>
        <dt>Imagen</dt>
        <dd><img width="500" src="<?= '../imgs/' . e($productos->getImagen()); ?>" alt=""></dd>
        <dt>Descripción de la Imagen</dt>
        <dd><?= e($productos->getImagenDescripcion()); ?></dd>
        <dt>Video</dt>
        <dd><?= e($productos->getVideo()); ?></dd>
        <dt>Audio</dt>
        <dd><?= e($productos->getAudio()); ?></dd>
    </dl>

    <form action="acciones/producto-eliminar.php" method="post">
        <input type="hidden" name="id" value="<?= $productos->getListadoId(); ?>">
        <button type="submit" class=" btn nav-link button-eliminar">Eliminar</button>
    </form>
</section>