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
      selectable:true,
    
      dateClick: function(info) {
        // Mostrar información por defecto para un día vacío
        document.querySelector('.titleDescription h2').textContent = info.date.toLocaleDateString('es-ES', { weekday: 'long' }).toUpperCase();
        document.querySelector('.titleDescription h3').textContent = info.dateStr;
        document.querySelector('.textDescription:nth-child(1) h4').textContent = 'N/A';
        document.querySelector('.textDescription:nth-child(2) h4').textContent = 'N/A';
        document.querySelector('.observacion h5').textContent = 'N/A';
    },
    eventClick: function(info) {
      var title = info.event.title.split(': ');
      var time = title[1];
      var type = title[0];
      var date = info.event.start.toISOString().split('T')[0];
  
      document.querySelector('.titleDescription h2').textContent = info.event.start.toLocaleDateString('es-ES', { weekday: 'long' }).toUpperCase();
      document.querySelector('.titleDescription h3').textContent = date;
  
      if (type === 'Entrada') {
          document.querySelector('.textDescription:nth-child(1) h4').textContent = time;
      } else if (type === 'Salida') {
          document.querySelector('.textDescription:nth-child(2) h4').textContent = time;
      }
      document.querySelector('.observacion h5').textContent = 'Observación del evento';
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

  print_r(title)

