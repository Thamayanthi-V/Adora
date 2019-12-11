<!-- Full Width Column -->
<div class="content-wrapper">
   <div class="container">
      <section class="content-header">
         <h1>Production</h1>
         <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Production</li>
         </ol>
      </section>
      <!--Order New-->
      <section class="content">
         <div class="row">
            <div class="box box-primary">
                  <!--Timer-->
                  <div class="card card-info">
                     <div class="card-header">
                        <h3 class="card-title">Timer</h3>
                     </div>
                     <div class="card-body light-bg">
                        <div class="row">
                           <div class="col-md-3"></div>
                           <div class="col-md-6">
                              <div class="text-center card-body" id="chronoExample">
                                  <div class="values form-control" style="margin-bottom: 10px">
                                    <?php 
                                    if($taskassign->TA_StartDateTime!='' && $taskassign->TA_TimeType=='PAUSE')
                                       {echo gmdate("H:i:s", (int)$taskassign->TA_CalTime);}
                                    else if($taskassign->TA_TimeType=='END')
                                       {echo gmdate("H:i:s", (int)$taskassign->TA_CalTime);}
                                    else {echo "00:00:00";}
                                    ?>
                                  </div>
                                  <div>
                                    <?php if($taskassign->TA_TimeType=='END'){echo "<span>Thank You!.. Your Task Completed Successfully</span>";}else{ ?>
                                      <button class="startButton btn btn-success"><i class="fa fa-play"></i></button>
                                    <?php if($taskassign->TA_StartDateTime!=''){?>
                                      <button class="pauseButton btn btn-primary"><i class="fa fa-pause"></i></button>
                                      <button class="stopButton btn btn-danger"><i class="fa fa-stop"></i></button>
                                   <?php } }?>
                                  </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card card-info">
                     <div class="card-header">
                        <h3 class="card-title">Item Details</h3>
                     </div>
                     <div class="card-body light-bg">
                     <div class="row">
                        <div class="form-group col-md-3">
                           <label>Order No</label>
                           <input type="text" class="form-control" readonly="" value="<?=$taskdata->order_Number;?>">
                        </div>
                        <div class="form-group col-md-3">
                           <label>Item Code</label>
                           <input type="text" class="form-control" readonly="" value="<?=$taskdata->task_ItemCode;?>">
                        </div>
                        <div class="form-group col-md-3">
                           <label>Delivery date</label>
                           <input type="text" class="form-control" readonly="" value="<?=$taskdata->task_DeliveryDate;?>">
                        </div>
                        <div class="form-group col-md-3">
                           <label>Item Name</label>
                           <input type="text" class="form-control" readonly="" value="<?=$taskdata->product_Name;?>">
                        </div>
                        <div class="form-group col-md-12">
                           <label>Comments</label>
                           <textarea class="form-control" readonly=""><?=$taskdata->task_ProductComment;?>
                           </textarea>
                        </div>
                     </div>
                     </div>
                  </div>
                  
                  <!-- measurement -->
                  <div class="card card-info">
                     <div class="card-header">
                        <h3 class="card-title">Measurements</h3>
                     </div>
                     <div class="card-body">
                        <div class="row">
                           <div class="col-12 col-md-6">
                              <div class="card card-secondary light-bg">
                                 <div class="card-header">
                                    <h3 class="box-title text-center">Top</h3>
                                    <?php 
                                       $mtop = json_decode($taskdata->order_MeasurmentTop, true);
                                    ?>
                                 </div>
                                 <!-- /.card-header -->
                                 <!-- form start -->
                                 <div class="card-body">
                                    <div class="row">
                                       <div class="form-group col-xs-6 col-sm-4">
                                          <!-- text input -->
                                          <div class="form-group">
                                             <label>Length</label>
                                             <input type="text" class="form-control" value="<?=$mtop[toplength];?>" readonly="">
                                          </div>
                                       </div>
                                       <div class="form-group col-xs-6 col-sm-4">
                                          <div class="form-group">
                                             <label>Shoulder</label>
                                             <input type="text" class="form-control" value="<?=$mtop[topshoulder];?>" readonly="">
                                          </div>
                                       </div>
                                       <div class="form-group col-xs-6 col-sm-4">
                                          <div class="form-group">
                                             <label>Chest</label>
                                             <input type="text" class="form-control" value="<?=$mtop[topchest];?>" readonly="">
                                          </div>
                                       </div>
                                       <!-- /.form group -->
                                       <div class="form-group col-xs-6 col-sm-4">
                                          <div class="form-group">
                                             <label>Waist</label>
                                             <input type="text" class="form-control" value="<?=$mtop[topwaist];?>" readonly="">
                                          </div>
                                       </div>
                                       <div class="form-group col-xs-6 col-sm-4">
                                          <div class="form-group">
                                             <label>Hip</label>
                                             <input type="text" class="form-control" value="<?=$mtop[tophip];?>" readonly="">
                                          </div>
                                       </div>
                                       <div class="form-group col-xs-6 col-sm-4">
                                          <div class="form-group">
                                             <label>Sit Open</label>
                                             <input type="text" class="form-control" value="<?=$mtop[topsitopen];?>" readonly="">
                                          </div>
                                       </div>
                                       <div class="form-group col-xs-6 col-sm-4">
                                          <div class="form-group">
                                             <label>Armhole</label>
                                             <input type="text" class="form-control" value="<?=$mtop[toparmhole];?>" readonly="">
                                          </div>
                                       </div>
                                       <div class="form-group col-xs-6 col-sm-4">
                                          <div class="form-group">
                                             <label>Sleeve Length</label>
                                             <input type="text" class="form-control" value="<?=$mtop[topsleevelength];?>" readonly="">
                                          </div>
                                       </div>
                                       <div class="form-group col-xs-6 col-sm-4">
                                          <div class="form-group">
                                             <label>Sleeve Open</label>
                                             <input type="text" class="form-control" value="<?=$mtop[topsleeveopen];?>" readonly="">
                                          </div>
                                       </div>
                                       <div class="form-group col-xs-6 col-sm-4">
                                          <div class="form-group">
                                             <label>Neck Width</label>
                                             <input type="text" class="form-control" value="<?=$mtop[topsneckwidth];?>" readonly="">
                                          </div>
                                       </div>
                                       <div class="form-group col-xs-6 col-sm-4">
                                          <div class="form-group">
                                             <label>Neck Drop</label>
                                             <input type="text" class="form-control" value="<?=$mtop[topsneckdrop];?>" readonly="">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- /.card-footer -->
                              </div>
                           </div>
                           <div class="col-12 col-md-6">
                              <div class="card card-secondary light-bg">
                                 <div class="card-header">
                                    <h3 class="box-title text-center">Bottom</h3>
                                    <?php 
                                       $mbottom = json_decode($taskdata->order_MeasurmentBottom, true);
                                    ?>
                                 </div>
                                 <!-- /.card-header -->
                                 <!-- form start -->
                                 <div class="card-body">
                                    <div class="row">
                                       <div class="form-group col-xs-6 col-sm-4">
                                          <!-- text input -->
                                          <div class="form-group">
                                             <label>Length</label>
                                             <input type="text" class="form-control" value="<?=$mbottom[bottomlength];?>" readonly="">
                                          </div>
                                       </div>
                                       <div class="form-group col-xs-6 col-sm-4">
                                          <div class="form-group">
                                             <label>Hip</label>
                                             <input type="text" class="form-control" value="<?=$mbottom[bottomhip];?>" readonly="">
                                          </div>
                                       </div>
                                       <div class="form-group col-xs-6 col-sm-4">
                                          <div class="form-group">
                                             <label>Thigh</label>
                                             <input type="text" class="form-control" value="<?=$mbottom[bottomthigh];?>" readonly="">
                                          </div>
                                       </div>
                                       <div class="form-group col-xs-6 col-sm-4">
                                          <div class="form-group">
                                             <label>Knee</label>
                                             <input type="text" class="form-control" value="<?=$mbottom[bottomknee];?>" readonly="">
                                          </div>
                                       </div>
                                       <div class="form-group col-xs-6 col-sm-4">
                                          <div class="form-group">
                                             <label>Calf</label>
                                             <input type="text" class="form-control" value="<?=$mbottom[bottomcalf];?>" readonly="">
                                          </div>
                                       </div>
                                       <div class="form-group col-xs-6 col-sm-4">
                                          <div class="form-group">
                                             <label>Leg Open</label>
                                             <input type="text" class="form-control" value="<?=$mbottom[bottomlegopen];?>" readonly="">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Drawing -->
                  <div class="card card-info">
                     <div class="card-header">
                     </div>
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="light-bg">
                                 <h3 class="box-title text-center">Drawing</h3>
                                 <div class="gallery">
                                    <div id="carousel-example-generic2" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                          <div class="item active">
                                            <img src="data:image/png;base64,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" alt="First slide">
                                          </div>
                                          <div class="item">
                                            <img src="data:image/png;base64,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" alt="Second slide">
                                          </div>
                                        </div>
                                        <a class="left carousel-control" href="#carousel-example-generic2" data-slide="prev">
                                          <span class="fa fa-angle-left"></span>
                                        </a>
                                        <a class="right carousel-control" href="#carousel-example-generic2" data-slide="next">
                                          <span class="fa fa-angle-right"></span>
                                        </a>
                                   </div>
                                 </div>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="light-bg">
                                 <h3 class="box-title text-center">Upload Image</h3>
                                 <div class="gallery">
                                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" >
                                        <div class="carousel-inner" data-toggle="modal" data-target="#uploadPopup1">
                                          <div class="item active">
                                            <img src="https://5.imimg.com/data5/AS/JC/MY-26029543/brocade-blouse-fabric-500x500.jpg" alt="First slide">
                                          </div>
                                          <div class="item">
                                            <img src="https://5.imimg.com/data5/AS/JC/MY-26029543/brocade-blouse-fabric-500x500.jpg" alt="Second slide">
                                          </div>
                                        </div>
                                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                          <span class="fa fa-angle-left"></span>
                                        </a>
                                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                          <span class="fa fa-angle-right"></span>
                                        </a>
                                   </div>
                                 </div>
                              </div>
                           </div>
                           <!-- Upload Popup -->
                           <div id="uploadPopup1" class="modal fade" role="dialog">
                             <div class="modal-dialog">
                               <!-- Modal content-->
                               <div class="modal-content">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <div id="carousel-example-generic-up" class="carousel slide" data-ride="carousel" data-toggle="modal" data-target="#uploadPopup">
                                        <div class="carousel-inner">
                                          <div class="item active">
                                            <img src="https://5.imimg.com/data5/AS/JC/MY-26029543/brocade-blouse-fabric-500x500.jpg" alt="First slide">
                                          </div>
                                          <div class="item">
                                            <img src="https://5.imimg.com/data5/AS/JC/MY-26029543/brocade-blouse-fabric-500x500.jpg" alt="Second slide">
                                          </div>
                                        </div>
                                        <a class="left carousel-control" href="#carousel-example-generic-up" data-slide="prev">
                                          <span class="fa fa-angle-left"></span>
                                        </a>
                                        <a class="right carousel-control" href="#carousel-example-generic-up" data-slide="next">
                                          <span class="fa fa-angle-right"></span>
                                        </a>
                                   </div>
                               </div>
                             </div>
                           </div>

                        </div>
                     </div>
                  </div>
            </div>
         </div>
      </section>
   </div>
   <!-- /.container -->
