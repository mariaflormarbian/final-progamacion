<?php
use DaVinci\Modelos\Producto;
$productos = (new Producto())->todo();
?>

<section class="container-product">
    <h1 class="mb-1 text-center">Administración de Productos</h1>

    <div class="mt-1 mb-1 d-flex justify-content-center">
        <a href="index.php?v=producto-nuevo" class="btn btn-primary">Publicar un nuevo producto</a>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Estado</th>
                    <th>Título</th>
                    <th>Texto</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Video</th>
                    <th>Audio</th>
                    <th>Stock</th>
                    <th>Subido por</th>
                    <th>Edición</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($productos as $producto):
                ?>
                    <tr>
                        <td><?= $producto->getCatalogoId(); ?></td>
                        <td><span class="text-info bg-white border p-1"><?= $producto->getEstado()->getNombre();?></span></td>
                        <td><?= e($producto->getTitulo()); ?></td>
                        <td><?= e($producto->getTexto()); ?></td>
                        <td> <?= e($producto->getPrecio()); ?></td>
                        <td><img src="<?= "../imgs/productos/" . e($producto->getImagen()); ?>" width="50" alt="<?= e($producto->getImagenDescripcion()); ?>"></td>
                        <td> <iframe width="200" height="100" src="https://www.youtube.com/embed/<?= $producto->getVideo();?>"
                                      frameborder="0"
                                     allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                     allowfullscreen>
                            </iframe></td>
                        <td><?= $producto->getAudio(); ?></td>
                        <td><?= $producto->getStock(); ?></td>
                        <td><?= e($producto->getAutor()->getNombreCompleto());?></td>
                        <td>
                            <a href="index.php?v=producto-editar&id=<?= $producto->getCatalogoId(); ?>" class="button button-small">Editar</a>
                            <a href="index.php?v=producto-eliminar&id=<?= $producto->getCatalogoId(); ?>" class="button button-small text-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
</section>