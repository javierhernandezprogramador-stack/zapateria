<h2 class="formulario__titulo" id="t-producto">Nuevo Producto</h2>
<form method="post" class="formulario formulario-registro" id="formulario-nuevo-producto" enctype="multipart/form-data">
    <input type="hidden" id="idProducto">
    <input type="hidden" id="imgBase" name="imgBase">
    <div class="campo">
        <label for="nombreProducto" class="campo__label">Nombre</label>
        <input type="text" id="nombreProducto" class="campo__input campo__input-agregar" name="nombre">
    </div>
    <div class="campo">
        <label for="categoriaProducto" class="campo__label">Categoria</label>
        <select name="categoria" id="categoriaProducto" class="campo__input campo__input-select">
            <option value="">Deportivos</option>
            <option value="">Escolares</option>
        </select>
    </div>
    <div class="campo">
        <label for="generoProducto" class="campo__label">Genero</label>
        <select name="genero" id="generoProducto" class="campo__input campo__input-select">
            <option value="">Hombre</option>
            <option value="">Mujer</option>
            <option value="">Unisex</option>
        </select>
    </div>
    <div class="campo">
        <label for="descripcionProducto" class="campo__label">Detalles</label>
        <input type="text" name="descripcion" id="descripcionProducto" class="campo__input campo__input-agregar">
        <!-- <textarea name="" id="descripcionProducto"
            class="campo__input campo__textarea campo__textarea-registrar"></textarea> -->
    </div>

    <div class="campos">
        <div>
            <img alt="Imagen modificar" src="../../src/img/estrellas.png" class="img-modal" id="img-modal">
        </div>

        <div class="file-input-container">
            <label class="file-label">
                <input type="file" class="file-input" id="file" name="file" onchange="cargarImagenZapato()" accept="image/*" required>
                <span class="file-name" id="file-name">Ningúna Imagen Seleccionada</span>
                <button type="button" class="file-button">Seleccionar Imagen</button>
            </label>
        </div>
    </div>

    <div class="botones__formulario-registrar contenedor">
        <button type="button" class="boton naruto boton-cancelar" id="btnCancelar">Cancelar</button>
        <input type="button" class="boton boton-agregar" id="btnGuardar-producto">
    </div>
</form>