let carrito = [];
let eliminar = [];

//función principal al iniciar
document.addEventListener('DOMContentLoaded', function () {
    eventos();
});

//funcion secundaria
function eventos() {
    obtenerClientes();
    obtenerProductos();
    obtenerTodasVentas();
    $('#btnGuardar-venta').click(() => {
        if ($('#btnGuardar-venta').val() == 'Vender') {
            almacenarVenta();
        } else if ($('#btnGuardar-venta').val() == 'Modificar') {
            modificarVenta();
        }

        return;
    });

    $('#boton-add').click(() => {
        addCarrito();
    });

    $('#btnCancelar').click(() => {
        limpiarDatos();
    });

    $('#btnCancelarV').click(() => {
        limpiarDatos();
    });
}

//limpiar datos principales
function limpiarDatos() {
    console.log("vas a limpiar datos");
    carrito = [];
    eliminar = [];
}

//peticiones fetch - API

function almacenarVenta() {
    let url = '../../api/requestVenta.php';
    let venta = {
        fecha: $('#fecha').val(),
        cliente: $('#clientes').val(),
        vendedor: "8",
        detalle: carrito
    };

    if (!validarVenta(venta, true)) return;

    let datos = {
        'venta': venta,
        'op': 'registrar',
        'code': 0
    };

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(datos)

    }).then(response => {
        if (!response.ok) {
            toastr.error("Error en la respuesta del servidor");
            throw new Error("Error en la respuesta del servidor");
        }

        return response.json(); //para depurar puedes usar .text()
    }).then(data => {
        manejarRespuesta(data.resultado, 1);
    }).catch(error => {
        toastr.error("Fallo la petición");
        console.log(error);
    });

}

function obtenerTodasVentas() {
    let url = "../../api/requestVenta.php";
    let obj = {
        code: 0,
        op: 'listarTodos'
    };

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(obj)
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then(data => {
            llenarTablaVentas(data);
        })
        .catch(error => console.log(error));
}

function modificarVenta() {
    let url = '../../api/requestVenta.php';
    let venta = {
        fecha: $('#fecha').val(),
        cliente: $('#clientes').val(),
        vendedor: "8"
    };

    limpiarCarrito();
    venta.detalle = carrito;
    venta.eliminar = eliminar;

    if (!validarVenta(venta)) return;

    let datos = {
        'venta': venta,
        'op': 'modificar',
        'code': $('#idVenta').val()
    };

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(datos)

    }).then(response => {
        if (!response.ok) {
            toastr.error("Error en la respuesta del servidor");
            throw new Error("Error en la respuesta del servidor");
        }

        return response.json(); //para depurar puedes usar .text()
    }).then(data => {
        manejarRespuesta(data.resultado, 0);
    }).catch(error => {
        toastr.error("Fallo la petición");
        console.log(error);
    });

}

function eliminarCompra(code) {
    let url = '../../api/requestCompra.php';
    let compra = {
        fecha: $('#fecha').val(),
        proveedor: $('#proveedores').val(),
        vendedor: "8",
        detalle: carrito
    };

    let datos = {
        'compra': compra,
        'op': 'eliminar',
        'code': code
    };

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(datos)

    }).then(response => {
        if (!response.ok) {
            toastr.error("Error en la respuesta del servidor");
            throw new Error("Error en la respuesta del servidor");
        }

        return response.json(); //para depurar puedes usar .text()
    }).then(data => {
        if (data.resultado == 1) {
            toastr.success("Eliminado con exito");
            setTimeout(() => {
                window.location.href = '../../modulos/compras/';
            }, 2000);
        }
    }).catch(error => {
        toastr.error("Fallo la petición");
        console.log(error);
    });
}

function obtenerVenta(codigo) {
    let url = "../../api/requestVenta.php";
    let obj = {
        code: codigo,
        op: 'seleccionar'
    };

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(obj)
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then(data => {
            levantarModal(data);
        })
        .catch(error => console.log(error));
}

//metodo que me permite consultar las ventas para ver en el modal
function obtenerVentaV(codigo) {
    let url = "../../api/requestVenta.php";
    let obj = {
        code: codigo,
        op: 'obtener'
    };

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(obj)
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then(data => {
            levantarModalV(data);
        })
        .catch(error => console.log(error));
}


