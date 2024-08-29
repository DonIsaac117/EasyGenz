//Calendario
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        initialDate: new Date(),
        headerToolbar: {
            left: 'title',
            right: 'today prev,next'
        },
        eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            hour12: true,
            meridiem: 'short'
        },
        selectable: true,
        locale: 'es',
        dateClick: function(info) {
            // Actualiza la descripción con todos los eventos
            updateDescription(info.dateStr);
        },
        eventDidMount: function(info) {
            var eventDate = new Date(info.event.start);
            var today = new Date();
            if (eventDate.setHours(0, 0, 0, 0) === today.setHours(0, 0, 0, 0)) {
                info.el.style.backgroundColor = 'lightgreen';
            }
            if (info.event.classNames.includes('entrada')) {
                info.el.style.color = 'green';
            }
            if (info.event.classNames.includes('salida')) {
                info.el.style.color = 'blue';
            }
        }
    });
  
    // Renderizar el calendario vacío inicialmente
    calendar.render();
  
    // Variable para almacenar todos los eventos
    var allEvents = [];
  
    // Cargar los eventos desde el controlador
    fetch('./events/instructor_events.php')  // Asegúrate de ajustar la ruta y el ID de usuario
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error(data.error);
                return;
            }
  
            // Añadir los eventos al calendario
            calendar.addEventSource(data.calendarEvents);
  
            // Actualizar la descripción del día actual con todos los eventos
            allEvents = data.allEvents; // Guarda todos los eventos globalmente
            var today = new Date().toISOString().split('T')[0];
            updateDescription(today);
        })
        .catch(error => console.error('Error al cargar eventos:', error));
  
    function updateDescription(date) {
        var titleDescriptionH2 = document.querySelector('.titleDescription h2');
        var titleDescriptionH3 = document.querySelector('.titleDescription h3');
        var textDescriptionEntradaH4 = document.querySelector('.textDescription:nth-child(1) h4');
        var textDescriptionSalidaH4 = document.querySelector('.textDescription:nth-child(2) h4');
        var observacionUL = document.querySelector('.observacion ul'); // Cambiado a <ul>
  
        titleDescriptionH2.textContent = new Date(date).toLocaleDateString('es-ES', { weekday: 'long' }).toUpperCase();
        titleDescriptionH3.textContent = date;
  
        // Filtrar los eventos por la fecha seleccionada
        var selectedDateEvents = allEvents.filter(event => event.start.startsWith(date));
        console.log('Eventos seleccionados:', selectedDateEvents);
  
        var entradas = [];
        var salidas = [];
        var observacionesSet = new Set(); // Utilizar un Set para eliminar duplicados
  
        selectedDateEvents.forEach(event => {
            var time = new Date(event.start).toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit', hour12: true });
            var type = event.className.includes('entrada') ? 'entrada' : 'salida';
            var observation = event.observations || 'N/A';
  
            if (type === 'entrada') {
                entradas.push(time);
            } else if (type === 'salida') {
                salidas.push(time);
            }
            if (observation !== 'N/A') {
                observacionesSet.add(observation); // Añadir al Set para eliminar duplicados
            }
        });
  
        textDescriptionEntradaH4.innerHTML = entradas.length > 0 ? entradas.map(time => `<p>${time}</p>`).join('') : 'N/A';
        textDescriptionSalidaH4.innerHTML = salidas.length > 0 ? salidas.map(time => `<p>${time}</p>`).join('') : 'N/A';
  
        // Mostrar observaciones como una lista
        observacionUL.innerHTML = observacionesSet.size > 0
            ? Array.from(observacionesSet).map(obs => `<li>${obs}</li>`).join('')
            : '<li>N/A</li>';
    }
    document.querySelectorAll('.fc-prev-button, .fc-next-button').forEach(button => {
      button.addEventListener('click', function() {
          setTimeout(function() {
              button.blur(); // Elimina el foco del botón para evitar que quede "presionado"
          }, 70);
      });
    });
  });
  
  
  
  
  
  
  
  
  
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
  setTimeout(function() {
    document.querySelector('.main').classList.add('show');
  
  }, 100); 
  
  setTimeout(function() {
    document.querySelector('.description').classList.add('show');
  }, 700); 
  
  
  