<?php 
use cangak\ajaxcrud\CrudAsset; 
use yii\bootstrap5\Modal;

//CrudAsset::register($this);
?>
<style>
.fc-list-event-title a{
    cursor: pointer;
}
</style>


<?php Modal::begin([
   'options' => [
        'id'=>'ajaxCrudModal',
        'tabindex' => false // important for Select2 to work properly
   ],
   'dialogOptions'=>['class'=>'modal-xl'],
   'closeButton'=>['label'=>'<span aria-hidden=\'true\'>×</span>'],
   'id'=>'ajaxCrudModal',
    'footer'=>'',// always need it for jquery plugin
])?>
<?php Modal::end(); ?>

<div class="row">
	<div class="col-md-12">
		<div class="card custom-card">
			<div class="card-header rounded-bottom-0">
				<h5 class="mt-3">LỊCH BẢO TRÌ/BÃO DƯỠNG THIẾT BỊ</h5>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12 col-xl-12">
						<div id='calendar'></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>
			

<?php

$event = json_encode($listPhieuBaoTri);
$currentDate = date('Y-m-d');

$script = <<< JS
    
//LIST FULLCALENDAR
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'vi',
        height: 'auto',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'listDay,listWeek'
        },
     
        // customize the button names,
        // otherwise they'd all just say "list"
        views: {
            listDay: { buttonText: 'Theo ngày' },
            listWeek: { buttonText: 'Theo tuần' }
        },
        initialView: 'listWeek',
        initialDate: '$currentDate',
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        // eventLimit: true, // allow "more" link when too many events
        dayMaxEvents: true, // allow "more" link when too many events
        events: $event,        
        eventClick: function(info) {
		    /*alert('Event: ' + info.event.title);
		    alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
		    alert('View: ' + info.view.type);		
		    info.el.style.borderColor = 'red';*/
		     //var modal = new ModalRemote('#ajaxCrubModal');
		    var aClick = '<a href="/baotri/phieu-bao-tri/view?id='+ info.event.id +'" role="modal-remote">Click</a>';
	        // Open modal
	        modal.open(aClick, null);
  		}
  
    });

    calendar.render();
});

JS;
$this->registerJs($script, \yii\web\View::POS_END);

?>

<script>
/* document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar1');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
       events: [
            {
              id: 'a',
              title: 'my event',
              start: '2024-06-27'
            }
          ]
    });
    calendar.render();
}); */
</script>