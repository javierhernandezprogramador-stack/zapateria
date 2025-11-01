
//funcion que me permite validar solo cadenas - true - correcto y false - incorrecto
function validarTexto(cadena) {
    const formato = /^[A-Za-z\s]+$/;
    return (formato.test(cadena)) ? true : false;
}

function validarTelefono(cadena) {
    const formato = /^[2-7]{1}[0-9]{7}$/;
    return (formato.test(cadena)) ? true : false;
}

function validarEmail(cadena) {
    const formato = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return (formato.test(cadena)) ? true : false;
}

function validarTextoNumero(cadena) {
    const formato = /^[a-zA-Z0-9 ]+$/;
    return (formato.test(cadena)) ? true : false;
}


//funcion que me permite saber si esta vacio
function vacio(valor) {
    return (valor) ? false : true;
}

//función que me permite validar una venta
function validarVenta(venta, nuevo=false) {

    if (vacio(venta.cliente) || vacio(venta.fecha)) {
        toastr.error("Algunos campos estan vacios");
        return false;
    }
    
    if (nuevo == true && venta.detalle.length == 0) {
        toastr.error("Por favor, agregar productos a la venta");
        return false;
    }

    return true;
}

//función que me permite validar una compra
function validarCompra(compra, nuevo=false) {

    if (vacio(compra.proveedor) || vacio(compra.fecha)) {
        toastr.error("Algunos campos estan vacios");
        return false;
    }
    
    if (nuevo == true && compra.detalle.length == 0) {
        toastr.error("Por favor, agregar productos a la compra");
        return false;
    }

    return true;
}

//función que me permite validar un producto
function validarProducto(producto) {

    if (vacio(producto.nombre) || vacio(producto.categoria) || 
    vacio(producto.genero) || vacio(producto.descripcion)) {
        toastr.error("Algunos campos estan vacios");
        return false;
    }

    if (!validarTextoNumero(producto.nombre)) {
        toastr.error("El nombre tiene un formato invalido");
        return false;
    }

    return true;
}

//función que me permite validar un vendedor
function validarVendedor(vendedor) {

    if (vacio(vendedor.nombre) || vacio(vendedor.apellido) || vacio(vendedor.telefono) || 
    vacio(vendedor.email) || vacio(vendedor.direccion)) {
        toastr.error("Algunos campos estan vacios");
        return false;
    }

    
    if (!validarTexto(vendedor.nombre)) {
        toastr.error("El nombre tiene un formato invalido");
        return false;
    }

    if (!validarTexto(vendedor.apellido)) {
        toastr.error("El apellido tiene un formato invalido");
        return false;
    }

    if (!validarTelefono(vendedor.telefono)) {
        toastr.error("El teléfono tiene un formato invalido");
        return false;
    }

    
    if (!validarEmail(vendedor.email)) {
        toastr.error("El correo tiene un formato invalido");
        return false;
    }

    return true;
}

//función que me permite validar un proveedor
function validarProveedor(proveedor) {

    if (vacio(proveedor.nombre) || vacio(proveedor.telefono) || 
    vacio(proveedor.email) || vacio(proveedor.direccion)) {
        toastr.error("Algunos campos estan vacios");
        return false;
    }

    
    if (!validarTextoNumero(proveedor.nombre)) {
        toastr.error("El nombre tiene un formato invalido");
        return false;
    }

    if (!validarTelefono(proveedor.telefono)) {
        toastr.error("El teléfono tiene un formato invalido");
        return false;
    }

    
    if (!validarEmail(proveedor.email)) {
        toastr.error("El correo tiene un formato invalido");
        return false;
    }

    return true;
}

//función que me permite validar un cliente
function validarCliente(cliente) {

    if (vacio(cliente.nombre) || vacio(cliente.apellido) || vacio(cliente.telefono) || 
    vacio(cliente.email) || vacio(cliente.direccion)) {
        toastr.error("Algunos campos estan vacios");
        return false;
    }

    
    if (!validarTexto(cliente.nombre)) {
        toastr.error("El nombre tiene un formato invalido");
        return false;
    }

    if (!validarTexto(cliente.apellido)) {
        toastr.error("El apellido tiene un formato invalido");
        return false;
    }

    if (!validarTelefono(cliente.telefono)) {
        toastr.error("El teléfono tiene un formato invalido");
        return false;
    }

    
    if (!validarEmail(cliente.email)) {
        toastr.error("El correo tiene un formato invalido");
        return false;
    }

    return true;
}

//función que me permite validar una categoria
function validarCategoria(categoria) {

    if (vacio(categoria.nombre)) {
        toastr.error("El nombre de categoria esta vacio");
        return false;
    }

    
    if (!validarTexto(categoria.nombre)) {
        toastr.error("El nombre tiene un formato invalido");
        return false;
    }

    return true;
}