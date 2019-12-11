<?php
if($this->session->userdata('customer_id') == ""){
    redirect(base_url('login'));
}
$ULoginID = $this->session->userdata('customer_id');
$Login_branchID = $this->data['Login_branchID'];
$LoginPrivilege = $this->data['LoginPrivilege'];
if($LoginPrivilege=='STAFF'){
  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  if($actual_link=='http://dev.minmegam.com/adora/'){
    redirect(base_url('user-task-list'));
  }else if($actual_link=='http://dev.minmegam.com/adora/orderProcess'){
    redirect(base_url('user-task-list'));
  }

}
?>
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
  <!-- fullCalendar -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/fullcalendar/dist/fullcalendar.min.css">
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
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="<?php echo base_url();?>" class="navbar-brand"><b>Adora</b> Boutique</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <?php if($this->data['LoginPrivilege']=='ADMIN'){?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Order <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo base_url();?>order-new">New Order</a></li>
                
                <li><a href="<?php echo base_url();?>OrderDetails">Order List</a></li>
              </ul>
            </li>
             <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sales <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo base_url();?>sales-new">Direct Sales</a></li>
                <li><a href="<?php echo base_url();?>order-sales-details">Order Sales</a></li>
                
                <li><a href="<?php echo base_url();?>sales-details">Sales List</a></li>
              </ul>
            </li>
            <li><a href="<?php echo base_url();?>task-list">Task</a></li>
            <li><a href="<?php echo base_url();?>calendar">Task Calendar</a></li>
            <li><a href="<?php echo base_url();?>production-list">Production</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Masters <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo base_url('branch-master');?>">Branches</a></li>
                <li><a href="<?php echo base_url('department-master');?>">Departments</a></li>
                <li><a href="<?php echo base_url('user-master');?>">Users</a></li>
                <li><a href="<?php echo base_url('product-master');?>">Products</a></li>
                <li><a href="<?php echo base_url('customer-master');?>">Customers</a></li>
              </ul>
            </li>
           
            <li style="display: none"><a href="<?php echo base_url();?>holiday">Holiday Calendar</a></li>
            <?php }  ?>
            <?php if($this->data['LoginPrivilege']=='STAFF'){?>
              <li><a href="<?php echo base_url();?>user-task-list">My Task</a></li>
            <?php } ?>
          </ul>
          
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
               <?php if($this->session->userdata('customer_name')!='') { ?>
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="<?php echo base_url();?>assets/dist/img/avatar5.png" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?php echo $this->session->userdata('customer_name');?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="<?php echo base_url();?>assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
                  <p><?php echo ucwords( strtolower($this->session->userdata('customer_privilege'))) ; ?><small></small></p>
                </li>
                <!-- Menu Body -->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?php echo base_url();?>welcome/userprofile" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo base_url('logout');?> " class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
               <?php } ?>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>