<?php
use DaVinci\Modelos\Producto;
$productos = (new Producto())->publicadas($busqueda);
?>

<section class="catalogo">
    <h1 class="visually-hidden">Catálogo de nuestros productos disponibles</h1>
    <h2 class="text-center fw-bold mt-5 p-3">Nuestros Productos</h2>

    <ul class="row p-0">
        <?php foreach($productos as $producto): ?>
        <li class="card col-md-4 productos">
            <div class="producto">
                <picture>
                    <img class="img-fluid" src="imgs/productos/<?= $producto->getImagen();?>"
                        alt="<?= $producto->getImagenDescripcion();?>">
                </picture>
                <div class="audio">
                    <audio controls>
                        <source src="./audio/<?= $producto->getAudio();?>" type="audio/mpeg">
                    </audio>
                </div>
                <div>
                    <span class="visually-hidden">Etiquetas asociadas a este producto:</span>
                    <ul class="list-unstyled">
                        <?php foreach($producto->getEtiquetas() as $etiqueta): ?>
                        <li>
                            <span class="badge bg-primary"><?= $etiqueta->getNombre();?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="card-body text-center">
                    <h3 class="card-title"><?= $producto->getTitulo();?></h3>
                    <p class="card-text">$<?= $producto->getPrecio();?></p>
                </div>
                <form action="acciones/agregar-carrito.php" method="POST" class="w-100 text-center">
                    <div class="mb-4">
                        <div class="quantity">
                            <button class="minus-btn" type="button"
                                onclick="decrement(<?= $producto->getCatalogoId(); ?>)">-</button>
                            <input type="text" name="productos_cantidad" id="cantidad<?= $producto->getCatalogoId(); ?>"
                                value="1">
                            <button class="plus-btn" type="button"
                                onclick="increment(<?= $producto->getCatalogoId(); ?>)">+</button>
                        </div>
                    </div>
                    <input type="hidden" name="productos_id" value="<?= $producto->getCatalogoId(); ?>">
                    <input type="hidden" name="productos_titulo" value="<?= $producto->getTitulo(); ?>">
                    <input type="hidden" name="productos_precio" value="<?= $producto->getPrecio(); ?>">
                    <button type="submit" class="btn btn-primary text-center p-6 text-uppercase mx-2 mb-2">Añadir al
                        carrito</button>
                    <a class="btn btn-primary mb-2" href="index.php?v=detalle&id=<?= $producto->getCatalogoId();?>">Ver
                        detalle</a>
                </form>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
</section>

<script>
function increment(productId) {
    var inputElement = document.getElementById('cantidad' + productId);
    var currentValue = parseInt(inputElement.value);
    var stock = parseInt(<?= $producto->getStock(); ?>);
    inputElement.value = currentValue + 1;
}
}

function decrement(productId) {
    var inputElement = document.getElementById('cantidad' + productId);
    var currentValue = parseInt(inputElement.value);
    if (currentValue > 1) {
        inputElement.value = currentValue - 1;
    }
}
</script>