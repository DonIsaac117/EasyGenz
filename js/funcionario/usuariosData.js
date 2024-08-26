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
    const modal = document.getElementById("myModal");
    const span = document.getElementsByClassName("close")[0];

    // Abre el modal con datos del usuario
    function openModal(userId) {
        // Establece el valor del campo oculto del formulario
        document.getElementById("modalUserId").value = userId;

        // Envía el formulario para cargar los datos del usuario
        document.getElementById("userForm").submit();
    }

    // Cierra el modal
    span.onclick = function() {
        modal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }

    // Abre el modal cuando se hace clic en el icono
    document.getElementById("perfilIcon").onclick = function() {
        openModal(1); // Cambia el ID del usuario según sea necesario
    }
});