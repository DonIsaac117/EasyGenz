//Perfil

var perfilSpan = document.querySelector('.perfil>span');
var perfilMenu = document.querySelector('.perfilMenu');

perfilSpan.addEventListener('click', function(e) {
    e.stopPropagation();
    perfilMenu.classList.toggle('show');
    
    if (perfilMenu.classList.contains('show')) {
        perfilSpan.classList.add('active');
    } else {
        perfilSpan.classList.remove('active');
    }
});

document.addEventListener('click', function(e) {
    if (!perfilMenu.contains(e.target) && !perfilSpan.contains(e.target)) {
        perfilMenu.classList.remove('show');
        perfilSpan.classList.remove('active');
    }
});

perfilMenu.addEventListener('click', function(e) {
    e.stopPropagation();
});

// Mostrar los elementos con animación después de cargar la página
setTimeout(function () {
    document.querySelector(".main").classList.add("show");
  }, 100);

  const textarea = document.getElementById('reclamos');
  const form = document.getElementById('pqr');

  // Permitir el envío con la tecla Enter
  textarea.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' && !e.shiftKey) {
          e.preventDefault(); // Prevenir el salto de línea
          form.submit(); // Enviar el formulario
      }
  });

  // Mantener el scroll en la parte inferior cuando el texto se expanda
  textarea.addEventListener('input', function () {
      textarea.scrollTop = textarea.scrollHeight;
  });
