const listElements = document.querySelectorAll('.panel__boton-click');

listElements.forEach(listElement => {
    listElement.addEventListener('click', () => {
        listElement.classList.toggle('arrow'); //Agrega cuando toca la primera vez y la quita en la sugunda.

        let height = 0;
        let menu = listElement.nextElementSibling; //obtiene al hermano adyacente

        if(menu.clientHeight == "0") { //compara el tamaño actual
            height = menu.scrollHeight; //Obtiene el tamaño minimo para el menu
        }

        menu.style.height = `${height}px`;
    });
});