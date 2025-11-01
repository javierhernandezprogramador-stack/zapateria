document.addEventListener('DOMContentLoaded', function () {
    crearModal();
});

function crearModal() {
    const elementos = document.querySelectorAll('.registrar__modal');

    elementos.forEach(elemento => {
        elemento.addEventListener('click', () => {
            let id = elemento.id;
            console.log(id);
            obtenerFormulario(id);
        });
    });
}

function obtenerFormulario(id) {
    switch (id) {
        case 'producto':
            llamarFormProducto("Agregar", "Nuevo Producto");
            break;
        case 'proveedor':
            llamarFormProveedor("Agregar", "Nuevo Proveedor");
            break;
        case 'categoria':
            llamarFormCategoria("Agregar", "Nueva Categoria");
            break;
        case 'vendedor':
            llamarFormVendedor("Agregar", "Nuevo Vendedor");
            break;
        case 'cliente':
            llamarFormCliente("Agregar", "Nuevo Cliente");
            break;
        case 'compra':
            llamarFormCompra("Comprar", "Nueva Compra");
            break;

        case 'venta':
            llamarFormVenta("Vender", "Nueva Venta");
            break;
    }
}

function llamarFormProducto(accion, title) {
    const formProducto = document.querySelector('#form-producto');
    const boton = document.querySelector('#btnGuardar-producto');
    const titulo = document.querySelector('#t-producto');

    titulo.innerHTML = title;
    boton.value = accion;
    agregarModal(formProducto);
}

function llamarFormProveedor(accion, title) {
    const formProveedor = document.querySelector('#form-proveedor');
    const boton = document.querySelector('#btnGuardar-proveedor');
    const titulo = document.querySelector('#t-proveedor');

    titulo.innerHTML = title;
    boton.value = accion;
    agregarModal(formProveedor);
}

function llamarFormCategoria(accion, title) {
    const formCategoria = document.querySelector('#form-categoria');
    const boton = document.querySelector('#btnGuardar-categoria');
    const titulo = document.querySelector('#t-categoria');

    titulo.innerHTML = title;
    boton.value = accion;
    agregarModal(formCategoria);
}

function llamarFormVendedor(accion, title) {
    const formVendedor = document.querySelector('#form-vendedor');
    const boton = document.querySelector('#btnGuardar-vendedor');
    const titulo = document.querySelector('#t-vendedor');

    titulo.innerHTML = title;
    boton.value = accion;
    agregarModal(formVendedor);
}

function llamarFormCliente(accion, title) {
    const formCliente = document.querySelector('#form-cliente');
    const boton = document.querySelector('#btnGuardar-cliente');
    const titulo = document.querySelector('#t-cliente');

    titulo.innerHTML = title;
    boton.value = accion;
    agregarModal(formCliente);
}

function llamarFormCompra(accion, title) {
    const formCompra = document.querySelector('#form-compra');
    const boton = document.querySelector('#btnGuardar-compra');
    const titulo = document.querySelector('#t-compra');

    titulo.innerHTML = title;
    boton.value = accion;
    agregarModal(formCompra);
}


function llamarFormVenta(accion, title) {
    const formVenta = document.querySelector('#form-venta');
    const boton = document.querySelector('#btnGuardar-venta');
    const titulo = document.querySelector('#t-venta');

    titulo.innerHTML = title;
    boton.value = accion;
    agregarModal(formVenta);
}

function llamarFormVerCompra() {

    const formCompra = document.querySelector('#form-ver-compra');
    const titulo = document.querySelector('#t-ver-compra');

    titulo.innerHTML = "Información de compra";
    agregarModal(formCompra);
}

function llamarFormVerVenta() {

    const formVenta = document.querySelector('#form-ver-venta');
    const titulo = document.querySelector('#t-ver-venta');

    titulo.innerHTML = "Información de venta";
    agregarModal(formVenta);
}



function agregarModal(formulario) {
    const body = document.querySelector('body')
    const modal = document.createElement('DIV');
    const btnCancelar = document.querySelector('#btnCancelar');
    const btnCancelarV = document.querySelector('#btnCancelarV');

    //modal.onclick = cerrarModal;

    btnCancelar.addEventListener('click', () => {
        cerrarModal(formulario);
    });

    if (btnCancelarV) {
        btnCancelarV.addEventListener('click', () => {
            cerrarModal(formulario);
        });
    }


    body.classList.add('overflow-hidden');
    modal.classList.add('modal');

    modal.appendChild(formulario);
    body.appendChild(modal);
}

function cerrarModal(formulario) {
    const modal = document.querySelector('.modal');
    const body = document.querySelector('body');
    const conteForm = document.querySelector('.contenedor__formularios');
    const filas = document.querySelectorAll('.tr-detalle');

    //recuperamos el formulario
    conteForm.appendChild(formulario);

    modal.classList.add('fadeOut');

    //limpiamos el formulario

    //proveedor
    $('#nombreProveedor').val("");
    $('#telefonoProveedor').val("");
    $('#emailProveedor').val("");
    $('#direccionProveedor').val("");
    $('#idProveedor').val("");

    //formulario categoria
    $('#nombreCategoria').val("");
    $('#idCategoria').val("");

    //fomrulario vendedor
    $('#nombreVendedor').val("");
    $('#apellidoVendedor').val("");
    $('#telefonoVendedor').val("");
    $('#direccionVendedor').val("");
    $('#emailVendedor').val("");
    $('#idVendedor').val("");

    //formulario producto
    $('#nombreProducto').val("");
    $('#categoriaProducto').val("");
    $('#generoProducto').val("");
    $('#descripcionProducto').val("");
    $('#idProducto').val("");

    //formulario de compra
    $('#proveedores').val("");
    $('#fecha').val("");
    $('#idCompra').val("");

    $('#producto').val("");
    $('#cantidad').val("");
    $('#precio').val("");
    
    //formulario de cliente
    $('#nombreCliente').val("");
    $('#apellidoCliente').val("");
    $('#telefonoCliente').val("");
    $('#emailCliente').val("");
    $('#direccionCliente').val("");

    filas.forEach(fila => {
        fila.remove();
    });

    $('#img-modal').attr("src", "../../src/img/estrellas.png");

    setTimeout(() => {
        modal?.remove();
        body.classList.remove('overflow-hidden');
    }, 500);
}