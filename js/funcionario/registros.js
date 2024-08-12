
//Perfil

var perfilSpan = document.querySelector('.perfil>span');
var perfilMenu = document.querySelector('.perfilMenu');

perfilSpan.addEventListener('click', function(e) {
    e.stopPropagation();
    perfilMenu.classList.toggle('show');
});

document.addEventListener('click', function(e) {
    if (!perfilMenu.contains(e.target) && !perfilSpan.contains(e.target)) {
        perfilMenu.classList.remove('show');
    }
});

perfilMenu.addEventListener('click', function(e) {
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

document.querySelectorAll("th").forEach((header) => {
  header.addEventListener("click", function () {
    const table = header.parentElement.parentElement.parentElement;
    const tbody = table.querySelector("tbody");
    const column = Array.from(header.parentNode.children).indexOf(header);
    const order = header.classList.contains("asc") ? "desc" : "asc";

    Array.from(tbody.querySelectorAll("tr"))
      .sort((rowA, rowB) => {
        const cellA = rowA.children[column].textContent.trim();
        const cellB = rowB.children[column].textContent.trim();
        return order === "asc"
          ? cellA.localeCompare(cellB)
          : cellB.localeCompare(cellA);
      })
      .forEach((row) => tbody.appendChild(row));

    document
      .querySelectorAll("th")
      .forEach((th) => th.classList.remove("asc", "desc"));
    header.classList.add(order);

    // Actualizar las flechas
    table
      .querySelectorAll("th .material-icons-sharp")
      .forEach((icon) => (icon.textContent = "arrow_drop_down"));
    header.querySelector(".material-icons-sharp").textContent =
      order === "asc" ? "arrow_drop_up" : "arrow_drop_down";
  });
});

// Función para mostrar el modal
function mostrarModal(id) {
  const modal = document.getElementById(`modal-${id}`);
  modal.style.display = "block";
  modal.classList.add("modal-fade-in");
}

// Función para ocultar el modal
function ocultarModal(id) {
  const modal = document.getElementById(`modal-${id}`);
  modal.classList.remove("modal-fade-in");
  modal.classList.add("modal-fade-out");
  
  // Esperar a que termine la transición antes de ocultar completamente el modal
  setTimeout(() => {
      modal.style.display = "none";
      modal.classList.remove("modal-fade-out");
  }, 300); // Duración de la transición en milisegundos
}

// Cerrar el modal al hacer clic fuera de él
window.onclick = function(event) {
  const modals = document.getElementsByClassName("modal");
  for (let modal of modals) {
      if (event.target == modal) {
          modal.classList.remove("modal-fade-in");
          modal.classList.add("modal-fade-out");
          
          setTimeout(() => {
              modal.style.display = "none";
              modal.classList.remove("modal-fade-out");
          }, 300);
      }
  }
}