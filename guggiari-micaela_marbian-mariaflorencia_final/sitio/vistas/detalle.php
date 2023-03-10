<?php

use DaVinci\Modelos\Producto;

$producto =(new Producto())->traerPorId($_GET['id']);

?>


<section class="container seccion-detalle">
    <h1 class="text-center  fw-bold p-3  my-5">Detalles</h1>

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
            <h2 class="tituo-detalle"><?= $producto->getTitulo();?></h2>
            <p class="text-md-start"><?= $producto->getTexto();?></p>
            <p class="precio-detalle">$<?= $producto->getPrecio();?></p>
            <a href="#" class="btn btn-primary desahabilitado">Agregar al carrito</a>

        </div>
    </div>

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