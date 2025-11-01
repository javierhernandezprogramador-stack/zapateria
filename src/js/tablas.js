let tablaActual = null;

document.addEventListener('DOMContentLoaded', function() {
    obtenerTabla();
});

function obtenerTabla() {
    const elementos = document.querySelectorAll('.listado');
    const inicio = document.querySelector('#inicio');

    inicio.addEventListener('click', function() {
        cargarDesktop();
    });

    elementos.forEach(elemento => {
        elemento.addEventListener('click', function() {
            let id = elemento.id;

            ocultarTabla();
            verificarTabla(id);
        });
    });
}

function cargarDesktop() {
    if(tablaActual != null) {
        tablaActual.classList.add('oculto');
    }
}

function ocultarTabla() {
    if(tablaActual != null) {
        tablaActual.classList.add('oculto');
    }
}

function verificarTabla(id) {
    switch(id) {
        case 'ListaProducto':
            tablaproducto();
        break;
        case 'ListaProveedor':
            tablaProveedor();
        break;
    }
}

function tablaproducto() {
    const tablaProducto = document.querySelector('#tablaProducto');

    tablaProducto.classList.remove('oculto');

    tablaActual = tablaProducto;
}

function tablaProveedor() {
    const tablaProveedor = document.querySelector('#tablaProveedores');

    tablaProveedor.classList.remove('oculto');

    tablaActual = tablaProveedor;
}