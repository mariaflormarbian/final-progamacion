<?php
use DaVinci\Modelos\Producto;
use DaVinci\Modelos\ProductoEstado;
use DaVinci\Modelos\Etiqueta;

$errores = $_SESSION['errores'] ?? [];
$dataForm = $_SESSION['data_form'] ?? [];

unset($_SESSION['errores'], $_SESSION['data_form']);

$estados = (new ProductoEstado())->todo();
$etiquetas = (new Etiqueta())->todo();
$productos = (new Producto())->traerPorId($_GET['id']);
$productos->cargarEtiquetas();
?>

<section>
    <h1 class="mb-1">Editar Producto</h1>
    <p class="mb-1">Editá los datos del formulario con el Producto. Cuando estés conforme dale a "Actualizar".</p>
    <form action="acciones/producto-editar.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $productos->getCatalogoId(); ?>">
        <div class="form-fila">
            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" class="form-control"
                value="<?= e($dataForm['titulo'] ?? $productos->getTitulo()); ?>"
                aria-describedby="<?= isset($errores['titulo']) ? 'error-titulo' : '' ?> help-titulo">
            <div class="form-help" id="help-titulo">El título tiene que tener al menos 5 caracteres</div>
            <?php
            if (isset($errores['titulo'])):
                ?>
            <div class="msg-error" id="error-titulo"><span class="visually-hidden">Error:
                </span><?= $errores['titulo']; ?></div>
            <?php
            endif;
            ?>
        </div>
        <div class="form-fila">
            <label for="precio">Precio</label>
            <textarea id="precio" name="precio" class="form-control" <?php if (isset($errores['precio'])): ?>
                aria-describedby="error-precio"
                <?php endif; ?>><?= e($dataForm['precio'] ?? $productos->getPrecio()); ?></textarea>
            <?php
            if (isset($errores['precio'])):
                ?>
            <div class="msg-error" id="error-precio"><span class="visually-hidden">Error:
                </span><?= $errores['precio']; ?></div>
            <?php
            endif;
            ?>
        </div>
        <div class="form-fila">
            <label for="texto">Texto completo</label>
            <textarea id="texto" name="texto" class="form-control" <?php if (isset($errores['texto'])): ?>
                aria-describedby="error-texto"
                <?php endif; ?>><?= e($dataForm['texto'] ?? $productos->getTexto()); ?></textarea>
            <?php
            if (isset($errores['texto'])):
                ?>
            <div class="msg-error" id="error-texto"><span class="visually-hidden">Error:
                </span><?= $errores['texto']; ?></div>
            <?php
            endif;
            ?>
        </div>

        <div class="form-fila">
            <label for="stock">Stock</label>
            <textarea id="stock" name="stock" class="form-control" <?php if (isset($errores['stock'])): ?>
                aria-describedby="error-precio"
            <?php endif; ?>><?= e($dataForm['stock'] ?? $productos->getStock()); ?></textarea>

        </div>

        <div class="mb-4 w-100 d-flex gap-3 img-icon bg-light p-4 row">
            <?php
            if (!empty($productos->getImagen()) && file_exists(__DIR__ . '/../../imgs/productos' . $productos->getImagen())) :
                ?>
                <div class="col-12 col-lg-3 mb-4 mb-lg-0">
                    <p class="">Imagen Actual</p>
                    <picture>
                        <img src="<?= '../imgs/productos/' . $productos->getImagen(); ?>" alt="" class="img-fluid">
                    </picture>
                </div>
            <?php
            endif;
            ?>
        <div class="form-fila">
            <label for="imagen">Imagen <span class="text-small">(<span class="visually-hidden">campo </span>opcional)</span></label>
            <img width="416" src="<?= '../imgs/productos/' . e($productos->getImagen()); ?>" alt="">
            <input type="file" id="imagen" name="imagen" class="form-control"  value="<?= e($dataForm['imagen'] ?? $productos->getImagen()); ?>">
        </div>
        <div class="form-fila">
            <label for="imagen_descripcion">Descripción de la Imagen <span class="text-small">(<span class="visually-hidden">campo </span>opcional)</span></label>
            <input type="text" id="imagen_descripcion" name="imagen_descripcion" class="form-control"
                value="<?= e($dataForm['imagen_descripcion'] ?? $productos->getImagenDescripcion()); ?>">
        </div>
        <div class="form-fila">
            <label for="video">Enlace de Video Youtube, EMBED (opcional)</label>
            <input type="text" id="video" name="video" class="form-control"
                   placeholder=" Ejemplo luego del <iframe> aparece Youtube/ (copiar desde embed y pegar)"
                   value="<?= e($dataForm['video'] ?? $productos->getVideo()); ?>">
        </div>

        <div class="form-fila">
            <label for="audio">Audio <span class="text-small">(<span class="visually-hidden">campo </span>opcional)</span></label>
            <p for="audio"><?=$productos->getAudio()?></p>
            <input type="file" id="audio" name="audio" class="form-control"  value="<?= e($dataForm['audio'] ?? $productos->getAudio()); ?>">
        </div>


        <div class="form-fila">
            <label for="productos_estados_fk">Estado de Publicación</label>
            <select id="productos_estados_fk" name="productos_estados_fk" class="form-control">
                <?php
                foreach ($estados as $estado):
                    ?>
                <option value="<?= $estado->getProductosEstadosId();?>" <?= $estado->getProductosEstadosId() == ($dataForm['productos_estados_fk'] ??
                        $productos->getProductosEstadoFk()) ?
                            'selected' :
                            '';?>>
                    <?=$estado->getNombre();?>
                </option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
        <div>
            <fieldset>
                <legend>Etiquetas</legend>
                <div class="form-checkbox-list">
                    <?php
                    foreach($etiquetas as $etiqueta):
                        ?>
                    <label>
                        <input type="checkbox" name="etiquetas_id[]" value="
                        <?= $etiqueta->getEtiquetasId();?>" 
                        <?= in_array($etiqueta->getEtiquetasId(), $dataForm['etiquetas_id'] ?? $productos->getEtiquetaFk())
                                ? 'checked'
                                : ''; ?>>
                        <?= $etiqueta->getNombre();?>
                    </label>
                    <?php
                    endforeach;
                    ?>
                </div>
            </fieldset>
        </div>
        <button type="submit" class="button btn btn-primary my-3">Actualizar</button>
    </form>
</section>