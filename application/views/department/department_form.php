<div class="content-wrapper">
   <div class="container">
      <section class="content-header">
         <h1>
            <?php echo ucfirst($mode);?>  Department 
         </h1>
      </section>
      <!--Order New-->
      <section class="content">
         <div class="row">
            <div class="box box-primary">
               <form role="form" id="dev_addDepartment" action="<?php echo base_url('department-save'); ?>">
                   <input type="hidden" name="bUpdate" value="<?php echo (!empty($departDetails))?'1':'0' ; ?>">
                           <input type="hidden" name="bId" value="<?php echo (!empty($departDetails))? $departDetails->bid:'0' ; ?>">
                           
                  <div class="box-body">
                     <div class="row">
                        <div class="form-group col-xs-6 col-sm-3">
                           <label>Name</label>
                           <input type="text" class="form-control" name="department_Name" id="department_Name" value="<?php echo (!empty($departDetails))? ($departDetails->department_Name) :'' ;?>"  placeholder="Department" required />
                        </div>
                        
                        <?php if($LoginPrivilege=='ADMIN') { ?>
                        <div class="form-group col-xs-6 col-sm-3">
                           <!-- text input -->
                           <label> Branch</label>
                           <select class="form-control" name="branch_ID" id="branch_ID" required >
                              <?php
                              foreach ($Branch as $b) {
                                 $sel = (!empty($departDetails))? (($departDetails->branch_ID== $b->id)?'selected':'') :'' ;
                                 echo "<option value='".$b->id."' ".$sel.">".$b->branch_Name."</option>";
                              }
                              ?>   

                           </select>
                        </div>
                        <?php }else{ ?>
                            <input type="hidden" id="branch_ID" name="branch_ID" value="<?php  echo $Login_branchID; ?>"   />
                         <?php } ?>
                        
                         <div class="form-group col-xs-6 col-sm-3">
                           <label>Department Icon</label>
                           <?php if(!empty($departDetails) )
                              {
                                 echo "<img src='".base_url()."/assets/depart_img/".$departDetails->department_Icon."' height='100%' style='padding:5px;border:1.3px solid #333;border-radius:10%;margin-top:-10px'>";
                                 ?>
                                <input type="hidden" name="exist_department_Icon" value="<?php echo $departDetails->department_Icon;?>" >
                                 <?php
                              }
                           ?>
                           <input type="file" class="form-control" name="department_Icon" id="department_Icon" <?php echo (!empty($departDetails))? (($departDetails->department_Icon!='')?'':'required') :'required' ;?> />
                        </div>
                        <div class="form-group col-xs-12 col-sm-12">
                        <div class="form-group">
                           <div class="text-center">
                              <button type="submit" class="btn btn-info add_row" >Save</button> 
                              <?php if(!empty($departDetails) &&  ($LoginPrivilege =='ADMIN') ){
                                 $delt    = "confirm_delete('department-delete/".base64_encode($departDetails->bid)."')";
                                 echo '<button type="button" onclick="'.$delt.'" class="btn btn-danger">Delete</button>';
                              }
                              ?> 
                              <button type="button" class="btn btn-waring" onclick="goBack('department-master');">Cancel</button>
                           </div>
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