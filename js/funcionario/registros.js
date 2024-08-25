
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

function mostrarModal(id) {
  // Eliminar la clase seleccionada de cualquier fila previamente seleccionada
  const filas = document.querySelectorAll('tr.selected');
  filas.forEach(fila => fila.classList.remove('selected'));

  // Añadir la clase seleccionada a la fila actual
  const fila = document.querySelector(`tr[onclick="mostrarModal(${id})"]`);
  fila.classList.add('selected');

  // Mostrar el modal
  const modal = document.getElementById(`modal-${id}`);
  modal.classList.remove('fade-out'); 
  modal.style.display = 'block';
  modal.style.opacity = 0;
  
 
  setTimeout(() => {
      modal.style.opacity = 1;
  }, 10);
}

function ocultarModal(id) {
  const modal = document.getElementById(`modal-${id}`);
  modal.style.opacity = 0;

 
  setTimeout(() => {
      modal.classList.add('fade-out');
      setTimeout(() => {
          modal.style.display = 'none';
      }, 300); 
  }, 300); 
}

// Cerrar el modal al hacer clic fuera del mismo
window.onclick = function(event) {
  const modals = document.querySelectorAll('.modal');
  modals.forEach(modal => {
      if (event.target === modal) {
          const modalId = modal.id.split('-')[1];
          ocultarModal(modalId);
      }
  });
}

//Descargar consultas sql en PDF
async function generatePDF() {
  // Verificar si hay filtros aplicados
  const filters = document.querySelectorAll('.filter-input');
  let hasFilters = false;

  filters.forEach(filter => {
      if (filter.value.trim() !== '') {
          hasFilters = true;
      }
  });

  // Si no hay filtros aplicados, mostrar una alerta y no generar el PDF
  if (!hasFilters) {
      alert('Por favor, aplica al menos un filtro antes de generar el PDF.');
      return;
  }

  const { jsPDF } = window.jspdf;
  const pdf = new jsPDF('landscape');

  // Remover íconos dentro de los encabezados (th) temporalmente
  const iconSpans = document.querySelectorAll('th span.material-icons-sharp');
  let removedIcons = [];
  
  iconSpans.forEach(icon => {
      removedIcons.push(icon.parentNode.removeChild(icon));
  });

  // Agregar título al PDF
  pdf.setFontSize(16);
  pdf.text('Registros de asistencia', 10, 10);

  // Agregar la fecha actual en el lado derecho del título
  const currentDate = new Date().toLocaleDateString();
  pdf.text(`Fecha: ${currentDate}`, pdf.internal.pageSize.width - 60, 10); // Ajusta las coordenadas si es necesario

  // Usar autoTable para generar la tabla en el PDF
  pdf.autoTable({
      head: [Array.from(document.querySelectorAll('#tabla thead th')).map(th => th.textContent.trim())],
      body: Array.from(document.querySelectorAll('#tabla tbody tr')).map(tr => {
          return Array.from(tr.querySelectorAll('td')).map(td => td.textContent.trim());
      }),
      startY: 20,
      theme: 'grid',
      headStyles: {
          textColor: [0, 0, 0], // Color de texto negro
      }
  });

  // Restaurar los íconos después de generar el PDF
  const thElements = document.querySelectorAll('#tabla thead th');
  removedIcons.forEach((icon, index) => {
      thElements[index].appendChild(icon);
  });

  // Guardar el PDF
  pdf.save('Tabla_registros.pdf');
}