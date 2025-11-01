function cargarImagenZapato() {
    const input = document.querySelector('#file');
    const fileName = document.querySelector('.file-name');
    fileName.textContent = input.files.length > 0 ? input.files[0].name : 'Ninguna Imagen Seleccionada';
}
