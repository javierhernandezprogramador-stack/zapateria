
<h2 class="formulario__titulo" id="t-proveedor"></h2>
<form method="post" class="formulario formulario-registro">
    <input type="hidden" id="idProveedor">
    <div class="campos">
        <div class="campos_campo">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombreProveedor" placeholder="Escriba el nombre del proveedor">
        </div>
    </div>

    <div class="campos">
        <div>
            <label for="telefono">Teléfono</label>
            <input type="tel" id="telefonoProveedor" placeholder="Escriba el teléfono">
        </div>
        <div>
            <label for="email">E-mail</label>
            <input type="email" id="emailProveedor" placeholder="Escriba el e-mail">
        </div>
    </div>
    <div class="campos">
        <div class="campos_campo">
            <label for="direccion">Dirección</label>
            <input type="text" id="direccionProveedor" placeholder="Ej: Calle Rubén Darío #123, Colonia Escalón, San Salvador">
        </div>
    </div>

    <div class="botones__formulario-registrar contenedor">
        <button type="button" class="boton naruto boton-cancelar" id="btnCancelar">Cancelar</button>
        <input type="button" class="boton boton-agregar" id="btnGuardar-proveedor">
        <!-- <button class="boton boton-agregar">Agregar</button> -->
    </div>
</form>