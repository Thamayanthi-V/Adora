<div class="content-wrapper">
   <div class="container">
      <section class="content-header">
         <h1>
            <?php echo ucfirst($mode);?> Branch
         </h1>
      </section>
      <!--Order New-->
      <section class="content">
         <div class="row">
            <div class="box box-primary">
               <form role="form" id="dev_addBranch" action="<?php echo base_url('branch-save'); ?>">
                  <div class="box-body">
                     <div class="row">
                        <div class="form-group col-xs-6 col-sm-6">
                           <input type="hidden" name="bUpdate" value="<?php echo (!empty($branchDetails))?'1':'0' ; ?>">
                           <input type="hidden" name="bId" value="<?php echo (!empty($branchDetails))? $branchDetails->bid:'0' ; ?>">
                           <input type="hidden" name="userId" value="<?php echo (!empty($branchDetails))? $branchDetails->branch_manager:'0' ; ?>">
                           <!-- text input -->
                           <label>Branch Name</label>
                           <input type="text" class="form-control" name="branch_Name" id="branch_Name" value="<?php echo (!empty($branchDetails))? ($branchDetails->branch_Name) :'' ;?>"  placeholder="Branch" required />
                           <?php  
                              /*  <input type="hidden" id="branch_id" name="branch_id" value="<?php  echo 'BR'.str_pad($mId, 3, '0', STR_PAD_LEFT); ?>"   />*/
                           ?>
                        </div>
                        <div class="form-group col-xs-6 col-sm-6">
                           <label>Manager Name</label>
                           <input type="text" class="form-control" name="branch_manager" id="branch_manager" value="<?php echo (!empty($branchDetails))? ($branchDetails->manager) :'' ;?>" placeholder="Manager"  required />
                        </div>
                        <div class="form-group">
                           <div class="text-center">
                              <button type="submit" class="btn btn-info add_row" >Save</button> 
                              <button type="button" class="btn btn-danger" onclick="goBack('branch-master');" >Cancel</button>
                           </div>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </section>
   </div>
</div>