//funciones complementarias

function llenarTablaVentas(data) {
    let tabla = $('#t-ventas');
    let i = 1;

    tabla.innerHTML = '';

    data.forEach(obj => {
        let elemento = document.createElement('TR');
        let columnaContador = document.createElement('TD');
        let columnaCliente = document.createElement('TD');
        let columnaTotal = document.createElement('TD');
        let columnaFecha = document.createElement('TD');
        let columnaBtn = document.createElement('TD');

        //columnaBtn.classList.add('tabla__boton');
        elemento.classList.add('contenido-tr');

        columnaContador.innerHTML = i;
        columnaCliente.innerHTML = obj.cliente;
        columnaTotal.innerHTML = "$" + parseFloat(obj.total).toFixed(2);
        columnaFecha.innerHTML = obj.fecha;
        columnaBtn.innerHTML = "<button class='boton-agregar boton-tabla' title='Ver' onclick='obtenerVentaV(" + obj.id + ")'><svg  xmlns='http://www.w3.org/2000/svg'  width='24'  height='24'  viewBox='0 0 24 24'  fill='none'  stroke='currentColor'  stroke-width='2'  stroke-linecap='round'  stroke-linejoin='round'  class='icon icon-tabler icons-tabler-outline icon-tabler-eye'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0' /><path d='M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6' /></svg></button> <button class='boton-agregar boton-tabla' title='Editar'><svg  xmlns='http://www.w3.org/2000/svg'  width='24'  height='24'  viewBox='0 0 24 24'  fill='none'  stroke='currentColor'  stroke-width='2'  stroke-linecap='round'  stroke-linejoin='round'  class='icon icon-tabler icons-tabler-outline icon-tabler-pencil-check' onclick='obtenerVenta(" + obj.id + ")'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4' /><path d='M13.5 6.5l4 4' /><path d='M15 19l2 2l4 -4' /></svg></button>";
        //columnaBtn.innerHTML = "<button class='boton-agregar boton-tabla' title='Ver' onclick='obtenerCompraV(" + obj.id + ")'><svg  xmlns='http://www.w3.org/2000/svg'  width='24'  height='24'  viewBox='0 0 24 24'  fill='none'  stroke='currentColor'  stroke-width='2'  stroke-linecap='round'  stroke-linejoin='round'  class='icon icon-tabler icons-tabler-outline icon-tabler-eye'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0' /><path d='M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6' /></svg></button> <button class='boton-cancelar boton-tabla' title='Eliminar'><svg  xmlns='http://www.w3.org/2000/svg'  width='24'  height='24'  viewBox='0 0 24 24'  fill='none'  stroke='currentColor'  stroke-width='2'  stroke-linecap='round'  stroke-linejoin='round'  class='icon icon-tabler icons-tabler-outline icon-tabler-eraser' onclick=' eliminarCompra(" + obj.id + ")'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M19 20h-10.5l-4.21 -4.3a1 1 0 0 1 0 -1.41l10 -10a1 1 0 0 1 1.41 0l5 5a1 1 0 0 1 0 1.41l-9.2 9.3' /><path d='M18 13.3l-6.3 -6.3' /></svg></button> <button class='boton-agregar boton-tabla' title='Editar'><svg  xmlns='http://www.w3.org/2000/svg'  width='24'  height='24'  viewBox='0 0 24 24'  fill='none'  stroke='currentColor'  stroke-width='2'  stroke-linecap='round'  stroke-linejoin='round'  class='icon icon-tabler icons-tabler-outline icon-tabler-pencil-check' onclick='obtenerCompra(" + obj.id + ")'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4' /><path d='M13.5 6.5l4 4' /><path d='M15 19l2 2l4 -4' /></svg></button>";


        elemento.append(columnaContador);
        elemento.append(columnaCliente);
        elemento.append(columnaTotal);
        elemento.append(columnaFecha);
        elemento.append(columnaBtn);

        tabla.append(elemento);

        i++;
    });
}