</div>
<!-- /.content-wrapper -->
<?php 
$sdate = $taskassign->TA_StartDateTime;
$pdate = $taskassign->TA_PauseDateTime;
$edate = $taskassign->TA_EndDateTime;
$ttype = $taskassign->TA_TimeType;
$caltime = $taskassign->TA_CalTime;

$cdate = date('Y-m-d H:i:s');
$ctime = strtotime($cdate);
$stime = strtotime($sdate);
$ptime = strtotime($pdate);

if($caltime==''){
   $timesec = abs($ctime - $stime); 
}
else if($caltime!='' && $ttype=='PAUSE'){
   $timesec = $caltime; 
}
else if($caltime!='' && $ttype=='START'){
   $ptimesec = abs($ctime - $ptime); 
   $timesec = $caltime+$ptimesec;
}
?>
<!--easy-timer-->
<script src="<?=base_url();?>assets/plugins/easy-timer/easytimer.min.js"></script>
<script type="text/javascript"> 
var timer = new Timer();

var sdatetime = '<?=$taskassign->TA_StartDateTime;?>'
var pdatetime = '<?=$pdate;?>';
var cdt = '<?=date('Y-m-d H:i:s');?>';
var tid = '<?=$TAid; ?>';
var uid = '<?=$this->data["LoginID"];?>';
var tsec = '<?=$timesec;?>';
var ttype = '<?=$taskassign->TA_TimeType;?>';
var caltime = '<?=$caltime;?>';

