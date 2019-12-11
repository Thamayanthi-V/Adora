<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Adora Boutique</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
   <!-- Select2 -->
   <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/select2/dist/css/select2.min.css">
   <!-- Google Font -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
   <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">

  <!---custom css-->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/custom.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins. -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/_all-skins.min.css">

  <!-- jQuery 3 -->
  <script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url();?>assets/dist/js/adminlte.min.js"></script>
  <!-- bootstrap datepicker -->
  <script src="<?php echo base_url();?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- Select2 -->
  <script src="<?php echo base_url();?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
  <!-- DataTables -->
  <script src="<?php echo base_url();?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url();?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

  <!-- malar starts -->   
  <script type="text/javascript">
   var BaseURL = '<?php echo base_url();?>';
   var baseURL = '<?php echo base_url();?>';
  </script>
  <!-- malar ends -->   
</head>
<body style="background: #3c8dbc;">
<div class="container login-container">
   <div class="row">
    <div class="col-md-12">
      <div class="login-box">
        <div class="login-box-body">
          <div class="login-logo">
            <h2>Adora Boutique</h2>
          </div>
            <?php echo form_open("Signin/loginSubmit", array("id" => "signups", "class" =>"form-horizontal", "method" => "post")) ?>
            <div id="myDiv" class="form-group">
               <label>User Name</label>
               <input type="username" class="form-control" placeholder="Username *" name="dev_username" id="dev_username" value="" />
            </div>
            <div style="display: none;" id="pass"  class="form-group">
               <label>Password</label>
               <input type="password"  class="form-control" placeholder="Password *" name="dev_pwd" id="dev_pwd" value="" />
               <p style="display: none; color: #333; margin-top: -0px;" id="loginError">Incorrect Password...</p>
            </div>
            <div class="form-group text-center">
               <input style="display: none;" id="back" type="button" name="back" class="btn btn-info btn-md" value="Back">
               <input id="myButton" type="button" name="click" class="btn btn-info btn-md" value="Next">
               <input type="submit" id="submit" class="btn btn btn-info btn-md btnSubmit" value="Login" style="display: none;"  />
            </div>
            <div class="form-group text-center">
              <?php // <a href="#" class="ForgetPwd">Forget Password?</a> ?>
            </div>
         </form>
        </div>
      </div>
    </div>
      

   </div>
</div>
</div>

<script type="text/javascript">

            $("#back").click(function () {
                $('#err').hide();
                 $('#myDiv').show('slide');
                $('#myButton').show('slide');
                 $('#pass').hide('slide');
                 $('#submit').hide('slide');
                 $('#back').hide('slide');
                 $('.text-danger').hide();

            });
            
            $("#myButton").click(function () {

                var name =  $("#dev_username").val();
                //alert(name);
                $.ajax({

  url :  '<?php echo base_url('Signin/usernamecheck'); ?>',
  type : 'post',
  data : "name="+name,
  //dataType : 'json',
  success : function(response) {
   if (response == 'true') {

                $('#myDiv').hide('slide');
                $('#myButton').hide('slide');
                 $('#pass').show('slide');
                 $('#submit').show('slide');
                  $('#back').show('slide');

   } else {
    $('#err').hide();

        $('#dev_username').after('<span class="err" id="err" style="color:#333;">Enter Valid Username...<span>');
   }

  }
});
                
                
  
});

              $('#signups').submit(function(e){
               $("#loginError").hide();
      e.preventDefault();
    
var me = $(this);

   // alert( me.attr('action'));

$.ajax({

  url : me.attr('action'),
  type : 'post',
  data : me.serialize(),
  dataType : 'json',
  success : function(response) {
    //alert(response.success);
    //alert(response.msg);
    if (response.success == true) {

        if (response.msg == "InCorrect") {
            $('.text-danger').remove();
          $("#loginError").show();
        } else if(response.msg == "Correct") {
            
          window.location.href = '<?php echo base_url('orderProcess'); ?>';
            
        }
     
    } else {
      $.each(response.messages, function(key, value) {

        var element = $('#'+ key);
        element.closest('div.form-group').removeClass('has-error').addClass(value.length > 0 ? 'has-error' : 'has-success').find('.text-danger').remove();
        element.after(value);
      });
    }
  }
});

    });
  </script>

  </body>
</html>