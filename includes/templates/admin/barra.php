<div class="barra-superior">
    <div>
        <a href="<?php echo $urlBase?>/cerrar.php">
            <img src="<?php echo $urlBase;?>/src/img/exit.svg" alt="Imagen de cerrar sesión" title="cerrar sesión">
        </a>
    </div>
    <div class="barra__usuario">
        <img src="<?php echo $urlBase;?>/src/img/user.svg" alt="Imagen de usuario">
        <div class="barra__usuario-contenido">
            <p class="barra__nombre"><?php echo $_SESSION['email']; ?></p>
            <p class="barra__rol"> <?php echo ($_SESSION['rol'] == 1) ? 'Administrador' : 'Vendedor' ?></p>
        </div>
    </div>
</div> <!--barra-superior-->