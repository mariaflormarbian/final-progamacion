<section class="mt-5 mb-5">
    <h1 class="text-center fw-bold mt-5 p-3 ">
        ¿Dudas?
    </h1>

    <form action="recursos/enviar.php" method="get" class="row g-3 text-center text-md-start container-form">
        <div class="col-xl-7">
            <label class="form-label" for="nombre">Nombre</label>
            <input class="form-control" name="nombre" id="nombre" type="text" required>
        </div>
        <div class="col-xl-7">
            <label class="form-label" for="apellido">Apellido</label>
            <input class="form-control" name="apellido" id="apellido" type="text" required>
        </div>
        <div class="col-xl-7">
            <label class="form-label" for="clave">Mail</label>
            <input class="form-control" name="clave" id="clave" type="email" required>
        </div>

        <div class="col-xl-8">
            <label class="form-label" for="comentario">Comentario</label>
            <textarea class="form-control" name="comentario" id="comentario" cols="10" rows="10"></textarea>
        </div>

        <div class="col-xl-7">
            <label class="form-check-label" for="sobre">Desea recibir información</label>
            <input class="form-check-label" type="checkbox" name="sobre" id="sobre">
        </div>

        <div>
            <label for="info">Sobre</label>
            <select name="info" id="info" class="campo">
                <option value="sp">Remeras Los Simpsons</option>
                <option value="x">Estampa personalizada</option>
            </select>
        </div>
        <div class="col-xl-6 text-center text-md-start">
            <input type="submit" class="
              col-xl-4
              btn
              fondo1
              btn-outline-dark
              border
              rounded
              m-1
              btn-lg
              text-uppercase
            " value="Enviar">
        </div>

    </form>
</section>