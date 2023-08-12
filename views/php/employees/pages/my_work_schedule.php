<?php
require '../../../../vendor/autoload.php';
require_once '../layout/session_start.php';

use MyApp\Employee;

$employee = new Employee();
$schdule_time = $employee->getUserScheduleEvents();

ob_start();
?>
<div class="container mt-4">
  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Horaire de travail pour <?php echo date('F Y'); ?></h5>
          <small class="text-muted float-end">Horaire mensuel</small>
        </div>
        <div class="card-body">
          <div id="calendar"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var userScheduleEvents = <?php echo json_encode($schdule_time); ?>

    $('#calendar').fullCalendar({
      events: userScheduleEvents,
      defaultView: 'agendaWeek',
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay' 
      },
      editable: false, 
      eventLimit: true, 
      eventRender: function(event, element) {
        element.addClass('fc-event');
      },
      dayRender: function(date, cell) {
        if (moment().startOf('day').isSame(date)) {
          cell.addClass('fc-today');
        }
      },
      views: {
        agendaWeek: {
          allDaySlot: false, 
        },
        agendaDay: {
          allDaySlot: false 
        }
      }
    });
  });
</script>

<?php
$pageContent = ob_get_clean();
$pageTitle = 'My Work Schudle';
require_once '../layout/index.php';
?>