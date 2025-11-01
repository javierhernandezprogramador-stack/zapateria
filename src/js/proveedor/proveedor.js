//función principal al iniciar
document.addEventListener('DOMContentLoaded', function () {
    eventos();
});

//funcion secundaria
function eventos() {
    obtenerTodosProveedores();
    $('#btnGuardar-proveedor').click(() => {
        if ($('#btnGuardar-proveedor').val() == 'Agregar') {
            almacenarProveedor();
        } else if ($('#btnGuardar-proveedor').val() == 'Modificar') {
            modificarProveedor();
        }

        return;
    });
}

//peticiones fetch - API

function almacenarProveedor() {
    let url = '../../api/requestProveedor.php';
    let proveedor = {
        nombre: $('#nombreProveedor').val(),
        telefono: $('#telefonoProveedor').val(),
        email: $('#emailProveedor').val(),
        direccion: $('#direccionProveedor').val()
    };

    if (!validarProveedor(proveedor)) return;

    let datos = {
        'proveedor': proveedor,
        'op': 'registrar',
        'code': 0
    };
    //let formProveedor;


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

function obtenerTodosProveedores() {
    let url = "../../api/requestProveedor.php";
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
            llenarTablaProveedores(data);
        })
        .catch(error => console.log(error));
}

function modificarProveedor() {
    let url = '../../api/requestProveedor.php';
    let proveedor = {
        nombre: $('#nombreProveedor').val(),
        telefono: $('#telefonoProveedor').val(),
        email: $('#emailProveedor').val(),
        direccion: $('#direccionProveedor').val()
    };
    
    if (!validarProveedor(proveedor)) return;

    let datos = {
        'proveedor': proveedor,
        'op': 'modificar',
        'code': $('#idProveedor').val()
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

function eliminarProveedor(code) {
    let url = '../../api/requestProveedor.php';
    let proveedor = {
        nombre: $('#nombreProveedor').val(),
        telefono: $('#telefonoProveedor').val(),
        email: $('#emailProveedor').val(),
        direccion: $('#direccionProveedor').val()
    };

    let datos = {
        'proveedor': proveedor,
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
                window.location.href = '../../modulos/proveedores/';
            }, 500);
        }
    }).catch(error => {
        toastr.error("No se puede eliminar este proveedor");
        console.log(error);
    });
}

function obtenerProveedor(codigo) {
    let url = "../../api/requestProveedor.php";
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

//funciones complementarias

function llenarTablaProveedores(data) {
    let tabla = $('#t-proveedores');
    let i = 1;

    tabla.innerHTML = '';

    data.forEach(obj => {
        let elemento = document.createElement('TR');
        let columnaContador = document.createElement('TD');
        let columnaNombre = document.createElement('TD');
        let columnaTelefono = document.createElement('TD');
        let columnaEmail = document.createElement('TD');
        let columnaDireccion = document.createElement('TD');
        let columnaBtn = document.createElement('TD');

        //columnaBtn.classList.add('tabla__boton');
        elemento.classList.add('contenido-tr');

        columnaContador.innerHTML = i;
        columnaNombre.innerHTML = obj.nombre;
        columnaTelefono.innerHTML = obj.telefono;
        columnaEmail.innerHTML = obj.email;
        columnaDireccion.innerHTML = obj.direccion;
        columnaBtn.innerHTML = "<button class='boton-cancelar boton-tabla' title='Eliminar'><svg  xmlns='http://www.w3.org/2000/svg'  width='24'  height='24'  viewBox='0 0 24 24'  fill='none'  stroke='currentColor'  stroke-width='2'  stroke-linecap='round'  stroke-linejoin='round'  class='icon icon-tabler icons-tabler-outline icon-tabler-eraser' onclick=' mensajeEliminar(" + obj.id + ")'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M19 20h-10.5l-4.21 -4.3a1 1 0 0 1 0 -1.41l10 -10a1 1 0 0 1 1.41 0l5 5a1 1 0 0 1 0 1.41l-9.2 9.3' /><path d='M18 13.3l-6.3 -6.3' /></svg></button> <button class='boton-agregar boton-tabla' title='Editar'><svg  xmlns='http://www.w3.org/2000/svg'  width='24'  height='24'  viewBox='0 0 24 24'  fill='none'  stroke='currentColor'  stroke-width='2'  stroke-linecap='round'  stroke-linejoin='round'  class='icon icon-tabler icons-tabler-outline icon-tabler-pencil-check' onclick='obtenerProveedor(" + obj.id + ")'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4' /><path d='M13.5 6.5l4 4' /><path d='M15 19l2 2l4 -4' /></svg></button>";

        elemento.append(columnaContador);
        elemento.append(columnaNombre);
        elemento.append(columnaTelefono);
        elemento.append(columnaEmail);
        elemento.append(columnaDireccion);
        elemento.append(columnaBtn);

        tabla

        tabla.append(elemento);

        i++;
    });
}

function levantarModal(proveedor) {
    $('#nombreProveedor').val(proveedor.nombre);
    $('#telefonoProveedor').val(proveedor.telefono);
    $('#emailProveedor').val(proveedor.email);
    $('#direccionProveedor').val(proveedor.direccion);
    $('#idProveedor').val(proveedor.id);

    llamarFormProveedor("Modificar", "Modificar Proveedor");
}


function manejarRespuesta(resultado, accion) {
    let mensaje = '';

    switch (resultado) {
        case 1:
            mensaje = (accion == 1) ? 'Creado con exito' : 'Modificado con exito';
            toastr.success(mensaje);
            setTimeout(() => {
                window.location.href = '../../modulos/proveedores/';
            }, 500);
            break;
        case 2: toastr.error("Este correo ya esta registrado");
            break;
        case 3: toastr.error("Este teléfono ya esta registrado");
            break;
        default: toastr.error("Error al ejecutar la acción");
    }
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
                eliminarProveedor(code);
            }
        });
}








