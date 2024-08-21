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
      eventSources: [
          {
              url: './events/load_events.php',
              method: 'POST',
              failure: function() {
                  alert('Error al cargar eventos');
              },
              success: function(response) {
                try {
                    console.log('Datos recibidos:', response);

                    if (response.error) {
                        console.error('Error:', response.error);
                        return;
                    }

                    if (!response.calendarEvents || !response.allEvents) {
                        console.error('La respuesta no contiene los datos esperados.');
                        return;
                    }

                  
                    
                    // Añadir eventos al calendario
                    calendar.addEventSource(response.calendarEvents);
                    
                    // Actualiza el div de descripción
                    updateDescription(new Date().toISOString().split('T')[0]);
                } catch (e) {
                    console.error('Error procesando la respuesta:', e);
                }
            }
          }
      ],
      eventTimeFormat: {
          hour: '2-digit',
          minute: '2-digit',
          hour12: true,
          meridiem: 'short'
      },
      selectable: true,
      locale: 'es',
      dateClick: function(info) {
          var date = info.dateStr;
          updateDescription(date);
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

  calendar.render();

  function updateDescription(date) {
      var titleDescriptionH2 = document.querySelector('.titleDescription h2');
      var titleDescriptionH3 = document.querySelector('.titleDescription h3');
      var textDescriptionEntradaH4 = document.querySelector('.textDescription:nth-child(1) h4');
      var textDescriptionSalidaH4 = document.querySelector('.textDescription:nth-child(2) h4');
      var observacionH5 = document.querySelector('.observacion h5');

      titleDescriptionH2.textContent = new Date(date).toLocaleDateString('es-ES', { weekday: 'long' }).toUpperCase();
      titleDescriptionH3.textContent = date;

      // Filtra los eventos del día seleccionado
      var selectedDateEvents = calendar.getEvents().filter(event => event.startStr.startsWith(date));
      console.log('Eventos seleccionados:', selectedDateEvents);

      var entradas = [];
      var salidas = [];
      var observaciones = [];

      selectedDateEvents.forEach(event => {
          var time = event.start.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit', hour12: true });
          var type = event.classNames.includes('entrada') ? 'entrada' : 'salida';
          var observation = event.extendedProps.observations || 'N/A';

          if (type === 'entrada') {
              entradas.push(time);
          } else if (type === 'salida') {
              salidas.push(time);
          }
          observaciones.push(observation);
      });

      textDescriptionEntradaH4.innerHTML = entradas.length > 0 ? entradas.map(time => `<p>${time}</p>`).join('') : 'N/A';
      textDescriptionSalidaH4.innerHTML = salidas.length > 0 ? salidas.map(time => `<p>${time}</p>`).join('') : 'N/A';
      observacionH5.innerHTML = observaciones.length > 0 ? observaciones.map(obs => `<p>${obs}</p>`).join('') : 'N/A';
  }

  // Configuración inicial para hoy
  updateDescription(new Date().toISOString().split('T')[0]);
});



<<<<<<< Updated upstream
=======






>>>>>>> Stashed changes
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


