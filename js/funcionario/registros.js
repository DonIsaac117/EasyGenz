//Perfil

var perfilSpan = document.querySelector(".perfil>span");
var perfilMenu = document.querySelector(".perfilMenu");

perfilSpan.addEventListener("click", function (e) {
  e.stopPropagation();
  perfilMenu.classList.toggle("show");
});

document.addEventListener("click", function (e) {
  if (!perfilMenu.contains(e.target) && !perfilSpan.contains(e.target)) {
    perfilMenu.classList.remove("show");
  }
});

perfilMenu.addEventListener("click", function (e) {
  e.stopPropagation();
});

// Mostrar los elementos con animación después de cargar la página
setTimeout(function () {
  document.querySelector(".main").classList.add("show");
}, 100);

setTimeout(function () {
  document.querySelector(".description").classList.add("show");
}, 700);

function clearFilters() {
  const form = document.getElementById("filterForm");

  // Limpiar todos los campos del formulario
  form
    .querySelectorAll('input[type="text"], input[type="date"]')
    .forEach((input) => {
      input.value = "";
    });
}

document.addEventListener("DOMContentLoaded", function () {
  // Obtener la URL actual
  const url = new URL(window.location.href);

  // Obtener el parámetro de vista
  const vista = url.searchParams.get("vista");

  // Si el parámetro de vista es igual a 'funcionario/registros'
  if (vista === "funcionario/registros") {
    // Crear una nueva URL sin los parámetros de búsqueda
    const newUrl = `${window.location.pathname}?vista=funcionario/registros`;

    // Redirigir a la nueva URL
    window.history.replaceState({}, "", newUrl);
  }
});
