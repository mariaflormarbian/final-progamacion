<?php
use DaVinci\Modelos\Producto;
$productos = (new Producto())->publicadas(null);
?>

<div class="fondo-home">
    <h1 class="visually-hidden">Inicio</h1>
</div>

<section>
    <h2 class="text-center fondo1 p-3 display-6">¡La moda que te inspira! <strong>¡Comprá hoy y recibilo al toque! /
            Envío dentro de las 24hs. </strong></h2>
    <div id="carrusel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <picture class="carousel-item active">
                <source media="(min-width:768px)" srcset="./imgs/desktop/slider1.png">
                <img class="d-block img-fluid" alt="Remeras desde $1380 promoción"
                    src="./imgs/mobile/slider-mobile1.png">
            </picture>
            <picture class="carousel-item">
                <source media="(min-width:768px)" srcset="./imgs/desktop/slider2.png">
                <img class="d-block img-fluid" alt="Compra ahora remera, las más vendidas"
                    src="./imgs/mobile/slider-mobile2.png">
            </picture>
            <picture class="carousel-item ">
                <source media="(min-width:768px)" class="img-fluid" srcset="./imgs/desktop/slider3.png">
                <img class="d-block img-fluid" alt="Diseñamos el dibujo o remera que elijas"
                    src="./imgs/mobile/slider-mobile3.png">
            </picture>
            <button class="carousel-control-prev" type="button" data-bs-target="#carrusel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carrusel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>
<section>
    <div>
        <ul class="d-flex align-items-md-center" id="home-extraInfo">
            <li class="col-md-4">
                <picture>
                    <img src=" ./imgs/otros/exchange.png" width=30 alt="Icono cambio y devolución">
                </picture>
                <div class="linea">
                    <h3>Cambio y devolución</h3>
                    <p>Gratis, a todo el país</p>
                </div>
            </li>
            <li class="col-md-4">
                <picture>
                    <img src="./imgs/otros/pago-seguro.png" width=30 alt="Icono pagos seguros">
                </picture>
                <div class="linea">
                    <h3>Formas de pago Seguras</h3>
                    <p>Tarjeta, efectivo, mercado pago</p>
                </div>
            </li>
            <li class="col-md-4">
                <picture>
                    <img src="./imgs/otros/caja.png" width=30 alt="Icono envio express">
                </picture>
                <div class="linea">
                    <h3>Envíos express</h3>
                    <p>A las 24hs en tu puerta</p>
                </div>
            </li>
        </ul>
    </div>
</section>
<section>
    <h2 class="text-center fw-bold mt-5 ">Nuestras remeras</h2>
    <p class="text-center mt-3">¿Querés conocer más sobre nuestros productos?</p>
    <ul class="row p-0">
        <?php
        foreach($productos as $i =>$producto):
            if($i < 3 ):
                ?>
        <li class="card col-md-4 productos">
            <a href="index.php?v=detalle&id=<?= $producto->getCatalogoId();?>">
                <div class="producto">
                    <picture>
                        <img class="img-fluid" src="imgs/productos/<?= $producto->getImagen();?>"
                            alt="<?= $producto->getImagenDescripcion();?>">
                    </picture>
                    <div class="card-body text-center">
                        <h3 class="card-title"><?= $producto->getTitulo();?></h3>
                    </div>
                </div>
            </a>
        </li>
        <?php
            endif;
            ?>
        <?php
        endforeach;
        ?>
    </ul>
    <div class="text-center">
        <a href="index.php?v=catalogo" class="btn fs-5">Ver todos</a>
    </div>
</section>