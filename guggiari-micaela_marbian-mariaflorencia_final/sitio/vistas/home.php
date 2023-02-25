<?php
use DaVinci\Modelos\Producto;

$productos = (new Producto())->publicadas();
$rutaTexto= [
    'texto' => [
        'quienes-somos' => '<strong>Simpsoneras</strong> nació como un
        microemprendimiento
        durante
        la pandemia. Detrás de nuestra marca nos encontramos: Vivi y Flor, madre e hija.
        Así como su nombre lo indica, soy una <strong>fanática de Los Simpsons</strong> y
        considero que
        hay una
        frase de ellos para cada momento de la vida. Nos encontramos en un momento difícil donde
        al no
        poder
        acceder a nuestros trabajos por lo sucedido, buscamos ideas y estos personajes amarillos
        nos
        iluminaron.
        Nos pareció divertido implementar frases, escenas en remeras que podamos usar a lo largo
        del
        día.
        Generando un momento divertido y conectando con la gente, ya sea con un comentario como
        "Hay ese
        es el
        capítulo tal...".
        Le dimos mucha importancia a que sea un producto canchero, con onda pero especialmente
        <strong>original</strong>.
        Las telas que utilizamos son totalmente suaves, cómodas y de una calidad única,
        trabajamos con
        una de
        las fábricas más populares de la Argentina. No sólo buscamos un producto único, sino
        también
        cómodo y
        duradero.'
    ]
    ];
$texto = $rutaTexto['texto'];  
?>

<div class="fondo-home"></div>
<section>
    <h2 class="text-center fondo1 p-3 display-6">¡La moda que te inspira! <strong>¡Comprá hoy y recibilo al toque! / Envío dentro de las 24hs. </strong></h2>
    <div id="carrusel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <picture class="carousel-item active">
                    <source media="(min-width:768px)" srcset="./imgs/desktop/slider1.png">
                    <img class="d-block img-fluid" alt="Remeras desde $1380 promoción" src="./imgs/mobile/slider-mobile1.png">
            </picture>
            <picture class="carousel-item">
                    <source media="(min-width:768px)" srcset="./imgs/desktop/slider2.png">
                    <img class="d-block img-fluid" alt="Compra ahora remera, las más vendidas" src="./imgs/mobile/slider-mobile2.png">
            </picture>
            <picture class="carousel-item ">
                    <source media="(min-width:768px)" class="img-fluid" srcset="./imgs/desktop/slider3.png">
                    <img class="d-block img-fluid" alt="Diseñamos el dibujo o remera que elijas" src="./imgs/mobile/slider-mobile3.png">
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
                    <img src=" ./imgs/exchange.png" width=30 alt="Icono cambio y devolución">
                </picture>
                <div class="linea">
                    <h3>Cambio y devolución</h3>
                    <p>Gratis, a todo el país</p>
                </div>
            </li>
            <li class="col-md-4">
                <picture>
                    <img src="./imgs/pago-seguro.png" width=30 alt="Icono pagos seguros">
                </picture>
                <div class="linea">
                    <h3>Formas de pago Seguras</h3>
                    <p>Tarjeta, efectivo, mercado pago</p>
                </div>
            </li>
            <li class="col-md-4">
                <picture>
                    <img src="./imgs/caja.png" width=30 alt="Icono envio express">
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
    <h2 class="text-center ">¿Quiénes somos?</h2>
    <div class="row container-home">
        <div class="col-12">
            <p class="text-ceter text-md-start quienes-somos"> <?= $texto['quienes-somos'];?>
            </p>

            <div class="row my-5 ">
                <figure>
                    <picture>
                        <img class="img-fluid d-block mx-auto" src="imgs/flor_vivi.jpeg" alt="Foto de Flor y Vivi">
                    </picture>
                </figure>

            </div>
        </div>

    </div>
</section>