function levantarModal(obj) {
    const venta = obj.venta;
    const detalles = obj.detalles;
    let subTotal = 0;

    carrito = [];
    eliminar = [];

    $('#clientes').val(venta.cliente);
    $('#fecha').val(venta.fecha);
    $('#idVenta').val(venta.id);

    detalles.forEach(detalle => {
        subTotal = parseInt(detalle.cantidad) * parseFloat(detalle.precio);
        let producto = {
            "id": "",
            "nombre": detalle.producto,
            "cantidad": detalle.cantidad,
            "precio": detalle.precio,
            "subTotal": subTotal,
            "id_detalle": detalle.id
        }

        carrito.push(producto);
    });

    llenarTablaCarrito();

    llamarFormVenta("Modificar", "Modificar Venta");
}

function levantarModalV(obj) {
    const venta = obj.venta;
    const detalles = obj.detalles;
    let subTotal = 0;

    carrito = [];

    $('#fecha-ver').text(venta.fecha);
    $('#cliente-ver').text(venta.cliente);
    $('#responsable-ver').text(venta.vendedor);

    detalles.forEach(detalle => {
        subTotal = parseInt(detalle.cantidad) * parseFloat(detalle.precio);
        let producto = {
            "id": "",
            "nombre": detalle.producto,
            "cantidad": detalle.cantidad,
            "precio": detalle.precio,
            "subTotal": subTotal,
            "id_detalle": detalle.id
        }

        carrito.push(producto);
    });

    llenarTablaDetalle();

    llamarFormVerVenta();
}


function manejarRespuesta(resultado, accion) {
    let mensaje = '';
    carrito = [];
    eliminar = [];

    switch (resultado) {
        case 1:
            mensaje = (accion == 1) ? 'Creado con exito' : 'Modificado con exito';
            toastr.success(mensaje);
            setTimeout(() => {
                window.location.href = '../../modulos/ventas/';
            }, 500);
            break;
        case 2: toastr.error("Este correo ya esta registrado");
            break;
        case 3: toastr.error("Este teléfono ya esta registrado");
            break;
        default: toastr.error("Error al ejecutar la acción");
    }
}

function obtenerClientes() {
    let url = "../../api/requestCliente.php";
    let obj = {
        code: 0,
        op: 'listarTodos'
    };

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(obj)
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then(data => {
            llenarClientes(data);
        })
        .catch(error => console.log(error));
}

function llenarClientes(datos) {
    const proveedores = $('#clientes');
    proveedores.html("<option value = '' selected disabled> -- Seleccionar -- </option>");

    datos.forEach(obj => {
        proveedores.append(`<option value='${obj.id}'>${obj.nombre}</option>`);
    });
}

