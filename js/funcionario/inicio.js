//Calendario
document.addEventListener("DOMContentLoaded", function () {
  var calendarEl = document.getElementById("calendar");
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: "dayGridMonth",
    events: "load_events.php", // Cargamos los eventos desde el archivo PHP
    editable: false,
    selectable: true,
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