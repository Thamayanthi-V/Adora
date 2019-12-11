
  </header><div class="content-wrapper">
    <div class="container">
      <section class="content-header">
        <h1>Customer List </h1>
        <ol class="breadcrumb">
            <a class="col-2 btn btn-info" href="<?php echo base_url('customer-add'); ?>">
            <i class="fa fa-plus"></i> New Customer
            </a>  
         </ol><br>
      </section>

      <section class="content">
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <div class="box box-primary collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Search Customer</h3>
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
                    <label>Name</label>
                   <input type="text" class="form-control" name="dev_cusNameSearch" id="dev_cusNameSearch" value=""  placeholder=""  />
                  </div>
                  <div class="form-group col-xs-6 col-md-3">
                    <label>Mobile Number</label>
                     <input type="text" class="form-control" name="dev_cusMobSearch" id="dev_cusMobSearch" value=""  placeholder=""  />
                  </div>
                  <div class="form-group col-xs-6 col-md-3">
                    <button type="button" class="btn btn-primary primary_bg" onclick="customerSearch();" >Search</button>
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
              <h3 class="box-title">Customers List</h3>
            </div>
             <div class="box-body">
                  <?php //echo $flash_data;exit();
                     if($flash_data!=''){
                     ?>
                  <div class="alert <?php echo $flash_data_type; ?>">
                     <?php echo $flash_data; ?>
                  </div>
                  <?php   
                     }
                     ?>
               </div>
            <!-- /.box-header -->
              <div class="box-body">
                <!-- Task List start -->
                 <table id="dev_customerList" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                           <tr>
                              <th>Name</th>
                              <th>Mobile</th>
                              <th width="10%">Action</th>
                           </tr>
                        </thead>
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
 