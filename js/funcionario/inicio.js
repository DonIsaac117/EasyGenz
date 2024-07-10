//Calendario
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
       
        buttonText: {
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana',
            day: 'Día'
        },
        locale: 'es', 
        events: 'load_events.php',
        editable: false,
        selectable: true,
        eventClick: function(info) {
            alert('Evento: ' + info.event.title);
        },
        eventMouseEnter: function(info) {
            info.el.style.backgroundColor = info.event.classNames.includes('entrada') ? '#388e3c' : '#d32f2f';
        },
        eventMouseLeave: function(info) {
            info.el.style.backgroundColor = info.event.classNames.includes('entrada') ? '#4caf50' : '#f44336';
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