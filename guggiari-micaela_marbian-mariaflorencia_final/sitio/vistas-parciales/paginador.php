<?php
/** @var DaVinci\Paginacion\Paginador $paginador */
if($paginador->getPaginas() > 1):
?>
<nav class="paginador">
    <p>Páginas</p>
    <ul class="paginador-lista">
        <?php 
        if($paginador->getPagina() > 1):
        ?>
        <li>
            <a href="<?= $paginador->getUrlBase() . "&p=1";?>">
                <span class="visually-hidden">Primer página</span>
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <li>
            <a href="<?= $paginador->getUrlBase() . "&p=" . ($paginador->getPagina() - 1);?>">
                <span class="visually-hidden">Página anterior</span>
                <span aria-hidden="true">&lsaquo;</span>
            </a>
        </li>
        <?php 
        else:
        ?>
        <li aria-hidden="true" class="paginador-lista-disabled">
            <span>&laquo;</span>
        </li>
        <li aria-hidden="true" class="paginador-lista-disabled">
            <span>&lsaquo;</span>
        </li>
        <?php 
        endif;
        ?>

    <?php
    for($i = 1; $i <= $paginador->getPaginas(); $i++):
    ?>
        <?php 
        if($i === $paginador->getPagina()):
        ?>
        <li aria-current="page"><span><?= $i;?></span></li>
        <?php 
        else:
        ?>
        <li><a href="<?= $paginador->getUrlBase() . '&p=' . $i;?>"><?= $i;?></a></li>
        <?php 
        endif;
        ?>
    <?php
    endfor;
    ?>

    <?php 
    if($paginador->getPagina() < $paginador->getPaginas()):
    ?>
    <li>
        <a href="<?= $paginador->getUrlBase() . "&p=" . ($paginador->getPagina() + 1);?>">
            <span class="visually-hidden">Página siguiente</span>
            <span aria-hidden="true">&rsaquo;</span>
        </a>
    </li>
    <li>
        <a href="<?= $paginador->getUrlBase() . "&p=" . $paginador->getPaginas();?>">
            <span class="visually-hidden">Última página</span>
            <span aria-hidden="true">&raquo;</span>
        </a>
    </li>
    <?php 
    else:
    ?>
    <li aria-hidden="true" class="paginador-lista-disabled">
        <span>&rsaquo;</span>
    </li>
    <li aria-hidden="true" class="paginador-lista-disabled">
        <span>&raquo;</span>
    </li>
    <?php 
    endif;
    ?>
    </ul>
</nav>
<?php
endif;
?>