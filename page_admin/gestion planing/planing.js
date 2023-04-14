// Initialisation de FullCalendar
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'dayGrid', 'timeGrid', 'list', 'interaction' ],
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },
      defaultView: 'timeGridWeek',
      editable: true,
      eventResize: function(info) {
        updateReservation(info.event);
      },
      eventDrop: function(info) {
        updateReservation(info.event);
      },
      eventClick: function(info) {
        var reservation = info.event.extendedProps.reservation;
        $('#id').val(reservation.id);
        $('#title').val(reservation.title);
        $('#start').val(moment(reservation.start).format('YYYY-MM-DD HH:mm:ss'));
        $('#end').val(moment(reservation.end).format('YYYY-MM-DD HH:mm:ss'));
        $('#instructor').val(reservation.instructor);
        $('#submitButton').html('Modifier');
        $('#reservationModal').modal('show');
      },
      events: 'load.php',
    });
  
    calendar.render();
  
    // Fonction pour créer une nouvelle réservation
    $('#reservationForm').on('submit', function(e) {
      e.preventDefault();
  
      var id = $('#id').val();
      var title = $('#title').val();
      var start = $('#start').val();
      var end = $('#end').val();
      var instructor = $('#instructor').val();
  
      $.ajax({
        url: 'create.php',
        type: 'POST',
        data: {
          id: id,
          title: title,
          start: start,
          end: end,
          instructor: instructor
        },
        success: function(response) {
          calendar.refetchEvents();
          $('#reservationModal').modal('hide');
        }
      });
    });
  
    // Fonction pour mettre à jour une réservation existante
    function updateReservation(event) {
      var id = event.extendedProps.reservation.id;
      var start = moment(event.start).format('YYYY-MM-DD HH:mm:ss');
      var end = moment(event.end).format('YYYY-MM-DD HH:mm:ss');
  
      $.ajax({
        url: 'update.php',
        type: 'POST',
        data: {
          id: id,
          start: start,
          end: end
        },
        success: function(response) {
          calendar.refetchEvents();
        }
      });
    }
  
    // Fonction pour supprimer une réservation
    $('#deleteButton').on('click', function(e) {
      var id = $('#id').val();
  
      $.ajax({
        url: 'delete.php',
        type: 'POST',
        data: {
          id: id
        },
        success: function(response) {
          calendar.refetchEvents();
          $('#reservationModal').modal('hide');
        }
      });
    });
  
    // Fonction pour effacer les champs du formulaire
    $('#reservationModal').on('hidden.bs.modal', function() {
      $('#id').val('');
      $('#title').val('');
      $('#start').val('');
      $('#end').val('');
      $('#instructor').val('');
      $('#submitButton').html('Enregistrer');
    });
  
    // Initialisation des composants datepicker
    $('.datetimepicker').datepicker({
      format: 'yyyy-mm-dd hh:ii:ss',
      autoclose: true,
      locale: 'fr'
    });
  });
  