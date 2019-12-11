<!-- Full Width Column -->
<div class="content-wrapper">
   <div class="container">
      <section class="content-header">
         <h1>
            Branch Details
         </h1>
         <ol class="breadcrumb">
            <a class="col-2 btn btn-info" href="<?php echo base_url('branch-add'); ?>">
            <i class="fa fa-plus"></i> New Branch
            </a>  
         </ol>
         <br>
      </section>
      <!--Order New-->
      <section class="content">
         <div class="row">
            <div class="box box-primary">
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
                     <table id="dev_branchList" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                           <tr>
                              <th>Branch</th>
                              <th>Manager</th>
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