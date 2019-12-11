<div class="content-wrapper">
    <div class="container">
      <section class="content-header">
        <h1>New Task Managment </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">New Task Managment </li>
        </ol>
      </section>

      <section class="content">
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <div class="box box-primary collapsed-box" style="display: none;">
            <div class="box-header with-border">
              <h3 class="box-title">Search Item</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
              <div class="box-body">
                <!-- form start -->
                <form method="post" action="#">
                  <div class="row flx_End">
                  <div class="form-group col-xs-6 col-md-3">
                    <label>From Date</label>
                    <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right datepicker" name="from" >
                  </div>
                  </div>
                  <div class="form-group col-xs-6 col-md-3">
                    <label>To Date</label>
                    <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right datepicker" name="to" >
                  </div>
                  </div>
                  <div class="form-group col-xs-6 col-md-3">
                    <label>Order Number</label>
                    <input type="text" class="form-control" placeholder="" name="customer_Mobile">
                  </div>
                  <div class="form-group col-xs-6 col-md-3">
                    <button type="submit" class="btn btn-primary primary_bg" style="width: 100%">Search</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.End Search Col-->

        <div class="col-xs-12 col-md-12">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Item List</h3>
            </div>
            <!-- /.box-header -->
              <div class="box-body">
                <!-- Task List start -->
                <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                  <thead>
                  <tr>
                    <th>SNo</th>
                    
                    <th>Item Code</th>
                    <th>Customer Name</th>
                    <th>Item</th>
                    <th>Delivery Date</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i=0;foreach($product as $product){ $i++; ?> 
                    <tr onclick="document.location = '<?=base_url();?>task-details/<?=$product['id'];?>';" style="cursor: pointer; <?php if($product['task_Priority']=='YES'){echo 'color: red';}?>">
                      <td><?=$i;?></td>
                      
                      <td><?=$product['task_ItemCode'];?></td>
                      <td><?=$product['customer_Name'];?></td>
                      <td><?=$product['product_Name'];?></td>
                      <td><?= date('d-m-Y',strtotime($product['task_DeliveryDate']));?></td>
                      <td>
                        <?php 
                        if($product['task_Status']=='Assign'){echo '<button class="btn btn-warning">In Production</button>';}
                        else if($product['task_Status']=='Not Assign'){echo '<button class="btn btn-danger">Push Production</button>';}
                        else if($product['task_Status']=='Completed'){ echo '<button class="btn btn-success">Completed</button>';}
                        ?>
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