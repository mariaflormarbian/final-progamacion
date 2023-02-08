<section>
    <h1>
        Registrarse
    </h1>
    <form action="acciones/auth-registro.php" method="post">
        <label for="email">Email</label>
        <input 
            type="email" 
            name="email" 
            id="email" 
        >
        <div>
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <label for="password_confirmar">Confirmar Contraseña</label>
            <input type="password_confirmar" name="password_confirmar" id="password_confirmar">
        </div>
        <button type="button" class="btn">Crear Cuenta</button>
    </form>
</section>