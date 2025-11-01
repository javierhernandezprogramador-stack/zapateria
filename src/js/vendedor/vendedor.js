//función principal al iniciar
document.addEventListener('DOMContentLoaded', function () {
    eventos();
});

//funcion secundaria
function eventos() {
    obtenerTodosVendedores();
    $('#btnGuardar-vendedor').click(() => {
        if ($('#btnGuardar-vendedor').val() == 'Agregar') {
            almacenarVendedor();
        } else if ($('#btnGuardar-vendedor').val() == 'Modificar') {
            modificarVendedor();
        }

        return;
    });
}

//peticiones fetch - API

function almacenarVendedor() {

    let url = '../../api/requestVendedor.php';
    let vendedor = {
        nombre: $('#nombreVendedor').val(),
        apellido: $('#apellidoVendedor').val(),
        telefono: $('#telefonoVendedor').val(),
        direccion: $('#direccionVendedor').val(),
        email: $('#emailVendedor').val(),
        estado: 1
    };

    if (!validarVendedor(vendedor)) return;

    let datos = {
        'vendedor': vendedor,
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

function obtenerTodosVendedores() {
    let url = "../../api/requestVendedor.php";
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
            llenarTablaVendedores(data);
        })
        .catch(error => console.log(error));
}

function modificarVendedor() {
    let url = '../../api/requestVendedor.php';
    let vendedor = {
        nombre: $('#nombreVendedor').val(),
        apellido: $('#apellidoVendedor').val(),
        telefono: $('#telefonoVendedor').val(),
        direccion: $('#direccionVendedor').val(),
        email: $('#emailVendedor').val()
    };

    if (!validarVendedor(vendedor)) return;

    let datos = {
        'vendedor': vendedor,
        'op': 'modificar',
        'code': $('#idVendedor').val()
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

function eliminarVendedor(code) {
    let url = '../../api/requestVendedor.php';
    let vendedor = {
        nombre: $('#nombreVendedor').val(),
        apellido: $('#apellidoVendedor').val(),
        telefono: $('#telefonoVendedor').val(),
        direccion: $('#direccionVendedor').val(),
        email: $('#emailVendedor').val()
    };

    let datos = {
        'vendedor': vendedor,
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
            toastr.success("Suspendido con exito");
            setTimeout(() => {
                window.location.href = '../../modulos/vendedores/';
            }, 500);
        }
    }).catch(error => {
        toastr.error("No se puede eliminar el vendedor");
        console.log(error);
    });
}

function restaurarVendedor(code) {
    let url = '../../api/requestVendedor.php';
    let vendedor = {
        nombre: $('#nombreVendedor').val(),
        apellido: $('#apellidoVendedor').val(),
        telefono: $('#telefonoVendedor').val(),
        direccion: $('#direccionVendedor').val(),
        email: $('#emailVendedor').val()
    };

    let datos = {
        'vendedor': vendedor,
        'op': 'restaurar',
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
            toastr.success("Restaurado con exito");
            setTimeout(() => {
                window.location.href = '../../modulos/vendedores/';
            }, 500);
        }
    }).catch(error => {
        toastr.error("No se puede eliminar el vendedor");
        console.log(error);
    });
}

function obtenerVendedor(codigo) {
    let url = "../../api/requestVendedor.php";
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
            levantarModal(data.usuario, data.vendedor);
        })
        .catch(error => console.log(error));
}

//funciones complementarias

