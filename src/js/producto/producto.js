//función principal al iniciar
document.addEventListener('DOMContentLoaded', function () {
    const input = document.querySelector('#file');
    
    eventos();

    input.addEventListener('change', function () {
        $('#imgBase').val("")
    });
});

//funcion secundaria
function eventos() {
    obtenerTodasCategorias();
    obtenerTodosGeneros();
    obtenerTodosProductos();
    $('#btnGuardar-producto').click(() => {
        if ($('#btnGuardar-producto').val() == 'Agregar') {
            almacenarProducto();
        } else if ($('#btnGuardar-producto').val() == 'Modificar') {
            modificarProducto();
        }

        return;
    });
}

//peticiones fetch - API

function almacenarProducto() {
    let url = '../../api/requestProducto.php';
    let formulario = document.querySelector('#formulario-nuevo-producto');
    const formData = new FormData(formulario);
    formData.append('op', 'registrar');
    formData.append('code', 0);

    let pro = {
        nombre: $('#nombreProducto').val(),
        categoria: $('#categoriaProducto').val(),
        genero: $('#generoProducto').val(),
        descripcion: $('#descripcionProducto').val()
    }

    if (!validarProducto(pro)) return;

    fetch(url, {
        method: 'POST',
        body: formData
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

function obtenerTodasCategorias() {
    let url = "../../api/requestCategoria.php";
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
            llenarCategorias(data);
        })
        .catch(error => console.log(error));
}

function obtenerTodosGeneros() {
    let url = "../../api/requestGenero.php";
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
            llenarGeneros(data);
        })
        .catch(error => console.log(error));
}

function obtenerTodosProductos() {
    let url = "../../api/requestProducto.php";

    const formData = new FormData();
    formData.append('code', 0);
    formData.append('op', 'listarTodos');

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
            llenarTablaProducto(data);
        })
        .catch(error => console.log(error));
}

function modificarProducto() {
    let url = '../../api/requestProducto.php';
    let formulario = document.querySelector('#formulario-nuevo-producto');
    const formData = new FormData(formulario);

    formData.append('op', 'modificar');
    formData.append('code', $('#idProducto').val());

    let pro = {
        nombre: $('#nombreProducto').val(),
        categoria: $('#categoriaProducto').val(),
        genero: $('#generoProducto').val(),
        descripcion: $('#descripcionProducto').val()
    }

    if (!validarProducto(pro)) return;

    fetch(url, {
        method: 'POST',
        body: formData

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

function eliminarProducto(code) {
    let url = '../../api/requestProducto.php';
    const formData = new FormData();

    formData.append("op", "eliminar");
    formData.append("code", code);

    fetch(url, {
        method: 'POST',
        body: formData

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
                window.location.href = '../../modulos/productos/';
            }, 500);
        }
    }).catch(error => {
        toastr.error("No se puede eliminar el producto");
        console.log(error);
    });
}

function obtenerProducto(codigo) {
    let url = "../../api/requestProducto.php";
    let formData = new FormData();

    formData.append("code", codigo);
    formData.append("op", "seleccionar");

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
            levantarModal(data);
        })
        .catch(error => console.log(error));
}

//funciones complementarias

