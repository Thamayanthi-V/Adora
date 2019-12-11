</header><div class="content-wrapper">
    <div class="container">
      <section class="content-header">
        <h1>Order List </h1>
        <ol class="breadcrumb">
          <a class="col-2 btn btn-info" href="<?php echo base_url('order-new'); ?>">
            <i class="fa fa-plus"></i> New Order
          </a>  
        </ol>
        <br>
      </section>

      <section class="content">
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <div class="box box-primary collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Search Order List</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
              <div class="box-body">
                <!-- form start -->
                <form method="post" action="<?php echo base_url()?>OrderDetails">
                  <div class="row flx_End">
                  <div class="form-group col-xs-6 col-md-3">
                    <label>From Date</label>
                    <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right datepicker" name="from" value="<?php echo $from?>">
                  </div>
                  </div>
                  <div class="form-group col-xs-6 col-md-3">
                    <label>To Date</label>
                    <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right datepicker" name="to" value="<?php echo $to?>">
                  </div>
                  </div>
                  <div class="form-group col-xs-6 col-md-2">
                    <label>Order No</label>
                    <input type="text" class="form-control" placeholder="" name="order_Number" value="<?php echo $order_Number;?>">
                  </div>
                  <div class="form-group col-xs-6 col-md-2">
                    <label>Customer</label>
                    <select class="form-control customerselect" id="customer_Name" name="customer" >
                              <option value="" >-Select Customer-</option>
                              <option value="<?php echo $customer;?>" selected><?php echo $customer_name;?></option>
                           </select>
                  </div>
                  <div class="form-group col-xs-6 col-md-2">
                    <button type="submit" class="btn btn-primary primary_bg">Search</button>
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
              <h3 class="box-title">Order List</h3>
            </div>
            <!-- /.box-header -->
              <div class="box-body">
                <!-- Task List start -->
                <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Order No</th>
                    <th>Customer Name</th>
                    <th>Order Date</th>
                    <th>Delivery Date</th>
                    <th width="10%">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $s=1;foreach($orderlist as $val){?>
                    <tr>
                      <td><?php echo $s++;?></td>
                      <td><?php echo $val->order_Number?></td>
                      <td><?php echo $val->order_CustomerName?></td>
                      <td><?php echo date('d-m-Y',strtotime($val->order_OrderDate))?></td>
                      <td><?php echo date('d-m-Y',strtotime($val->order_DeliveryDate))?></td>
                      <td>
                        <?php $status=$val->order_Status;$ids=base64_encode($val->id);if($status=="Not Assign") {
                          ?>
                        <a type="button" href="<?php echo base_url();?>modify-order/<?php echo $ids;?>"><i class="fa fa-pencil"></i></a>
                      <a type="button" href="<?php echo base_url();?>delete-order/<?php echo $ids;?>" class="btn btn danger"><i class="fa fa-trash"></i></a>
                    <?php }  else {?>
                      <a type="button" href="<?php echo base_url();?>modify-order/<?php echo $ids;?>"><i class="fa fa-eye"></i></a>
                    <?php } ?>
                    </td>
                    </tr>
                   <?php }?>
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
 <script>
    $("#customer_Name").select2({
         ajax: { 
           url: '<?= base_url() ?>OrderProcess/getUsers',
           type: "post",
           dataType: 'json',
           delay: 250,
           data: function (params) {
              return {
                searchTerm: params.term // search term
              };
           },
           processResults: function (response) {
              return {
                 results: response
              };
           },
           cache: true
         }
     }); 
 </script>