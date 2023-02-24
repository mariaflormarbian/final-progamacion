<?php

use DaVinci\Modelos\Producto;

$producto =(new Producto())->traerPorId($_GET['id']);
$producto->cargarEtiquetas();
?>

<section class="container seccion-detalle">
    <h1 class="text-center  fw-bold p-3  my-5">Detalles</h1>
    <form action="acciones/add-to-cart.php" method="POST" class="w-100">

    <div class="row align-items-lg-center container-detalle">

        <div class="col-lg-6">
            <figure>
                <picture>
                    <img class="img-fluid" width="600" src="imgs/<?= $producto->getImagen();?>"
                        alt="<?= $producto->getImagenDescripcion();?>">
                </picture>
            </figure>
        </div>
        <div class="col-lg-6 mx-auto text-center">
            <h2 class="titulo-detalle"><?= $producto->getTitulo();?></h2>
            <p class="text-md-start"><?= $producto->getTexto();?></p>
            <p class="precio-detalle">$<?= $producto->getPrecio();?></p>
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


            <div class="mb-4">
                <label for="cantidad" class="d-block">Cantidad: </label>
                <select name="productos_cantidad" id="cantidad" class="w-100 p-1">
                    <?php for ($i = 1; $i <= htmlspecialchars($producto->getStock()); $i++) : ?>
                        <?php
                        if ($i > 10) break;
                        ?>

                        <option value="<?= $i ?>"><?= $i ?>
                            <?php if ($i <= 1) $option = 'Unidad';
                            else $option = 'Unidades';
                            echo $option ?></option>
                    <?php endfor; ?>
                </select>
            </div>





            <input type="hidden" name="productos_id" value="<?= $producto->getListadoId(); ?>">
            <input type="hidden" name="productos_titulo" value="<?= $producto->getTitulo(); ?>">
            <input type="hidden" name="productos_precio" value="<?= $producto->getPrecio(); ?>">
            <button type="submit" class="btn btn-primary  text-center p-6  text-uppercase  mb-2">Añadir al carrito</button>
        </div>

    </div>
    </form>

</section>

<section class=" container mt-5 ">
    <div class="row">
        <div class="col-lg-6">
            <h3 class="my-3 text-center">Elegí tu talle</h3>
            <p>La tabla de talles es estimaativa, El cance va a depender de como a vos te guste usar la
                prenda. Por eso
                te recomendamos que para mayor información sobre las medidas de las prendas, chequees la
                siguiente
                <strong>tabla de medidas</strong> específica del producto. Si estás entre medio de dos
                talles.
            </p>
            <figure>
                <picture>
                    <img class="img-fluid" width="600" src="imgs/tabla_talles.png" alt="Tabla de talles producto">
                </picture>
            </figure>
        </div>
        <aside class="col-lg-6 ">

            <h3 class="my-3 text-center">Revivì tu <strong>remera</strong></h3>
            <iframe width="560" height="315" src="https://www.youtube.com/<?= $producto->getVideo();?>"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
        </aside>
    </div>
</section>