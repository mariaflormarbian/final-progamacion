<?php
use DaVinci\Modelos\Producto;
$productos = (new Producto())->traerPorId($_GET['id']);
?>

<section class="container-product">
    <h2 class="mb-1 text-center">Confirmar Eliminación del producto</h2>
    <dl class="bg-light p-5 rounded  shadow-sm mt-md-5 mb-5">
        <dt>Título</dt>
        <dd><?= e($productos->getTitulo()); ?></dd>
        <dt>Precio</dt>
        <dd><?= e($productos->getPrecio()); ?></dd>
        <dt>Texto</dt>
        <dd><?= e($productos->getTexto()); ?></dd>
        <dt>Imagen</dt>
        <dd><img width="416" src="<?= '../imgs/productos/' . e($productos->getImagen()); ?>" alt=""></dd>
        <dt>Descripción de la Imagen</dt>
        <dd><?= e($productos->getImagenDescripcion()); ?></dd>
        <dt>Video</dt>
        <dd><?= e($productos->getVideo()); ?></dd>
        <dt>Audio</dt>
        <dd><?= e($productos->getAudio()); ?></dd>
    </dl>
    <form action="acciones/producto-eliminar.php" method="post">
        <input type="hidden" name="id" value="<?= $productos->getCatalogoId(); ?>">
        <button type="submit" class=" btn nav-link button-eliminar">Eliminar</button>
    </form>
</section>