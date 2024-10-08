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

  document.addEventListener('DOMContentLoaded', function() {
  const editButtons = document.querySelectorAll('.editBtn');
  const modal = document.getElementById('myModal');
  const closeBtn = document.querySelector('.close');
  const searchInput = document.getElementById('searchInput');

  // Limpiar el input de búsqueda al cargar la página
  window.addEventListener('load', function() {
    searchInput.value = '';
  });

  // Botones para abrir el modal
  editButtons.forEach(button => {
    button.addEventListener('click', function() {
      const userId = this.getAttribute('data-id');

      // Configurar el campo oculto del formulario con el userId
      document.getElementById('modalUserId').value = userId;

      // Realizar una solicitud para obtener los datos del usuario
      fetch('index.php?vista=funcionario/usuariosData', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `userId=${userId}`
      })
      .then(response => response.text())
      .then(data => {
        // Ejecutar el script de respuesta para mostrar el modal y rellenar los datos
        const parser = new DOMParser();
        const htmlDoc = parser.parseFromString(data, 'text/html');
        const scriptElement = htmlDoc.querySelector('script');
        if (scriptElement) {
          eval(scriptElement.textContent);
        }
        // Mostrar el modal con transición
        modal.classList.add('show');
      })
      .catch(error => console.error('Error al obtener datos del usuario:', error));
    });
  });

  

    // Obtener la URL actual
    const url = new URL(window.location.href);
  
    // Obtener el parámetro de vista
    const vista = url.searchParams.get("vista");
  
    // Si el parámetro de vista es igual a 'funcionario/registros'
    if (vista === "funcionario/usuariosData") {
      // Crear una nueva URL sin los parámetros de búsqueda
      const newUrl = `${window.location.pathname}?vista=funcionario/usuariosData`;
  
      // Redirigir a la nueva URL
      window.history.replaceState({}, "", newUrl);
    }
  

 // Cerrar el modal al hacer clic en el botón de cerrar
 closeBtn.addEventListener('click', function() {
  modal.classList.add('fade-out');

  setTimeout(() => {
      modal.classList.remove('show', 'fade-out');
  }, 300);
});

// Cerrar el modal al hacer clic fuera de él
window.addEventListener('click', function(event) {
  if (event.target === modal) {
      modal.classList.add('fade-out');

      setTimeout(() => {
          modal.classList.remove('show', 'fade-out');
      }, 300);
  }
});


  // Ordenar la tabla con iconos
  document.querySelectorAll('th').forEach(header => {
    header.addEventListener('click', function() {
      const table = header.closest('table');
      const tbody = table.querySelector('tbody');
      const column = Array.from(header.parentNode.children).indexOf(header);
      const order = header.classList.contains('asc') ? 'desc' : 'asc';

      Array.from(tbody.querySelectorAll('tr'))
        .sort((rowA, rowB) => {
          const cellA = rowA.children[column].textContent.trim();
          const cellB = rowB.children[column].textContent.trim();
          return order === 'asc'
            ? cellA.localeCompare(cellB)
            : cellB.localeCompare(cellA);
        })
        .forEach(row => tbody.appendChild(row));

      document.querySelectorAll('th').forEach(th => th.classList.remove('asc', 'desc'));
      header.classList.add(order);

      // Actualizar las flechas
      table.querySelectorAll('th .material-icons-sharp')
        .forEach(icon => icon.textContent = 'arrow_drop_down');
      header.querySelector('.material-icons-sharp').textContent = 
        order === 'asc' ? 'arrow_drop_up' : 'arrow_drop_down';
    });
  });
});

document.addEventListener('DOMContentLoaded', function() {
  const togglePassword = document.querySelector('.toggle-password');
  const passwordField = document.querySelector('#modalContrasena');

  togglePassword.addEventListener('click', function() {
      // Alternar el tipo de input entre 'password' y 'text'
      const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordField.setAttribute('type', type);

      // Alternar el ícono
      this.textContent = type === 'password' ? 'visibility_off' : 'visibility';
  });
});




function confirmDelete(event, nombre, apellido) {
  event.preventDefault(); // Previene el envío del formulario

  let confirmacion = confirm(`¿Estás seguro de que deseas eliminar a ${nombre} ${apellido}?`);
  if (confirmacion) {
      // Si el usuario confirma, envía el formulario manualmente
      event.target.closest('form').submit();
  } else {
      // Si no confirma, no envía el formulario
      return false;
  }
}
document.addEventListener('DOMContentLoaded', function() {
    // Seleccionar todos los botones de perfil y menús correspondientes
    const perfilBtns = document.querySelectorAll('.profileBtn');
    const menus = document.querySelectorAll('.profile-menu');
    
    // Obtener el valor del campo oculto
    const isFilteredInput = document.getElementById('isFilteredInput');
    
    // Función para actualizar la posición del menú
    function updateMenuPosition() {
        menus.forEach(menu => {
            if (isFilteredInput.value === 'true') {
                menu.classList.add('menu-fixed');
                menu.classList.remove('menu-absolute');
            } else {
                menu.classList.add('menu-absolute');
                menu.classList.remove('menu-fixed');
            }
        });
    }
    
    // Actualizar la posición del menú al cargar la página
    updateMenuPosition();
    
    // Event listener para el formulario de filtro
    const filtroFormulario = document.querySelector('form');
    filtroFormulario.addEventListener('submit', function() {
        // Establecer el valor del campo oculto a 'true' al enviar el formulario
        isFilteredInput.value = 'true';
    });
});


function toggleMenu(userId) {
  const menu = document.getElementById(`profileMenu_${userId}`);
  
  // Verifica si el menú está visible
  const isVisible = menu.style.display === 'block';
  
  // Cierra todos los menús abiertos
  closeAllMenus();

  if (!isVisible) {
      // Si el menú no está visible, lo mostramos
      menu.style.display = 'block';
  } 
}

function closeAllMenus() {
  // Cierra todos los menús abiertos
  const menus = document.querySelectorAll('.profile-menu');
  menus.forEach(menu => {
      menu.style.display = 'none';
  });
}

window.addEventListener('click', function(event) {
  // Cierra el menú si se hace clic fuera de él
  const target = event.target;
  if (!target.closest('.profileBtn') && !target.closest('.profile-menu')) {
      closeAllMenus();
  }
});