if(sdatetime!='' && ttype=='START'){
   timer.start({precision: 'seconds', startValues: {seconds: <?=$timesec;?>}});
} 
else if(sdatetime!='' && ttype=='PAUSE'){ 
}

/*Insert Start Time*/
$('#chronoExample .startButton').click(function () {
   if(sdatetime==''){
     url="<?php echo base_url()?>TaskProcess/StartTaskTime";
     $.ajax({
         url: url,
         type: 'POST',
         dataType: 'json',
         data: {cdt:cdt,tid:tid,uid:uid},
         success: function (data) {
            timer.start();
            alert('Production Start Success');
            location.reload();
         } 
       });
    } 
   else if(sdatetime!='' && ttype=='PAUSE'){
      url="<?php echo base_url()?>TaskProcess/PauseStartTaskTime";
     $.ajax({
         url: url,
         type: 'POST',
         dataType: 'json',
         data: {tid:tid,cdt:cdt},
         success: function (data) {
            timer.start();
            alert('Production Pause Start Success');
            location.reload();
         } 
       });
   }

});
/*End Insert Start Time*/

/*Start Pasue Time*/
$('#chronoExample .pauseButton').click(function () {
  url="<?php echo base_url()?>TaskProcess/PauseTaskTime";
  $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      data: {tid:tid,sdatetime:sdatetime,cdt:cdt,pdatetime:pdatetime,caltime:caltime},
      success: function (data) {
         timer.pause();
         alert('Production Pause Success');
         location.reload();
      } 
    });
});
/*End Pasue Time*/
/*Start End Time*/
$('#chronoExample .stopButton').click(function () {
   url="<?php echo base_url()?>TaskProcess/EndTaskTime";
    $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      data: {tid:tid,sdatetime:sdatetime,cdt:cdt,pdatetime:pdatetime,caltime:caltime,ttype:ttype},
      success: function (data) {
         timer.stop();
         alert('Production End Success');
         location.reload();
      } 
    });
});
/*End End Time*/

timer.addEventListener('secondsUpdated', function (e) {
    $('#chronoExample .values').html(timer.getTimeValues().toString());
});
timer.addEventListener('started', function (e) {
    $('#chronoExample .values').html(timer.getTimeValues().toString());
});

</script>