function llenarTablaProducto(data) {
    let tabla = $('#t-productos');
    let i = 1;

    tabla.innerHTML = '';

    data.forEach(obj => {
        let elemento = document.createElement('TR');
        let columnaContador = document.createElement('TD');
        let columnaNombre = document.createElement('TD');
        let columnaCantidad = document.createElement('TD');
        let columnaPrecio = document.createElement('TD');
        let columnaFoto = document.createElement('TD');
        let columnaBtn = document.createElement('TD');
        let imagen = document.createElement('IMG');
        let contenedorImagen = document.createElement('DIV');

        imagen.src = `data:${obj.tipo};base64,${obj.foto}`;
        contenedorImagen.appendChild(imagen);
        contenedorImagen.classList.add('imagen-tabla');

        //columnaBtn.classList.add('tabla__boton');
        elemento.classList.add('contenido-tr');

        columnaContador.innerHTML = i;
        columnaNombre.innerHTML = obj.nombre;
        columnaFoto.appendChild(contenedorImagen);
        columnaCantidad.innerHTML = obj.cantidad;
        columnaPrecio.innerHTML = "$" + parseFloat(obj.precio).toFixed(2);
        columnaBtn.innerHTML = "<button class='boton-cancelar boton-tabla' title='Eliminar'><svg  xmlns='http://www.w3.org/2000/svg'  width='24'  height='24'  viewBox='0 0 24 24'  fill='none'  stroke='currentColor'  stroke-width='2'  stroke-linecap='round'  stroke-linejoin='round'  class='icon icon-tabler icons-tabler-outline icon-tabler-eraser' onclick=' mensajeEliminar(" + obj.id + ")'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M19 20h-10.5l-4.21 -4.3a1 1 0 0 1 0 -1.41l10 -10a1 1 0 0 1 1.41 0l5 5a1 1 0 0 1 0 1.41l-9.2 9.3' /><path d='M18 13.3l-6.3 -6.3' /></svg></button> <button class='boton-agregar boton-tabla' title='Editar'><svg  xmlns='http://www.w3.org/2000/svg'  width='24'  height='24'  viewBox='0 0 24 24'  fill='none'  stroke='currentColor'  stroke-width='2'  stroke-linecap='round'  stroke-linejoin='round'  class='icon icon-tabler icons-tabler-outline icon-tabler-pencil-check' onclick='obtenerProducto(" + obj.id + ")'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4' /><path d='M13.5 6.5l4 4' /><path d='M15 19l2 2l4 -4' /></svg></button>";

        elemento.append(columnaContador);
        elemento.append(columnaNombre);
        elemento.append(columnaFoto);
        elemento.append(columnaCantidad);
        elemento.append(columnaPrecio);
        elemento.append(columnaBtn);

        tabla

        tabla.append(elemento);

        i++;
    });
}

function levantarModal(producto) {
    $('#nombreProducto').val(producto.nombre);
    $('#categoriaProducto').val(producto.categoria);
    $('#generoProducto').val(producto.genero);
    $('#descripcionProducto').val(producto.descripcion);
    $('#idProducto').val(producto.id);
    $('#img-modal').attr("src", `data:${producto.tipo};base64,${producto.foto}`);
    $('#imgBase').val(producto.foto)

    llamarFormProducto("Modificar", "Modificar Producto");
}


function manejarRespuesta(resultado, accion) {
    let mensaje = '';

    switch (resultado) {
        case 1:
            mensaje = (accion == 1) ? 'Creado con exito' : 'Modificado con exito';
            toastr.success(mensaje);
            setTimeout(() => {
                window.location.href = '../../modulos/productos/';
            }, 500);
            break;
        case 2: toastr.error("Este correo ya esta registrado");
            break;
        case 3: toastr.error("Este teléfono ya esta registrado");
            break;
        case 4: toastr.error("Por favor suba una imagen");
            break;
        default: toastr.error("Error al ejecutar la acción");
    }
}

function llenarCategorias(datos) {
    const categoria = $('#categoriaProducto');
    categoria.html("<option value = '' selected disabled> -- Seleccionar -- </option>");

    datos.forEach(obj => {
        categoria.append(`<option value='${obj.id}'>${obj.nombre}</option>`);
    });
}

function llenarGeneros(datos) {
    const categoria = $('#generoProducto');
    categoria.html("<option value = '' selected disabled> -- Seleccionar -- </option>");

    datos.forEach(obj => {
        categoria.append(`<option value='${obj.id}'>${obj.nombre}</option>`);
    });
}

function mensajeEliminar(code) {
    swal({
        title: "¿Estas seguro de eliminar este registro?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                eliminarProducto(code);
            }
        });
}








