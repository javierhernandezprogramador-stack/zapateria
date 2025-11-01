<h2 class="formulario__titulo" id="t-compra"></h2>
<form method="post" class="formulario formulario-registro">
    <input type="hidden" id="idCompra">
    <div class="campos">
        <div class="campos-column">
            <label for="proveedores">Proveedores</label>
            <select name="proveedores" id="proveedores" class="campo__input campo__input-select">
            </select>
        </div>
        <div class="campos-column">
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha">
        </div>
    </div>

    <div class="campos">
        <div class="campos-column">
            <label for="producto">Producto</label>
            <select name="producto" id="producto" class="campo__input campo__input-select">
            </select>
        </div>
        <div>
            <label for="cantidad">Cantidad</label>
            <input type="number" id="cantidad" placeholder="Escriba la cantidad" min="1">
        </div>
        <div>
            <label for="precio">Precio</label>
            <input type="number" id="precio" placeholder="Escriba el precio" min="0" step="0.001">
        </div>
        <div>
            <button type="button" class="boton-add" id="boton-add">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart-plus">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M4 19a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                    <path d="M12.5 17h-6.5v-14h-2" />
                    <path d="M6 5l14 1l-.86 6.017m-2.64 .983h-10.5" />
                    <path d="M16 19h6" />
                    <path d="M19 16v6" />
                </svg>
            </button>
        </div>
    </div>
    <div class="campos">
        <div class="tabla-detalle">
            <table class="tabla" id="tabla">
                <thead>
                    <tr class="tabla__encabezado">
                        <th>Codigo</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="t-carrito"">
                    
                </tbody>
            </table>
        </div>
    </div>

    <div class="botones__formulario-registrar contenedor">
        <button type="button" class="boton naruto boton-cancelar btn-compra" id="btnCancelar">Cancelar</button>
        <input type="button" class="boton boton-agregar btn-compra" id="btnGuardar-compra">
    </div>
</form>