<!-- Full Width Column -->
<div class="content-wrapper">
   <div class="container">
      <section class="content-header">
         <h1>
            Product Details
         </h1>
         <ol class="breadcrumb">
            <a class="col-2 btn btn-info" href="<?php echo base_url('product-add'); ?>">
            <i class="fa fa-plus"></i> New Product
            </a>  
         </ol>
         <br>
      </section>
      <!--Order New-->
      <section class="content">
         <div class="row">
            <div class="box box-primary">
               
               <div class="box-body">
                  <div class="form-group col-xs-6 col-sm-4">
                          
                     <input type="text" class="form-control" name="dev_prdNameSearch" id="dev_prdNameSearch" value=""  placeholder="Name"  />
                  </div>
                  <div class="form-group col-xs-6 col-sm-4">
                     
                     <select class="form-control" name="dev_prdTypeSearch" id="dev_prdTypeSearch" value="" > 
                        <option value="">-Select-</option> 
                        <option value="SERVICE">Service</option> 
                        <option value="SALE">Selling</option> 
                     </select>
                  </div>
                  <button type="button" class="btn btn-danger" onclick="productSearch();" >Search</button>
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

               <!-- append -->
               <div class="box-body">
                  <div class="box-body table-responsive" style="background: #ffffff;">
                     <!-- Bill Form -->
                     <table id="dev_productList" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                           <tr>
                              <th>Name</th>
                              <th>Rate</th>
                              <th>Type</th>
                              <th width="10%">Action</th>
                           </tr>
                        </thead>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </div>
   <!-- /.container -->
</div>

<script type="text/javascript">
   
</script>