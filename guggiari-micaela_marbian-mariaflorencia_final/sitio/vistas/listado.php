<?php
use DaVinci\Modelos\Producto;
$productos = (new Producto())->publicadas();
?>

<section class="listado">
    <h2 class="text-center fw-bold mt-5 p-3">Nuestros Productos</h2>

    <ul class="row p-0">
        <?php
            foreach($productos as $producto):
        ?>

        <li class="card col-md-4 producto">
            <div class="mx-auto">
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

                </div>

                <form action="acciones/add-to-cart.php"  method="POST" class="w-100 text-center">

                <div class="mb-4">
                    <select name="productos_cantidad" id="cantidad" class="w-50 p-1">
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
                <button type="submit" class="btn btn-primary  text-center p-6  text-uppercase  mx-2">Añadir al carrito</button>
                    <a class="btn btn-primary" href="index.php?v=detalle&id=<?= $producto->getListadoId();?>">Ver
                        detalle</a>
                </form>

            </div>

        </li>

        <?php
        endforeach;
        ?>
    </ul>
</section>