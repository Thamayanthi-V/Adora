<div class="content-wrapper">
   <div class="container">
      <section class="content-header">
         <h1>
            New User
         </h1>
      </section>
      <!--Order New-->
      <section class="content">
         <div class="row">
            <div class="box box-primary">
               <form role="form" id="dev_addUser" method="POST" action="<?php echo base_url('user-save'); ?>">
                  <input type="hidden" name="bUpdate" value="<?php echo (!empty($userDetails))?'1':'0' ; ?>">
                  <input type="hidden" name="bId" class="userId" value="<?php echo (!empty($userDetails))? $userDetails->bid:'0' ; ?>">
                           
                  <div class="box-body">
                     <div class="row" style="background-color: #ecf0f5">
                        <div class="form-group col-xs-6 col-sm-4">
                           <label>Name</label>
                           <input type="text" class="form-control" name="user_Name" id="user_Name" value="<?php echo (!empty($userDetails))? ($userDetails->user_Name) :'' ;?>"  placeholder="" required />
                           
                        </div>
                        <div class="form-group col-xs-6 col-sm-4">
                           <label>Branch</label>
                           <select class="form-control" name="branch_ID" id="branch_ID"   placeholder="Branch" onchange="setUserManager(this.value);" required >
                              <option value="">--Select --</option>
                              <?php
                              foreach ($Branch as $b) {
                                 $sel = (!empty($userDetails))? (($userDetails->branch_ID==$b->id)?'selected':'') :'' ;
                                 echo "<option value='".$b->id."' ".$sel.">".$b->branch_Name."</option>";
                              }
                              ?>   

                           </select>
                        </div>
                        <div class="form-group col-xs-6 col-sm-4">
                           <label>Manager</label>
                           <input type="text" class="form-control" name="user_ManagerName" id="user_ManagerName" value="<?php echo (!empty($userDetails))? ($userDetails->manager) :'' ;?>"  placeholder="" required readonly />
                           <input type="hidden" class="form-control" name="user_Manager" id="user_Manager" value="<?php echo (!empty($userDetails))? ($userDetails->user_Manager) :'' ;?>"  placeholder=""  />
                        </div>
                        
                     </div>

                     <div class="row" style="background-color: #ecf0f5">
                        <div class="form-group col-xs-6 col-sm-4">
                           <label>Username</label>
                           <input type="text" class="form-control" name="user_loginkey" id="user_Name" value="<?php echo (!empty($userDetails))? ($userDetails->user_loginkey) :'' ;?>"  placeholder="" required />
                        </div>
                       
                        <div class="form-group col-xs-6 col-sm-4">
                           <label>Password</label>
                           <input type="text" class="form-control" name="user_loginpwd" id="user_pwd" value="<?php echo (!empty($userDetails))? base64_decode($userDetails->user_loginpwd) :'' ;?>"  placeholder="" required />
                           <button type="button" class="btn btn-info" onclick="getPwd();">get PWD</button>
                          
                        </div>
                        
                     </div>
                     <br>
                     <div class="row" style="background-color: #ecf0f5">
                        <div class="content-header">
                           <h3>Departments</h3>
                        </div>
                        <?php
                        $prdAr  = array();
                        if(!empty($userDetails)){
                           $prdAr  = $userDetails->user_departments;
                           $pDeptLst = explode(',', $prdAr);
                        }

                        if(!empty($departs)){ 
               
                foreach ($departs as $dept) {
                    if(!empty($prdAr))
                    {   
                       
                        $selDept = (in_array($dept->id, $pDeptLst)?'checked':'');
                        
                    }
                    echo '
                    <div class="form-group col-xs-6 col-sm-2">
                           <label class="btn btn btn-light">
                            <img src="'.base_url().'assets/depart_img/'.$dept->department_Icon.'" class="user-image" title="'.$dept->department_Name.'" alt="'.$dept->department_Name.'">
                           <input id="departs_'.$dept->id.'"  name="department[]" value="'.$dept->id .'" autocomplete="off" class="dev_pdept" type="checkbox" '.$selDept.' />
                           '.$dept->department_Name.'
                           
                           </label>
                        </div>';
                     
                     }
               
            } else {
               echo "No Department Added.";

            }?>
                     </div>
                     <br>
                     <div class="row" style="background-color: #ecf0f5">
                        <div class="content-header">
                           <h3>Privileges</h3>
                        </div>
                        <div class="form-group col-xs-6 col-sm-3">
                           <label class="btn btn btn-light">
                            <img src="<?php echo base_url();?>/assets/dist/img/staff.png" class="user-image" alt="User Image">
                           <input id="one" autocomplete="off" class="dev_userType" value="STAFF" type="radio" name="user_privileges" <?php echo (!empty($userDetails))? (($userDetails->user_privileges=='STAFF')?'checked':'') :'' ;?> required />
                           Staff
                           </label>
                        </div>
                        <div class="form-group col-xs-6 col-sm-3">
                           <label class="btn btn btn-light">
                            <img src="<?php echo base_url();?>/assets/dist/img/manager.png" class="user-image" alt="User Image">
                           <input id="one" autocomplete="off" class="dev_userType" type="radio" value="MANAGER" name="user_privileges" <?php echo (!empty($userDetails))? (($userDetails->user_privileges=='MANAGER')?'checked':'') :'' ;?>  />
                           Manager
                           </label>
                        </div>
                        <?php if(!empty($userDetails) && ($userDetails->user_privileges=='BRANCH MANAGER')){  ?>
                        <div class="form-group col-xs-6 col-sm-3">
                           <label class="btn btn btn-light">
                            <img src="<?php echo base_url();?>/assets/dist/img/manager.png" class="user-image" alt="User Image">
                           <input id="one" name="user_privileges" autocomplete="off" class="dev_userType" type="radio" value="BRANCH MANAGER" <?php echo (($userDetails->user_privileges=='BRANCH MANAGER')?'checked':'')  ;?>   />
                           Branch Manager
                           </label>
                        </div>
                     <?php } ?>
                        <div class="form-group col-xs-6 col-sm-3">
                           <label class="btn btn btn-light">
                            <img src="<?php echo base_url();?>/assets/dist/img/admin.png" class="user-image" alt="User Image">
                           <input id="one" name="user_privileges" autocomplete="off" class="dev_userType" type="radio" value="ADMIN" <?php echo (!empty($userDetails))? (($userDetails->user_privileges=='ADMIN')?'checked':'') :'' ;?> />
                           Admin
                           </label>
                        </div>
                     </div>
                     <br>
                     <p id='dept_error' style="color: red"></p>
                     <div class="form-group col-xs-12 col-sm-12">
                        <div class="text-center">
                           <button type="submit" class="btn btn-info add_row" >Save</button> 
                           <?php if(!empty($userDetails) &&  ($LoginPrivilege =='ADMIN') ){
                                 $delt    = "confirm_delete('user-delete/".base64_encode($userDetails->bid)."')";
                                 echo '<button type="button" id="confirm_delete" class="btn btn-danger" data-toggle="modal" data-target="#checkPassword">Delete</button>';
                              }
                              ?> 
                           <button type="button" class="btn btn-warning" onclick="goBack('user-master');">Cancel</button>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </section>
   </div>
