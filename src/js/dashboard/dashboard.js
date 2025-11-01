//función principal al iniciar
document.addEventListener('DOMContentLoaded', function () {
    eventos();
});

//funcion secundaria
function eventos() {
    obtenerCantidadRegistro();
    obtenerProductos();
    obtenerCategorias();
    obtenerComprasMeses();
    obtenerVentasMeses();
}


//peticiones fetch - API

function obtenerCategorias() {
    let url = "../api/requestCategoria.php";
    let obj = {
        code: 0,
        op: 'obtenerCantidad'
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
            graficaPastel(data);
        })
        .catch(error => console.log(error));
}

function obtenerComprasMeses() {
    let url = "../api/requestCompra.php";
    let obj = {
        code: 0,
        op: 'listarMeses'
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
            graficaCompras(data);
        })
        .catch(error => console.log(error));
}

function obtenerVentasMeses() {
    let url = "../api/requestVenta.php";
    let obj = {
        code: 0,
        op: 'listarMeses'
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
            graficaVentas(data);
        })
        .catch(error => console.log(error));
}

//funciones complementarias

function graficaPastel(data) {

    let etiquetas = [];
    let info = [];

    data.forEach(row => {
        etiquetas.push(row.nombre);
        info.push(row.cantidad);
    });

    const dataCircular = {
        labels: etiquetas,
        datasets: [{
            label: 'Productos',
            data: info,
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };

    // Configuración del gráfico
    const configCircular = {
        type: 'doughnut', // Tipo de gráfico: bar, line, pie, etc.
        data: dataCircular,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top', // Posición de la leyenda
                }
            },
            scales: {
                y: {
                    beginAtZero: true // Asegura que el eje Y comience en 0
                }
            }
        }
    };

    // Renderizar el gráfico en el canvas
    const ctxCirculas = document.getElementById('myChart-categorias').getContext('2d');
    new Chart(ctxCirculas, configCircular);
}

function obtenerCantidadRegistro() {
    let url = "../api/requestCliente.php";
    let obj = {
        code: 0,
        op: 'dashboard'
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
            $('#cantidadCompra').text(data.compras);
            $('#cantidadVenta').text(data.ventas);
            $('#cantidadProducto').text(data.producto);
            $('#cantidadCliente').text(data.cliente);
        })
        .catch(error => console.log(error));
}


function obtenerProductos() {
    let url = "../api/requestProducto.php";
    const formData = new FormData();

    formData.append("code", 0);
    formData.append("op", "listarCantidad");

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
            graficaBarra(data);
        })
        .catch(error => console.log(error));
}

function graficaBarra(datos) {
    // Etiquetas (labels) para el eje X
    const labels = [];
    const contenido = [];

    datos.forEach(row => {
        labels.push(row.nombre);
        contenido.push(row.cantidad);
    });

    // Datos y configuración del gráfico
    const data = {
        labels: labels,
        datasets: [{
            label: 'Stock de Productos',
            data: contenido, // Valores para el eje Y
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],
            borderWidth: 1
        }]
    };

    // Configuración del gráfico
    const config = {
        type: 'bar', // Tipo de gráfico: bar, line, pie, etc.
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top', // Posición de la leyenda
                }
            },
            scales: {
                y: {
                    beginAtZero: true // Asegura que el eje Y comience en 0
                }
            }
        }
    };

    // Renderizar el gráfico en el canvas
    const ctx = document.getElementById('myChart').getContext('2d');
    new Chart(ctx, config);
}

function graficaCompras(datos) {
    const labels = [];
    const contenido = [];

    datos.forEach(row => {

        switch (row.mes) {
            case 1: labels.push('Enero'); break;
            case 2: labels.push('Febrero'); break;
            case 3: labels.push('Marzo'); break;
            case 4: labels.push('Abril'); break;
            case 5: labels.push('Mayo'); break;
            case 6: labels.push('Junio'); break;
            case 7: labels.push('Julio'); break;
            case 8: labels.push('Agosto'); break;
            case 9: labels.push('Septiembre'); break;
            case 10: labels.push('Octubre'); break;
            case 11: labels.push('Noviembre'); break;
            case 12: labels.push('Diciembre'); break;
        }

        contenido.push(row.cantidad);
    });

    const dataLinea = {
        labels: labels,
        datasets: [{
            label: 'Compras en el año ' + new Date().getFullYear(),
            data: contenido,
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
    };

    // Configuración del gráfico
    const configLinea = {
        type: 'line', // Tipo de gráfico: bar, line, pie, etc.
        data: dataLinea,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top', // Posición de la leyenda
                }
            },
            scales: {
                y: {
                    beginAtZero: true // Asegura que el eje Y comience en 0
                }
            }
        }
    };

    // Renderizar el gráfico en el canvas
    const ctxLinea = document.getElementById('myChart-compras').getContext('2d');
    new Chart(ctxLinea, configLinea);
}

function graficaVentas(datos) {
    const labels = [];
    const contenido = [];

    datos.forEach(row => {

        switch (row.mes) {
            case 1: labels.push('Enero'); break;
            case 2: labels.push('Febrero'); break;
            case 3: labels.push('Marzo'); break;
            case 4: labels.push('Abril'); break;
            case 5: labels.push('Mayo'); break;
            case 6: labels.push('Junio'); break;
            case 7: labels.push('Julio'); break;
            case 8: labels.push('Agosto'); break;
            case 9: labels.push('Septiembre'); break;
            case 10: labels.push('Octubre'); break;
            case 11: labels.push('Noviembre'); break;
            case 12: labels.push('Diciembre'); break;
        }

        contenido.push(row.cantidad);
    });

    const dataLinea2 = {
        labels: labels,
        datasets: [{
            label: 'Ventas en el año ' + new Date().getFullYear(),
            data: contenido,
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
    };

    // Configuración del gráfico
    const configLinea2 = {
        type: 'line', // Tipo de gráfico: bar, line, pie, etc.
        data: dataLinea2,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top', // Posición de la leyenda
                }
            },
            scales: {
                y: {
                    beginAtZero: true // Asegura que el eje Y comience en 0
                }
            }
        }
    };

    // Renderizar el gráfico en el canvas
    const ctxLinea2 = document.getElementById('myChart-ventas').getContext('2d');
    new Chart(ctxLinea2, configLinea2);
}



