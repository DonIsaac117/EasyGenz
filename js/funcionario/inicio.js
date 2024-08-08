//Calendario

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var titleDescriptionH2 = document.querySelector('.titleDescription h2');
  var titleDescriptionH3 = document.querySelector('.titleDescription h3');
  var textDescriptionEntradaH4 = document.querySelector('.textDescription:nth-child(1) h4');
  var textDescriptionSalidaH4 = document.querySelector('.textDescription:nth-child(2) h4');
  var observacionH5 = document.querySelector('.observacion h5');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: "dayGridMonth",  
    initialDate: new Date(),
    headerToolbar: {
      left: 'title',
     
      right: 'today prev,next'
  },
      eventSources: {
          url: './events/load_events.php',
          method: 'POST',
          failure: function() {
            alert('Error intenta otro metodo');
        },
      },
      buttonText: {
        today: 'Hoy',
        month: 'Mes',
        week: 'Semana',
        day: 'Día',
        list: 'Lista',
    },

      eventTimeFormat: {
        hour: '2-digit',
        minute: '2-digit',
        hour12: true,
        meridiem: 'short'
       },
      selectable:true,
      locale: 'es',
      
    
      dateClick: function(info) {
        var date = info.dateStr;
        titleDescriptionH2.textContent = info.date.toLocaleDateString('es-ES', { weekday: 'long' }).toUpperCase();
        titleDescriptionH3.textContent =date;
        textDescriptionEntradaH4.textContent = 'N/A';
        textDescriptionSalidaH4.textContent = 'N/A';
        observacionH5.textContent = 'N/A';

        var selectedDateEvents = calendar.getEvents().filter(event => event.startStr.startsWith(date));
        if (selectedDateEvents.length > 0) {
            selectedDateEvents.forEach(event => {
                if (event.classNames.includes('entrada')) {
                    textDescriptionEntradaH4.textContent = event.start.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit', hour12: true });
                    observacionH5.textContent = event.extendedProps.observations || 'N/A';
                } else if (event.classNames.includes('salida')) {
                    textDescriptionSalidaH4.textContent = event.start.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit', hour12: true });
                    observacionH5.textContent = event.extendedProps.observations || 'N/A';
                }
            });
        }
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

  
  var today = new Date();
  var todayStr = today.toISOString().split('T')[0];
  var todayEvents = calendar.getEvents().filter(event => event.startStr.startsWith(todayStr));

  if (todayEvents.length > 0) {
      var firstEvent = todayEvents[0];
      
      var date = firstEvent.start.toISOString().split('T')[0];

      titleDescriptionH2.textContent = firstEvent.start.toLocaleDateString('es-ES', { weekday: 'long' }).toUpperCase();
      titleDescriptionH3.textContent =date;

      todayEvents.forEach(event => {
          var title = event.title.split(': ');
          var time = title[1];
          var type = title[0];

          if (type === 'Entrada') {
              textDescriptionEntradaH4.textContent = time;
          } else if (type === 'Salida') {
              textDescriptionSalidaH4.textContent = time;
          }
      });

      observacionH5.textContent = event.extendedProps.observations || 'N/A';
  } else {
      titleDescriptionH2.textContent = today.toLocaleDateString('es-ES', { weekday: 'long' }).toUpperCase();
      titleDescriptionH3.textContent =todayStr;
      textDescriptionEntradaH4.textContent = 'N/A';
      textDescriptionSalidaH4.textContent = 'N/A';
      observacionH5.textContent = 'N/A';
      observacionH5.textContent = 'N/A';
  }
  document.querySelectorAll('.fc-prev-button, .fc-next-button').forEach(button => {
    button.addEventListener('click', function() {
        setTimeout(function() {
            button.blur(); // Elimina el foco del botón para evitar que quede "presionado"
        }, 100);
    });
  });
  
 
      
});


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
setTimeout(function() {
  document.querySelector('.main').classList.add('show');

}, 100); 

setTimeout(function() {
  document.querySelector('.description').classList.add('show');
}, 700); 