function obtenerProductos() {
    let url = "../../api/requestProducto.php";
    const formData = new FormData();

    formData.append("code", 0);
    formData.append("op", "listarDisponibles");

    fetch(url, {
        method: 'POST',
        body: formData
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then(data => {
            llenarProductos(data);
        })
        .catch(error => console.log(error));
}

function llenarProductos(datos) {
    const productos = $('#producto');
    let precio;

    productos.html("<option value = '' selected disabled> -- Seleccionar -- </option>");

    datos.forEach(obj => {
        productos.append(`<option data-cantidad=${obj.cantidad} data-precio=${obj.precio} value='${obj.id}'>${obj.nombre}</option>`);
    });

    productos.on('change', function () {
        precio = $('#producto option:selected').data('precio');
        $('#precio').val(precio.toFixed(2));
    });
}

function addCarrito() {

    let cantidad = $('#cantidad').val();
    let maximo = $('#producto option:selected').data('cantidad');

    if (cantidad > maximo) {
        toastr.error("La cantidad supera el stock (" + maximo + ")");
        return;
    }

    const subTotal = parseInt(cantidad) * parseFloat($('#precio').val());

    let producto = {
        "id": $('#producto').val(),
        "nombre": $('#producto option:selected').text(),
        "cantidad": cantidad,
        "precio": $('#precio').val(),
        "subTotal": subTotal
    }

    carrito.push(producto);

    console.log(carrito);

    llenarTablaCarrito();
}

function llenarTablaDetalle() {
    let tabla = $('#t-detalle');
    let i = 1;
    let total = 0;

    //tabla.innerHTML = '';
    limpiarTabla();

    carrito.forEach(producto => {
        let elemento = document.createElement('TR');
        let columnaContador = document.createElement('TD');
        let columnaProducto = document.createElement('TD');
        let columnaCantidad = document.createElement('TD');
        let columnaPrecio = document.createElement('TD');
        let columnaSubTotal = document.createElement('TD');

        elemento.classList.add('tr-detalle');

        columnaContador.innerHTML = i;
        columnaProducto.innerHTML = producto.nombre;
        columnaCantidad.innerHTML = producto.cantidad;
        columnaPrecio.innerHTML = "$" + parseFloat(producto.precio).toFixed(2);
        columnaSubTotal.innerHTML = "$" + parseFloat(producto.subTotal).toFixed(2);
        // columnaBtn.innerHTML = "<button type='button' class='boton-cancelar boton-tabla' title='Eliminar'><svg  xmlns='http://www.w3.org/2000/svg'  width='24'  height='24'  viewBox='0 0 24 24'  fill='none'  stroke='currentColor'  stroke-width='2'  stroke-linecap='round'  stroke-linejoin='round'  class='icon icon-tabler icons-tabler-outline icon-tabler-eraser' onclick=' eliminarProducto(" + (i - 1) + ")'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M19 20h-10.5l-4.21 -4.3a1 1 0 0 1 0 -1.41l10 -10a1 1 0 0 1 1.41 0l5 5a1 1 0 0 1 0 1.41l-9.2 9.3' /><path d='M18 13.3l-6.3 -6.3' /></svg></button>";

        elemento.append(columnaContador);
        elemento.append(columnaProducto);
        elemento.append(columnaCantidad);
        elemento.append(columnaPrecio);
        elemento.append(columnaSubTotal);

        tabla.append(elemento);

        total += parseFloat(producto.subTotal);

        i++;
    });

    $('#total-ver').text("$" + total.toFixed(2));
}

function llenarTablaCarrito() {
    let tabla = $('#t-carrito');
    let i = 1;

    limpiarTabla();

    carrito.forEach(producto => {
        let elemento = document.createElement('TR');
        let columnaContador = document.createElement('TD');
        let columnaProducto = document.createElement('TD');
        let columnaCantidad = document.createElement('TD');
        let columnaPrecio = document.createElement('TD');
        let columnaSubTotal = document.createElement('TD');
        let columnaBtn = document.createElement('TD');

        elemento.classList.add('tr-detalle');

        columnaContador.innerHTML = i;
        columnaProducto.innerHTML = producto.nombre;
        columnaCantidad.innerHTML = producto.cantidad;
        columnaPrecio.innerHTML = "$" + parseFloat(producto.precio).toFixed(2);
        columnaSubTotal.innerHTML = "$" + parseFloat(producto.subTotal).toFixed(2);
        columnaBtn.innerHTML = "<button type='button' class='boton-cancelar boton-tabla' title='Eliminar'><svg  xmlns='http://www.w3.org/2000/svg'  width='24'  height='24'  viewBox='0 0 24 24'  fill='none'  stroke='currentColor'  stroke-width='2'  stroke-linecap='round'  stroke-linejoin='round'  class='icon icon-tabler icons-tabler-outline icon-tabler-eraser' onclick=' eliminarProducto(" + (i - 1) + ")'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M19 20h-10.5l-4.21 -4.3a1 1 0 0 1 0 -1.41l10 -10a1 1 0 0 1 1.41 0l5 5a1 1 0 0 1 0 1.41l-9.2 9.3' /><path d='M18 13.3l-6.3 -6.3' /></svg></button>";

        elemento.append(columnaContador);
        elemento.append(columnaProducto);
        elemento.append(columnaCantidad);
        elemento.append(columnaPrecio);
        elemento.append(columnaSubTotal);
        elemento.append(columnaBtn);

        tabla.append(elemento);

        i++;
    });
}

function limpiarTabla() {
    const filas = document.querySelectorAll('.tr-detalle');

    filas.forEach(fila => {
        fila.remove();
    });
}

function eliminarProducto(posicion) {
    const producto = carrito[posicion];

    if (producto.id == "") {
        eliminar.push(producto.id_detalle);
    }

    carrito.splice(posicion, 1);

    llenarTablaCarrito();
}

function limpiarCarrito() {
    for (let i = 0; i < carrito.length; i++) {
        if (carrito[i].id == "") {
            carrito.splice(i, 1);
            return limpiarCarrito();
        }
    }
}


