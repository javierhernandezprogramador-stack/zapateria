<?php
require 'includes/app.php';
incluirTemplates('header');
?>


<main class="sombra contenedor">
    <h1 class="titulo-nosotros">Contacto</h1>

    <section class="contacto">
        <section class="contacto__redes">
            <section class="redes_contenedor">
                <p>Comprar por Whatsapp</p>
                <section class="redes">
                    <a href="#"><img src="src/img/whatsapp.svg" alt="Imagen de whatsapp"></a>
                </section>
            </section>
            <section class="redes_contenedor">
                <p>Comprar por Facebook</p>
                <section class="redes">
                    <a href="#"><img src="src/img/facebook.svg" alt="Imagen de facebook"></a>
                </section>
            </section>
        </section>

        <div class="contacto__formulario">

            <form action="" class="formulario">
                <div class="campo">
                    <label for="nombre" class="campo__label">Nombre</label>
                    <input type="text" placeholder="Tu nombre" class="campo__input" id="nombre">
                </div>
                <div class="campo">
                    <label for="apellido" class="campo__label">Apellido</label>
                    <input type="text" placeholder="Tu apellido" class="campo__input" id="apellido">
                </div>
                <div class="campo">
                    <label for="email" class="campo__label">Email</label>
                    <input type="email" placeholder="Tu Email" class="campo__input" id="email">
                </div>
                <div class="campo">
                    <label for="telefono" class="campo__label">Teléfono</label>
                    <input type="tel" placeholder="Tu teléfono" class="campo__input" id="telefono">
                </div>
                <div class="campo">
                    <label for="mensaje" class="campo__label">Mensaje</label>
                    <textarea name="" id="mensaje" class="campo__input campo__textarea"></textarea>
                </div>

                <input type="submit" value="Enviar" class="boton">
            </form>
        </div>

    </section>
</main>

<?php incluirTemplates('footer'); ?>