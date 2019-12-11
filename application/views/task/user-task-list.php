<?php 
$ULoginID = $this->data['LoginID'];
?>
<div class="content-wrapper">
    <div class="container">
      <section class="content-header">
        <h1>Task List</h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Task List</li>
        </ol>
      </section>

      <section class="content">
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <div class="box box-danger">
            <div class="box-header with-border">
              <div class="col-md-6">
                <h3 class="box-title">Item List</h3>
              </div>
              <div class="col-md-6 text-right">
                <label class="btn btn-success">Item Ready</label>
                <label class="btn btn-warning">In Production</label>
                <label class="btn btn-danger">Not Started</label>
              </div>
            </div>
            <!-- /.box-header -->
              <div class="box-body">
                <div class="nav-tabs-custom">
                  <!-- Tabs within a box -->
                  <ul class="nav nav-tabs ui-sortable-handle ">
                    <?php 
                      $sql ="SELECT user_departments FROM adora_user WHERE id='$ULoginID'";
                      $query = $this->db->query($sql)->result_array();
                      foreach ($query as $udata) {
                        $uexp = explode(',', $udata[user_departments]);
                        $x=0;
                        foreach ($uexp  as $udpt) {
                          $sql1 ="SELECT department_Name,department_Icon FROM adora_departmnt WHERE id='$udpt'";
                          $query1 = $this->db->query($sql1)->result_array();
                          foreach ($query1 as $udptdata) { ?>
                            <li class="<?php if($x=='0'){echo 'active';}?>"><a href="#<?=$udptdata[department_Name];?>" data-toggle="tab"><img src="<?=base_url();?>assets/dist/img/<?=$udptdata[department_Icon];?>"></a></li>
                          <?php
                          }
                          $x++;
                        }
                      }
                    ?>
                  </ul>
                  <div class="tab-content no-padding">
                    <?php 
                      $tabsql ="SELECT user_departments FROM adora_user WHERE id='$ULoginID'";
                      $tabquery = $this->db->query($tabsql)->result_array();
                      foreach ($tabquery as $tabudata) {
                      $tabuexp = explode(',', $tabudata[user_departments]);
                      $x=0;
                      foreach ($tabuexp  as $tabudpt) { 
                      $tabsql1 ="SELECT id,department_Name FROM adora_departmnt WHERE id='$tabudpt'";
                      $tabquery1 = $this->db->query($tabsql1)->result_array();
                      foreach ($tabquery1 as $tabudptdata) { 
                    ?>
                      <div class="chart tab-pane <?php if($x=='0'){echo 'active';}?>" id="<?=$tabudptdata[department_Name];?>">
                        <table class="example1 table table-striped table-bordered nowrap" style="width:100%">
                          <thead>
                          <tr>
                            <th>No</th>
                            <th>Customer</th>
                            <th>Order No</th>
                            <th>Item Code</th>
                            <th>Item</th>
                            <th>Satus</th>
                          </tr>
                          </thead>
                          <tbody>
                      <?php 
                        /*$tasksql=$this->db->select('t1.id,customer_Name,t1.orderID,t1.TA_itemCode,product_Name,t1.TA_status')
						  ->from('adora_taskassign as t1')
						  ->where('t1.TA_assignDept', $tabudptdata[id])
						  ->where('t1.TA_assignuserID',$ULoginID)
						  ->or_where('t1.TA_assignuserID','0')
						  ->join('adora_customer as t2', 't1.customerId = t2.id', 'LEFT')
						  ->join('adora_product as t3', 't1.TA_productID = t3.id', 'LEFT')
						  ->get();
						$taskquery = $tasksql->result_array();
						*/

                        $tasksql ="
                        SELECT t1.id,customer_Name,t1.orderID,t1.TA_itemCode,t1.TA_Priority,product_Name,t1.TA_status FROM adora_taskassign as t1
                        LEFT JOIN adora_customer as t2 ON t1.customerId = t2.id
                        LEFT JOIN adora_product as t3 ON t1.TA_productID = t3.id
                        WHERE t1.TA_assignDept='$tabudptdata[id]' and (t1.TA_assignuserID='$ULoginID' or t1.TA_assignuserID='0')
                        ORDER BY t1.TA_Priority ASC";

                        $taskquery = $this->db->query($tasksql)->result_array();

                        $sno=1;
                        foreach ($taskquery as $taskdata) { 
                      ?>
                            <tr onclick="document.location = '<?=base_url();?>task-start/<?=base64_encode($taskdata[id]);?>';" style="cursor: pointer; <?php if($taskdata[TA_Priority]=='YES'){echo 'color: red';}?>">
                              <td><?=$sno;?></td>
                              <td><?=$taskdata[customer_Name];?></td>
                              <td><?=$taskdata[orderID];?></td>
                              <td><?=$taskdata[TA_itemCode];?></td>
                              <td><?=$taskdata[product_Name];?></td>
                              <td><label class="btn <?php if($taskdata[TA_status]=='NOT STARTED'){echo 'btn-danger';}else if($taskdata[TA_status]=='IN PRODUCTION'){echo 'btn-warning';}else if($taskdata[TA_status]=='ITEM READY'){echo 'btn-success';}?>"><?=$taskdata[TA_status];?></label></td>
                            </tr>
                        <?php $sno++; } ?>
                          </tbody>
                          
                        </table>
                      </div>
                      <?php 
                      }
                      $x++;
                      }
                      }
                    ?>
                      

                      
                  </div>
                </div>
                
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

