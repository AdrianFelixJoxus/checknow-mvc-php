<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Inicia Sesion en CheckNow</p>

    <?php include_once __DIR__ . "/../templates/alertas.php"; ?>

    <form method="post" action="/login"  class="formulario">
        <div class="formulario__campo">
            <input 
                type="text"
                class="formulario__input"
                placeholder="NOMBRE DE USUARIO"
                id="usuario"
                name="usuario"
            >
        </div>

        <div class="formulario__campo">
            <input 
                type="password"
                class="formulario__input"
                placeholder="TU PASSWORD"
                id="password"
                name="password"
            >
        </div>

        <input type="submit" class="formulario__submit" value="Iniciar Sesion">
    </form>
</main>