<div class="content-wrapper">
    <div class="container">
      <section class="content-header">
        <h1>Production</h1>
        <ol class="breadcrumb">
          <li><a href="https://www.royalsfood.in/"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Production</li>
        </ol>
      </section>

      <section class="content">
      <div class="row">
        <div class="col-xs-12 col-md-12">
          
        </div>
        <!-- /.End Search Col-->

        <div class="col-xs-12 col-md-12">
          <div class="box box-danger">
            <div class="box-header with-border row">
              <div class="col-md-6">
                <h3 class="box-title">Production List</h3>
              </div>
              <div class="col-md-6 text-right">
                <label class="btn btn-success">Item Ready</label>
                <label class="btn btn-warning">In Production</label>
                <label class="btn btn-danger">Not Started</label>
                <label class="btn btn-default">Not Assign</label>
              </div>
            </div>
            <!-- /.box-header -->
              <div class="box-body">
                <!-- Task List start -->
                <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Order No</th>
                    <th>Item No</th>
                    <th>Customer Name</th>
                    <th>Delivery Date</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $i=0;foreach($productionlist as $production){ $i++; ?> 
                    <tr onclick="document.location = '<?=base_url();?>task-details/<?=$production['id'];?>';" style="cursor: pointer; <?php if($production['task_Priority']=='YES'){echo 'color: red';}?>">
                      <td><?=$i;?></td>
                      <td><?=$production['order_Number'];?></td>
                      <td><?=$production['task_ItemCode'];?></td>
                      <td><?=$production['customer_Name'];?></td>
                      <td><?=$production['task_DeliveryDate'];?></td>
                      <td>
                      <?php
                      $titemcode = $production['task_ItemCode'];
                      $sql ="SELECT TA_assignDept,TA_assignuserID,TA_status FROM adora_taskassign WHERE TA_itemCode='$titemcode'";
                      $query = $this->db->query($sql)->result_array();
                      foreach ($query as $adpt) {

                      $sql1 ="SELECT department_Icon FROM adora_departmnt WHERE id='$adpt[TA_assignDept]'";
                      $query1 = $this->db->query($sql1)->result_array();
                      foreach ($query1 as $adpt1) {
                      ?>
                        <label class="btn <?php if($adpt[TA_assignuserID]=='0'){echo 'btn-default';}else if($adpt[TA_status]=='NOT STARTED'){echo 'btn-danger';}else if($adpt[TA_status]=='ITEM READY'){echo 'btn-success';}else if($adpt[TA_status]=='IN PRODUCTION'){echo 'btn-warning';}?>"><img src="<?=base_url();?>assets/dist/img/<?=$adpt1[department_Icon];?>" class="user-image" alt="User Image"></label>
                      <?php } }?>
                      </td>
                    </tr>
                  <?php } ?>
                    
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.End task Col-->

      </div>
      <!-- /.row -->
    </section>
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
 
<!-- Popup Order -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Production Date : 25-07-2019</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Print</button>
      </div>
    </div>
  </div>
</div>