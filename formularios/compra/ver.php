<div class="cabeza-form">
    <div class="btn-cabezera">
        <button type="button" id="btnCancelarV">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm4.207 12.793-1.414 1.414L12 13.414l-2.793 2.793-1.414-1.414L10.586 12 7.793 9.207l1.414-1.414L12 10.586l2.793-2.793 1.414 1.414L13.414 12l2.793 2.793z"></path>
            </svg>
        </button>
    </div>
    <h2 class="formulario__titulo" id="t-ver-compra"></h2>
</div>

<form method="post" class="formulario formulario-registro">
    <div class="modulo-ver">
        <label>Fecha:</label>
        <p id="fecha-ver"></p>
    </div>

    <div class="modulo-ver">
        <label>Proveedor:</label>
        <p id="proveedor-ver"></p>
    </div>

    <div class="modulo-ver">
        <label>Resposable:</label>
        <p id="responsable-ver"></p>
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
                    </tr>
                </thead>
                <tbody id="t-detalle"">
                    
                </tbody>
            </table>
        </div>
    </div>

    <div class=" modulo-ver">
        <label>Total:</label>
        <p id="total-ver"></p>
    </div>
</form>