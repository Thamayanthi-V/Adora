<?php //print_r($task); ?>
<div class="container">
<section class="content-header">
  <h1>Order Calendar</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Order Calendar</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- /.col -->
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body no-padding">
          <div id="calendar"></div>
        </div>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
</div>

<!-- fullCalendar -->
<script src="<?php echo base_url();?>assets/bower_components/moment/moment.js"></script>
<script src="<?php echo base_url();?>assets/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    //Date for the calendar events (dummy data)
    $('#calendar').fullCalendar({
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : '',
        //right : 'month,agendaWeek,agendaDay,listMonth',
        right : 'month,listMonth',
      },

      buttonText: {
        today: 'today',
        month: 'month',
        week : 'week',
       day  : 'day',
        listMonth: 'List Month',
      },
      showNonCurrentDates: false,
      //Random default events
      events    : [
      <?php foreach ($task as $taskl) { ?>
        {title: '<?=$taskl->order_Number."-".$taskl->task_ProductName;?>', start: '<?=$taskl->task_DeliveryDate;?>', url : '<?=base_url()."/task-details/".$taskl->id;?>',backgroundColor: '<?php if($taskl->task_Status=="Assign"){echo "#f9e606";}else if($taskl->task_Status=="Not Assign"){echo "#dd4b39 ";}else if($taskl->task_Status=="Complete"){echo "#00a65a";} ?>',},
      <?php } ?>
      ],
    })
    
  })
</script>