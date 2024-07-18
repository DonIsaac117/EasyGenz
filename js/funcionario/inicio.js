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
      header: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth'
      },
      events: {
          url: './events/load_events.php',
          method: 'POST',
          failure: function() {
              alert('Error al cargar los eventos');
          }
      },
      eventRender: function(info) {
          var eventDate = new Date(info.event.start);
          var today = new Date();
          if (eventDate.setHours(0,0,0,0) === today.setHours(0,0,0,0)) {
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

  

