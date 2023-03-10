const carrusel = document.querySelector('.carrusel');
const imagenes = carrusel.querySelectorAll('.carrusel-imagenes img');
const botonAnterior = carrusel.querySelector('.anterior');
const botonSiguiente = carrusel.querySelector('.siguiente');

let posicionActual = 0;

botonAnterior.addEventListener('click', () => {
  posicionActual--;
  actualizarImagen();
});

botonSiguiente.addEventListener('click', () => {
  posicionActual++;
  actualizarImagen();
});

function actualizarImagen() {
  if (posicionActual < 0) {
    posicionActual = imagenes.length - 1;
  } else if (posicionActual >= imagenes.length) {
    posicionActual = 0;
  }

  imagenes.forEach(imagen => {
    imagen.style.transform = `translateX(-${posicionActual * 100}%)`;
  });
}
