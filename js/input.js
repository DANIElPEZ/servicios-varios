const input = document.querySelector('.main-input');
const findIcon = document.querySelector('.find');
const searchContainer = document.querySelector('.main-search');

// Mostrar el input al hacer click en el icono
findIcon.addEventListener('click', function () {
     findIcon.style.position='relative';
     input.classList.add('active');
     input.focus(); // Le damos foco al input
});

// Cerrar el input cuando se haga clic fuera del contenedor del buscador
document.addEventListener('click', function (event) {
     if (!searchContainer.contains(event.target)) {
          if(window.innerWidth <= 730) findIcon.style.position='absolute';
          else findIcon.style.position='static';
          input.classList.remove('active');
     }
});

window.addEventListener('load', ()=>{
     if(window.innerWidth <= 730) findIcon.style.position='absolute';
     else findIcon.style.position='static';
});

window.addEventListener('resize', ()=>{
     if(window.innerWidth <= 730) findIcon.style.position='absolute';
     else findIcon.style.position='static';
});