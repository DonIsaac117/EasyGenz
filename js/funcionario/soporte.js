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


  document.addEventListener('DOMContentLoaded', function () {
    const textarea = document.getElementById('reclamo');
    const form = document.getElementById('pqrForm');
    const charLimitMsg = document.getElementById('charLimitMsg');
    const selectPqr = document.getElementById('pqr');
    const maxLength = textarea.maxLength;

    // Mostrar mensaje de límite de caracteres
    textarea.addEventListener('input', function () {
        if (textarea.value.length >= maxLength) {
            charLimitMsg.style.display = 'block';
        } else {
            charLimitMsg.style.display = 'none';
        }
    });

    // Enviar formulario con Enter
    textarea.addEventListener('keydown', function (event) {
        if (event.key === 'Enter' && !event.shiftKey) {
            event.preventDefault();
            enviarFormulario();
        }
    });

    // Enviar formulario con botón
    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Previene el envío por defecto
        enviarFormulario();
    });

    function enviarFormulario() {
        const tipoReclamo = selectPqr.value; // Obtener el valor seleccionado en el select
        alert(`Su ${tipoReclamo} ha sido enviado. ¡Gracias por su comentario!`);
        textarea.value = ''; // Limpia el textarea después de enviar
        charLimitMsg.style.display = 'none'; // Resetea el mensaje de límite de caracteres
        form.submit(); // Envía el formulario
    }
});

