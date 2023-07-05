<?php
use DaVinci\Modelos\Producto;
$productos = (new Producto())->traerPorId($_GET['id']);
?>

<section class="container-product">
    <h1 class="mb-1 text-center mt-5 mb-3 color-eliminacion">Confirmar Eliminación del producto</h1>
    <dl class="bg-light p-5 rounded shadow-sm">
        <dt>Título</dt>
        <dd><?= e($productos->getTitulo()); ?></dd>
        <dt>Precio</dt>
        <dd><?= e($productos->getPrecio()); ?></dd>
        <dt>Texto</dt>
        <dd><?= e($productos->getTexto()); ?></dd>
        <dt>Imagen</dt>
        <dd><img class="img-fluid" width="416" src="<?= '../imgs/productos/' . e($productos->getImagen()); ?>" alt=""></dd>
        <dt>Descripción de la Imagen</dt>
        <dd><?= e($productos->getImagenDescripcion()); ?></dd>
        <dt>Video</dt>
        <dd><?= e($productos->getVideo()); ?></dd>
        <dt>Audio</dt>
        <dd><?= e($productos->getAudio()); ?></dd>
    </dl>
    <div class="d-flex flex-column align-items-center">
            <form action="acciones/producto-eliminar.php" method="post">
                <input type="hidden" name="id" value="<?= $productos->getCatalogoId(); ?>">
                <button type="submit" class="btn button-eliminar">Eliminar</button>
            </form>
            <a class="nav-link p-2 mt-2" href="index.php?v=productos">
                <i class="bi bi-arrow-left-circle"></i> Volver al Panel de Administración
            </a>
        </div>
</section>