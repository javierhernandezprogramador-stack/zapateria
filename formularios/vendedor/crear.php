
<h2 class="formulario__titulo" id="t-vendedor"></h2>
<form method="post" class="formulario formulario-registro">
    <input type="hidden" id="idVendedor">
    <div class="campos">
        <div>
            <label for="nombre">Nombre</label>
            <input type="text" id="nombreVendedor" placeholder="Escriba el nombre">
        </div>
        <div>
            <label for="nombre">Apellido</label>
            <input type="text" id="apellidoVendedor" placeholder="Escriba el apellido">
        </div>
    </div>

    <div class="campos">
        <div>
            <label for="telefono">Teléfono</label>
            <input type="tel" id="telefonoVendedor" placeholder="Escriba el teléfono">
        </div>
        <div>
            <label for="email">E-mail</label>
            <input type="email" id="emailVendedor" placeholder="Escriba el e-mail">
        </div>
    </div>
    <div class="campos">
        <div class="campos_campo">
            <label for="direccion">Dirección</label>
            <input type="text" id="direccionVendedor" placeholder="Ej: Calle Rubén Darío #123, Colonia Escalón, San Salvador">
        </div>
    </div>

    <div class="botones__formulario-registrar contenedor">
        <button type="button" class="boton naruto boton-cancelar" id="btnCancelar">Cancelar</button>
        <input type="button" class="boton boton-agregar" id="btnGuardar-vendedor">
    </div>
</form>