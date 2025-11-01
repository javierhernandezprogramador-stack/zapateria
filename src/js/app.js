//Variables globales
let contadorIndex = 0;
let contadorNike = 0;

//Llamar funciones
carrusel();

//Declaración de funciones

function carrusel() {
    setInterval(showNextImage, 3000); // Cambia la imagen cada 3 segundos

    //setInterval(siguienteNike, 3000);
}

function showNextImage() {
    const carouselInner = document.querySelector('.carrusel-contenido');
    const items = document.querySelectorAll('.carrusel-item');
    contadorIndex = (contadorIndex + 1) % items.length;
    carouselInner.style.transform = `translateX(-${contadorIndex * 100}%)`;
}

function siguienteNike() {
    const carruselCont = document.querySelector('.contenido__zapatos');
    const items = document.querySelectorAll('.zapato');
    contadorNike = (contadorNike + 1) % items.length;
    carruselCont.style.transform = `translateX(-${contadorNike * 20}%)`;
}
