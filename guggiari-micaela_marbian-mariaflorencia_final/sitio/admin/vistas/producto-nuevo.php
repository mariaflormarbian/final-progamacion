<?php
use DaVinci\Session\Session;

$estados = (new \DaVinci\Modelos\ProductoEstado())->todo();
$etiquetas = (new \DaVinci\Modelos\Etiqueta())->todo();



$errores = $_SESSION['errores'] ?? [];
$dataForm = $_SESSION['data_form'] ?? [];

unset($_SESSION['errores'], $_SESSION['data_form']);
?>
<section class="container container-nuevo">
    <h2 class="mb-1">Publicar una Nuevo producto</h2>

    <p class="mb-1">Completá los datos del formulario con el producto. Cuando estés conforme dale a "Publicar".</p>


    <form action="acciones/producto-publicar.php" method="post" enctype="multipart/form-data">
        <div class="form-fila">
            <label for="titulo">Título</label>

            <input type="text" id="titulo" name="titulo" class="form-control"
                value="<?= e($dataForm['titulo'] ?? null); ?>"
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
            <label for="texto">Texto completo</label>
            <textarea id="texto" name="texto" class="form-control" <?php if (isset($errores['texto'])): ?>
                aria-describedby="error-texto" <?php endif; ?>><?= e($dataForm['texto'] ?? null); ?></textarea>
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
            <label for="precio">Precio</label>
            <input id="precio" name="precio" class="form-control" <?php if (isset($errores['precio'])): ?>
                aria-describedby="error-precio" <?php endif; ?>><?= e($dataForm['precio'] ?? null); ?>
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
            <label for="imagen">Imagen <span class="text-small">(<span class="visually-hidden">campo
                    </span>opcional)</span></label>
            <input type="file" id="imagen" name="imagen" class="form-control">
        </div>
        <div class="form-fila">
            <label for="imagen_descripcion">Descripción de la Imagen <span class="text-small">(<span
                        class="visually-hidden">campo </span>opcional)</span></label>
            <input type="text" id="imagen_descripcion" name="imagen_descripcion" class="form-control"
                value="<?= e($dataForm['imagen_descripcion'] ?? null); ?>">
        </div>
        <div class="form-fila">
            <label for="video">Enlace de Video Youtube, EMBED (opcional)</label>
            <input type="text" id="video" name="video" class="form-control"
                placeholder=" Ejemplo luego del <iframe> aparece Youtube/ (copiar desde embed y pegar)"
                value="<?= e($dataForm['video'] ?? null); ?>">
        </div>
        <div class="form-fila">
            <label for="productos_estados_fk">Estado de Publicación</label>
            <select type="text" id="productos_estados_fk" name="productos_estados_fk" class="form-control">
                <?php
                foreach ($estados as $estado):
                ?>
                <option value="<?= $estado->getProductosEstadosId();?>" <?= $estado->getProductosEstadosId() == ($dataForm['productos_estados_fk'] ?? null) ?
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
                        <input type="checkbox" name="etiquetas_id[]" value="<?= $etiqueta->getEtiquetasId();?>" <?= in_array($etiqueta->getEtiquetasId(), $dataForm['etiquetas_id'] ?? [])
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
        <div class="form-fila">
            <button type="submit" class="button btn btn-primary my-3">Publicar</button>
    </form>
</section>