function llenarTablaVendedores(data) {
    let tabla = $('#t-vendedores');
    let usuario;
    let vendedor;
    let i = 1;

    tabla.innerHTML = '';

    data.forEach(obj => {

        usuario = obj.usuario;
        vendedor = obj.vendedor;

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
        columnaNombre.innerHTML = vendedor.nombre + " " + vendedor.apellido;
        columnaTelefono.innerHTML = vendedor.telefono;
        columnaEmail.innerHTML = usuario.email;
        columnaDireccion.innerHTML = vendedor.direccion;
        columnaBtn.innerHTML = (vendedor.estado == 1) ? "<button class='boton-cancelar boton-tabla' title='Suspender'><svg  xmlns='http://www.w3.org/2000/svg'  width='24'  height='24'  viewBox='0 0 24 24'  fill='none'  stroke='currentColor'  stroke-width='2'  stroke-linecap='round'  stroke-linejoin='round'  class='icon icon-tabler icons-tabler-outline icon-tabler-eraser' onclick=' mensajeEliminar(" + vendedor.id + ")'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M19 20h-10.5l-4.21 -4.3a1 1 0 0 1 0 -1.41l10 -10a1 1 0 0 1 1.41 0l5 5a1 1 0 0 1 0 1.41l-9.2 9.3' /><path d='M18 13.3l-6.3 -6.3' /></svg></button> <button class='boton-agregar boton-tabla' title='Editar'><svg  xmlns='http://www.w3.org/2000/svg'  width='24'  height='24'  viewBox='0 0 24 24'  fill='none'  stroke='currentColor'  stroke-width='2'  stroke-linecap='round'  stroke-linejoin='round'  class='icon icon-tabler icons-tabler-outline icon-tabler-pencil-check' onclick='obtenerVendedor(" + vendedor.id + ")'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4' /><path d='M13.5 6.5l4 4' /><path d='M15 19l2 2l4 -4' /></svg></button>" : "<button class='boton-celeste boton-tabla' title='Dar de alta'><svg  xmlns='http://www.w3.org/2000/svg'  width='24'  height='24'  viewBox='0 0 24 24'  fill='currentColor'  class='icon icon-tabler icons-tabler-filled icon-tabler-square-rounded-plus' onclick=' mensajeDarAlta(" + vendedor.id + ")'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M12 2l.324 .001l.318 .004l.616 .017l.299 .013l.579 .034l.553 .046c4.785 .464 6.732 2.411 7.196 7.196l.046 .553l.034 .579c.005 .098 .01 .198 .013 .299l.017 .616l.005 .642l-.005 .642l-.017 .616l-.013 .299l-.034 .579l-.046 .553c-.464 4.785 -2.411 6.732 -7.196 7.196l-.553 .046l-.579 .034c-.098 .005 -.198 .01 -.299 .013l-.616 .017l-.642 .005l-.642 -.005l-.616 -.017l-.299 -.013l-.579 -.034l-.553 -.046c-4.785 -.464 -6.732 -2.411 -7.196 -7.196l-.046 -.553l-.034 -.579a28.058 28.058 0 0 1 -.013 -.299l-.017 -.616c-.003 -.21 -.005 -.424 -.005 -.642l.001 -.324l.004 -.318l.017 -.616l.013 -.299l.034 -.579l.046 -.553c.464 -4.785 2.411 -6.732 7.196 -7.196l.553 -.046l.579 -.034c.098 -.005 .198 -.01 .299 -.013l.616 -.017c.21 -.003 .424 -.005 .642 -.005zm0 6a1 1 0 0 0 -1 1v2h-2l-.117 .007a1 1 0 0 0 .117 1.993h2v2l.007 .117a1 1 0 0 0 1.993 -.117v-2h2l.117 -.007a1 1 0 0 0 -.117 -1.993h-2v-2l-.007 -.117a1 1 0 0 0 -.993 -.883z' fill='currentColor' stroke-width='0' /></svg></button> <button class='boton-agregar boton-tabla' title='Editar'><svg  xmlns='http://www.w3.org/2000/svg'  width='24'  height='24'  viewBox='0 0 24 24'  fill='none'  stroke='currentColor'  stroke-width='2'  stroke-linecap='round'  stroke-linejoin='round'  class='icon icon-tabler icons-tabler-outline icon-tabler-pencil-check' onclick='obtenerVendedor(" + vendedor.id + ")'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4' /><path d='M13.5 6.5l4 4' /><path d='M15 19l2 2l4 -4' /></svg></button>";
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

function levantarModal(usuario, vendedor) {
    $('#nombreVendedor').val(vendedor.nombre);
    $('#apellidoVendedor').val(vendedor.apellido);
    $('#telefonoVendedor').val(vendedor.telefono);
    $('#emailVendedor').val(usuario.email);
    $('#direccionVendedor').val(vendedor.direccion);
    $('#idVendedor').val(vendedor.id);

    llamarFormVendedor("Modificar", "Modificar Vendedor");
}


function manejarRespuesta(resultado, accion) {
    let mensaje = '';

    switch (resultado) {
        case 1:
            mensaje = (accion == 1) ? 'Creado con exito' : 'Modificado con exito';
            toastr.success(mensaje);
            setTimeout(() => {
                window.location.href = '../../modulos/vendedores/';
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
        title: "¿Estas seguro de suspender este vendedor?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                eliminarVendedor(code);
            }
        });
}

function mensajeDarAlta(code) {
    swal({
        title: "¿Estas seguro de restaurar este vendedor?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                restaurarVendedor(code);
            }
        });
}









