<h2 class="formulario__titulo" id="t-cliente"></h2>
<form method="post" class="formulario formulario-registro">
    <input type="hidden" id="idCliente">
    <div class="campos">
        <div>
            <label for="nombreCliente">Nombre</label>
            <input type="text" id="nombreCliente" placeholder="Escriba el nombre del cliente">
        </div>
        <div>
            <label for="apellidoCliente">Apellido</label>
            <input type="text" id="apellidoCliente" placeholder="Escriba el apellido del cliente">
        </div>
    </div>

    <div class="campos">
        <div>
            <label for="telefonoCliente">Teléfono</label>
            <input type="tel" id="telefonoCliente" placeholder="Escriba el teléfono">
        </div>
        <div>
            <label for="emailCliente">E-mail</label>
            <input type="email" id="emailCliente" placeholder="Escriba el e-mail">
        </div>
    </div>
    <div class="campos">
        <div class="campos_campo">
            <label for="direccionCliente">Dirección</label>
            <input type="text" id="direccionCliente" placeholder="Ej: Calle Rubén Darío #123, Colonia Escalón, San Salvador">
        </div>
    </div>

    <div class="botones__formulario-registrar contenedor">
        <button type="button" class="boton naruto boton-cancelar" id="btnCancelar">Cancelar</button>
        <input type="button" class="boton boton-agregar" id="btnGuardar-cliente">
    </div>
</form>