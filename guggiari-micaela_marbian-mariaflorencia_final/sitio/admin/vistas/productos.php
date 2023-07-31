<?php
use DaVinci\Modelos\Producto;
$productoPaginado = (new Producto);
$productos = $productoPaginado->todo();
$paginador = $productoPaginado->getPaginador();
?>

<section class="container-product">
    <div class="mt-5 mb-2 d-flex flex-column flex-md-row justify-content-between aling-items-center">
        <h1 class="mb-3 mb-md-0">Administración de Productos</h1>
        <a href="index.php?v=producto-nuevo" class="button btn btn-primary d-flex aling-items-center">Publicar un nuevo
            producto</a>
    </div>
    <div class="table-responsive bg-light p-5 rounded shadow-sm mt-3 mb-5">
        <table class=" table">
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
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($productos as $producto):
                ?>
                <tr>
                    <td><?= $producto->getCatalogoId(); ?></td>
                    <td><span class="text-info bg-white border p-1"><?= $producto->getEstado()->getNombre();?></span>
                    </td>
                    <td><?= e($producto->getTitulo()); ?></td>
                    <td><?= e(substr($producto->getTexto(), 0, 100) . '...'); ?></td>
                    <td> <?= e($producto->getPrecio()); ?></td>
                    <td><img src="<?= "../imgs/productos/" . e($producto->getImagen()); ?>" width="100"
                            alt="<?= e($producto->getImagenDescripcion()); ?>"></td>
                    <td>
                        <iframe width="50" height="30" src="https://www.youtube.com/embed/<?= $producto->getVideo();?>"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </td>
                    <td><?= $producto->getAudio(); ?></td>
                    <td><?= $producto->getStock(); ?></td>
                    <td><?= e($producto->getAutor()->getNombreCompleto());?></td>
                    <td>
                        <a href="index.php?v=producto-editar&id=<?= $producto->getCatalogoId(); ?>"
                            class="button button-small">Editar</a>
                        <a href="index.php?v=producto-eliminar&id=<?= $producto->getCatalogoId(); ?>"
                            class="button button-small text-danger">Eliminar</a>
                    </td>
                </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
    <?php 
    $paginador->setUrlBase('index.php?' . queryStringExcepto(['p']));
    $paginador->generarPaginacion();
    ?>
</section>