</div>

<!-- Password Validation - Start -->
  <div class="modal fade" id="checkPassword" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Password Validation</h4>
        </div>
        <div class="modal-body">
          <input type="text" class="form-control" name="password" id="passwordText" placeholder="Enter your password" required />
          <input type="hidden" class="form-control" name="" id="uid" class="userId" placeholder=""  value="<?php echo (!empty($userDetails))? $userDetails->bid:'0' ; ?>"/>
          
        </div>
        <div class="modal-footer">
          <input type="submit" value="Submit" id="submit">
        </div>
      </div>
      
    </div>
  </div>
<!-- Password Validation - End  -->

<!-- malar starts -->
<script type="text/javascript">

    $("#checkPassword").hide();

    function setUserManager(e) {
      $.ajax({
            url: BaseURL + 'user/getBranchManager',
            type: 'POST',
            data: { bid:e
             
            },dataType : 'json',
            success: function (data) {
               
               $('#user_ManagerName').val(data.user_ManagerName);
               $('#user_Manager').val(data.user_Manager);
             
            } 
          });
    }

    $("#confirm_delete").click(function() {
        $("#checkPassword").show(); 
    });

    $("#submit").click(function() {
        var password = $("#passwordText").val();
        var userId = $(".userId").val();

        if(password != '') {
            $.ajax({
                url :  '<?php echo base_url('user/checkAdminPassword'); ?>',
                type : 'post',
                data: {pswd: password, uid: userId},
                success : function(result) {
                  console.log(result);
                    if (result) {
                        window.location.reload;
                    } else {
                        $('#passwordText').after('<span class="err" id="err" style="color:#FF0000;">Enter Valid Password<span>');
                    }
                }
            });
        } else {
            $('#passwordText').after('<span class="err" id="err" style="color:#FF0000;">Please Enter Password<span>');
        } 
        
    });

</script>
