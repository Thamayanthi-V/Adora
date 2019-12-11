<div class="content-wrapper">
   <div class="container">
      <section class="content-header">
         <h1>
            <?php echo ucfirst($mode);?> Customer
         </h1>
      </section>
      <!--Order New-->
      <section class="content">
         <div class="row">
            <div class="box box-primary">
               <form role="form" id="dev_addCustomer" action="<?php echo base_url('customer-save'); ?>">
                  <input type="hidden" name="bUpdate" value="<?php echo (!empty($customDetails))?'1':'0' ; ?>">
                  <input type="hidden" name="bId" value="<?php echo (!empty($customDetails))? $customDetails->bid:'0' ; ?>">
                  <div class="box-body">
                     <div class="row">
                        <div class="form-group col-xs-6 col-sm-2">
                           <label>Name</label>
                           <input type="text" class="form-control" name="customer_Name" id="customer_Name" value="<?php echo (!empty($customDetails))? ($customDetails->customer_Name) :'' ;?>"  placeholder="Name" required />
                        </div>
                        <div class="form-group col-xs-6 col-sm-2">
                           <label>Mobile Number</label>
                            <input type="text" class="form-control" name="customer_Mobile" id="customer_Mobile" value="<?php echo (!empty($customDetails))? ($customDetails->customer_Mobile) :'' ;?>" placeholder="Mobile" onkeypress="return isNumber(event);" minlength="10" maxlength="12"  required />
                        </div>
                         <div class="form-group col-xs-6 col-sm-2">
                           <label>Email Id</label>
                           <input type="email" class="form-control" name="customer_Email" id="customer_Email" value="<?php echo (!empty($customDetails))? ($customDetails->customer_Email) :'' ;?>" placeholder="Email ID"   />
                        </div>
                         <div class="form-group col-xs-6 col-sm-2">
                           <label>Phone</label>
                           <input type="text" class="form-control" name="customer_Phone" id="customer_Phone" value="<?php echo (!empty($customDetails))? ($customDetails->customer_Phone) :'' ;?>" placeholder="Phone" onkeypress="return isNumber(event);" minlength="10" maxlength="12"   />
                        </div>
                         <div class="form-group col-xs-6 col-sm-2">
                           <label>City</label>
                           <input type="text" class="form-control" name="customer_City" id="customer_City" value="<?php echo (!empty($customDetails))? ($customDetails->customer_City) :'' ;?>" placeholder="City"    />
                        </div>
                         <div class="form-group col-xs-6 col-sm-2">
                           <label>Address</label>
                           <textarea class="form-control" name="customer_Area" id="customer_Area"  placeholder="Address"   ><?php echo (!empty($customDetails))? ($customDetails->customer_Area) :'' ;?></textarea> 
                        </div>
                        <div class="form-group">
                           <div class="text-center">
                              <button type="submit" class="btn btn-info add_row" >Save</button>
                              <?php if(!empty($customDetails) &&  ($this->data['LoginPrivilege'] =='ADMIN') ){
                                 $delt    = "confirm_delete('customer-delete/".base64_encode($customDetails->bid)."')";
                                 echo '<button type="button" onclick="'.$delt.'" class="btn btn-danger ">Delete</button>';
                              }
                              ?> 
                              <button type="button" class="btn btn-warning" onclick="goBack('customer-master');" >Cancel</button>
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