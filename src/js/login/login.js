//función principal al iniciar
document.addEventListener('DOMContentLoaded', function () {
    eventos();
});

//funcion secundaria
function eventos() {
    $('#btnLogin').click(() => {
        iniciarSession();
    });

    $('#btnRecuperar').click(() => {
        recuperarSession();
    });

    $('#btnLoginRestart').click(() => {
        cambiarPassword();
    });
}

//peticiones fetch - API

function iniciarSession() {
    let url = 'api/requestLogin.php';

    let usuario = {
        email: $('#email').val(),
        pass: $('#password').val()
    };

    let datos = {
        'usuario': usuario,
        'op': 'iniciar',
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

        return response.json(); //para depurar puedes usar .text() - json()
    }).then(data => {
        manejarRespuesta(data.resultado, 1);
    }).catch(error => {
        toastr.error("Fallo la petición");
        console.log(error);
    });

}

function recuperarSession() {
    let url = '../../api/requestLogin.php';

    let usuario = {
        email: $('#email-recuperar').val(),
    };

    let datos = {
        'usuario': usuario,
        'op': 'recuperar',
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

function cambiarPassword() {
    let url = '../../api/requestLogin.php';
    let newPass = $('#new_password').val();
    let repetPass = $('#repet_password').val();

    if (newPass != repetPass) {
        toastr.error("Las contraseñas no coinciden");
        return;
    }

    let usuario = {
        password: $('#new_password').val(),
    };

    let datos = {
        'usuario': usuario,
        'op': 'cambiar',
        'code': $('#idUsuario').val()
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


function manejarRespuesta(resultado, accion) {
    let mensaje = '';

    switch (resultado) {
        case 1:
            mensaje = (accion == 1) ? 'Bienvenido al sistema' : '';
            toastr.success(mensaje);
            setTimeout(() => {
                window.location.href = 'modulos/index.php';
            }, 500);
            break;
        case 0: toastr.error("Correo o contraseña incorrectos");
            break;
        case 3: toastr.error("El correo no coincide con nuestros registros");
            break;
        case 4: toastr.success("Verificar la bandeja de entrada del correo");
            setTimeout(() => {
                window.location.href = '../../login.php';
            }, 500);;
            break;

        case 5: toastr.success("Cambio de contraseña exitoso");
            setTimeout(() => {
                window.location.href = '../../login.php';
            }, 500);;
            break;
        case 6: toastr.error("Por favor ingresar un correo");
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
                eliminarCategoria(code);
            }
        });
}





