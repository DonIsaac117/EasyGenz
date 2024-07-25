//Calendario
/*document.addEventListener("DOMContentLoaded", function () {
  var calendarEl = document.getElementById("calendar");
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: "dayGridMonth",
    events: "loadEvents.php", // Cargamos los eventos desde el archivo PHP
    editable: false,
    selectable: true,
  });
  calendar.render();
});
*/
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
      header: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth'
      },
      eventSources: {
          url: './events/load_events.php',
          method: 'POST',
          failure: function() {
            alert('Error intenta otro metodo');
        },
      },
      eventTimeFormat: {
        hour: '2-digit',
        minute: '2-digit',
        hour12: true,
        meridiem: 'short'
       },
      selectable:true,
      
    
      dateClick: function(info) {
        var date = info.dateStr;
        titleDescriptionH2.textContent = info.date.toLocaleDateString('es-ES', { weekday: 'long' }).toUpperCase();
        titleDescriptionH3.textContent = date;
        textDescriptionEntradaH4.textContent = 'N/A';
        textDescriptionSalidaH4.textContent = 'N/A';
        observacionH5.textContent = 'N/A';

        var selectedDateEvents = calendar.getEvents().filter(event => event.startStr.startsWith(date));
        if (selectedDateEvents.length > 0) {
            selectedDateEvents.forEach(event => {
                if (event.classNames.includes('entrada')) {
                    textDescriptionEntradaH4.textContent = event.start.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit', hour12: true });
                } else if (event.classNames.includes('salida')) {
                    textDescriptionSalidaH4.textContent = event.start.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit', hour12: true });
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
      titleDescriptionH3.textContent = date;

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

      observacionH5.textContent = 'Observación del evento';
  } else {
      titleDescriptionH2.textContent = today.toLocaleDateString('es-ES', { weekday: 'long' }).toUpperCase();
      titleDescriptionH3.textContent = todayStr;
      textDescriptionEntradaH4.textContent = 'N/A';
      textDescriptionSalidaH4.textContent = 'N/A';
      observacionH5.textContent = 'N/A';
  }
});


//Perfil
document.getElementById("perfil").addEventListener("click", function () {
    var menu = document.getElementById("perfilMenu");
    if (menu.style.display === "none" || menu.style.display === "") {
      menu.style.display = "block";
      perfil.style.color = "rgb(0, 0, 0, 0.6)";
    } else {
      menu.style.display = "none";
      perfil.style.color = "";
    }
  });

  

