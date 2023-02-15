<?php

use DaVinci\Modelos\Producto;

$productos = (new Producto())->publicadas();

?>

<section class="container">
    <h2 class="text-center fw-bold mt-5 p-3">Nuestros Productos</h2>

    <ul class="row contenedor-lista">
        <?php
            foreach($productos as $producto):
        ?>

        <li class="card col-6 producto">
            <div class="mx-auto">
                <picture>
                    <img class="img-fluid" width="400" src="imgs/<?= $producto->getImagen();?>"
                        alt="<?= $producto->getImagenDescripcion();?>">
                </picture>
                <div class="audio">
                    <audio controls>
                        <source src="./audio/<?= $producto->getAudio();?>" type="audio/mpeg">
                    </audio>
                </div>
                <div>
                    <span class="visually-hidden">Etiquetas asociadas a esta noticia:</span>
                    <ul class="list-unstyled">
                        <?php
                        foreach($producto->getEtiquetas() as $etiqueta):
                        ?>
                        <li>
                            <span class="badge bg-primary">
                                <?= $etiqueta->getNombre();?>
                            </span>
                        </li>
                        <?php
                        endforeach;
                        ?>
                    </ul>
                </div>
                <div class="card-body text-center">

                    <h3 class="card-title"><?= $producto->getTitulo();?></h3>
                    <p class="card-text">$<?= $producto->getPrecio();?></p>
                    <a class="btn btn-primary" href="index.php?v=detalle&id=<?= $producto->getListadoId();?>">Ver
                        detalle</a>
                </div>

            </div>

        </li>

        <?php
        endforeach;
        ?>
    </ul>
</section>

