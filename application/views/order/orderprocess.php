<!-- Full Width Column -->
<div class="content-wrapper">
   <div class="container">
      <section class="content-header">
         <h1>
            New Order 
         </h1>
         <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">New Order </li>
         </ol>
      </section>
      <!--Order New-->
      <section class="content">
         <div class="row">
            <div class="box box-primary">
               <!-- /.box-header -->
               <!-- form start -->
               <form role="form" id="order" action="<?php echo base_url()?>OrderProcess/saveOrder" method="POST">
                  <div class="box-body">
                    <div class="card-header">
                                    <h3 class="card-title">Customer Details</h3>
                                 </div>
                           <div class="col-md-12">      
                     <div class="row"  style="background: #f2f2f2;">
                        <div class="form-group col-xs-6 col-sm-3 customername">
                           <label>Customer Name</label>
                           <select class="form-control customerselect" id="customer_Name" name="customer_Name" required="" >
                              <option value="" >-Select Customer-</option>
                              <?php echo isset($ordercustomer->customer_Name)?'<option value="'.$ordercustomer->id.'" selected>'.$ordercustomer->customer_Name.'</option>':'';?>
                           </select>
                           <input type="text" class="form-control customerinput" placeholder="" name="customer_Name" 
                              id="customer_name" value="<?php echo isset($ordercustomer->id)?$ordercustomer->id:'';?>">
                              <input type="hidden" class="form-control " placeholder="" name="customer_fullName" 
                              id="customer_fullName" value="<?php echo isset($ordercustomer->customer_Name)?$ordercustomer->customer_Name:'';?>">
                            <?php echo form_error('customer_Name'); ?>
                        </div>
                       <div class="form-group col-xs-6 col-sm-3">
                          <label>Mobile</label>
                          <input type="text" class="form-control" placeholder="" name="customer_Mobile" 
                              id="customer_Mobile" value="<?php echo isset($ordercustomer->customer_Mobile)?$ordercustomer->customer_Mobile:'';?>">
                           <?php echo form_error('customer_Mobile'); ?>
                        </div>

                        <div class="form-group col-xs-6 col-sm-3">
                          <label>Email</label>
                          <input type="email" class="form-control" place-holder="" name="customer_Email" id="customer_Email" value="<?php echo isset($ordercustomer->customer_Email)?$ordercustomer->customer_Email:'';?>">
                          <?php echo form_error('customer_Email'); ?>
                        </div>

                        <div class="form-group col-xs-6 col-sm-2">
                              <label>Street</label>
                              <input type="text" class="form-control" placeholder="" name="customer_Street"  id="customer_Street" value="<?php echo isset($ordercustomer->customer_Street)?$ordercustomer->customer_Street:'';?>">
                          
                        </div>
                        <div class="form-group col-xs-6 col-sm-2">
                              <label>Area</label>
                              <input type="text" class="form-control" placeholder="" name="customer_Area" id="customer_Area"value="<?php echo isset($ordercustomer->customer_Area)?$ordercustomer->customer_Area:'';?>" >
                           
                        </div>
                        <div class="form-group col-xs-6 col-sm-2">
                              <label>City</label>
                              <input type="text" class="form-control" placeholder="" name="customer_City" id="customer_City" value="<?php echo isset($ordercustomer->customer_City)?$ordercustomer->customer_City:'';?>">
                           
                        </div>
                     </div>
                  </div>
                  </div>
                  
                  <div class="box-body">
                    <div class="card-header">
                                    <h3 class="card-title">Order</h3>
                                 </div>
                                 <div class="col-md-12"> 
                     <div class="row"  style="background: #f2f2f2;">

                        <div class="form-group col-xs-6 col-sm-3">
                            <label>Order No</label>
                              <input type="text" class="form-control" placeholder="" readonly="" name="order_Number" id="order_Number"  value="<?php echo isset($orders->order_Number)?$orders->order_Number:$order_number;?>"> 
                              <input type="hidden" class="form-control " name="order_ID" id="order_ID" value="<?php echo isset($orders->id)?$orders->id:'';?>" >
                              <?php echo form_error('order_Number'); ?>
                        </div>
                       <div class="form-group col-md-3">
                          <label>Order Date</label>
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right datepicker" name="order_OrderDate" id="order_OrderDate" value="<?php echo isset($orders->order_OrderDate)?date('d-m-Y',strtotime($orders->order_OrderDate)):date('d-m-Y');?>" >
                            <?php echo form_error('order_OrderDate'); ?>
                          </div>
                      </div>
                        
                        <div class="form-group col-xs-6 col-sm-2">
                             <label>Delivery Date</label>
                              <div class="input-group date">
                                 <div class="input-group-addon">
                                    <!-- <span class="input-group-text"> -->
                                    <i class="fa fa-calendar"></i>
                                    <!-- </span> -->
                                 </div>
                                 <input type="text" class="form-control pull-right datepicker" name="order_DeliveryDate" id="order_DeliveryDate" value="<?php echo isset($orders->order_DeliveryDate)?date('d-m-Y',strtotime($orders->order_DeliveryDate)):'';?>"> 
                              <?php echo form_error('order_DeliveryDate'); ?>
                              </div>
                          
                        </div>
                        <div class="form-group col-xs-6 col-sm-2">
                              <label>Days for Delivery</label>
                              <input type="text" class="form-control" placeholder="" readonly="" name="order_DaysOfDelivery" id="workingdays" value="<?php echo isset($orders->order_DaysOfDelivery)?$orders->order_DaysOfDelivery:'';?>">
                              <p class="errorshows" style="color:red;"></p>
                           
                        </div>
                        <div class="form-group col-xs-6 col-sm-2">
                              <div class="icheck-primary d-inline" style="margin-top: 30px">
                                 <input type="checkbox" id="checkboxPrimary1"  name="order_Priority" value="YES" <?php if(isset($orders->order_Priority)) { if($orders->order_Priority=="YES") { echo "checked";}}?>>
                                 <label for="checkboxPrimary1">
                                 Priority
                                 </label>
                              </div>
                           
                        </div>
                     </div>
                  </div>
                  </div>
                  

                  <!-- append -->
                  <?php if(isset($orders_details)) {  ?>
                  <!-- append -->
                  <div class="box-body">
                    <div class="card-header">
                                    <h3 class="card-title">Order Details</h3>
                                 </div>
                  <div class="box-body " style="background: #f9f9f9;">
                     <!-- Bill Form -->
                     <table id="billtable" class="billtable" style="width:100%">
                        <thead>
                           <tr>
                              <th>No</th>
                              <th style="width: 25%">Particulars </th>
                              <th>No of Pcs</th>
                              <th>Rate</th>
                              <th>Amount</th>
                              <th>Comments</th>
                              <?php if($orders->order_Status=="Not Assign"){?><th>Action</th><?php } ?>
                           </tr>
                        </thead>
                        <tbody>
                           <?php  $sno=1; foreach($orders_details as $odpro ) { ?>
                           <tr class="count_row">
                              <td> </td>
                              <td>
                                 <select class="form-control select1 order_Item" name="OD_ProductName[]" onchange="menuprice(<?php echo $odpro->id?>)" id='order_Item<?php echo $odpro->id?>' required="">
                                    <option value=''>-select-</option>
                                   <?php foreach($product as $pro) {?>
                                    <option value="<?php echo $pro->id?>"  <?php echo  ($odpro->OD_ProductID==$pro->id)?'selected':'4';?>><?php echo $pro->product_Name?></option>
                                 <?php }?>
                                 </select>
                              </td>
                              <td> <input type="number" class="form-control"  name="OD_ProductQty[]" id="Pqty<?php echo $odpro->id?>"  onkeyup="menucal(<?php echo $sno;?>)" required value="<?php echo $odpro->OD_ProductQty?>" min="0"> </td>
                              <td>
                                 <input type="number" class="form-control" name="OD_ProductRate[]"   id="Prate<?php echo $odpro->id?>"  onkeyup="menucal(<?php echo $sno;?>)" required r value="<?php echo $odpro->OD_ProductRate?>" min="0">
                                 
                              </td>
                              <td>
                                 <input type="number" class="form-control sumprice" name="OD_ProductAmount[]" id="Pamount<?php echo $odpro->id?>" required value="<?php echo $odpro->OD_ProductAmount?>" min="0" readonly>
                                 
                              </td>
                              <td>
                                 <textarea class="form-control" rows="1" placeholder="Enter ..." name="OD_ProductComment[]">
                                    <?php echo $odpro->OD_ProductComment;?>
                                 </textarea> 
                              </td>
                              <?php 
                              if($orders->order_Status=="Not Assign"){?>
                              <td> <button type="button" class="btn btn-info add_row" onclick="add_row()">+</button> 
                                 <button type="button" class="btn btn-danger remove_row">-</button></td>
                               <?php } ?>
                           </tr>
                        <?php  }?>
                        </tbody>
                     </table>
                    
                     <div class="form-group col-xs-6 col-sm-6">
                          <label>Gentral Comments</label>
                          <textarea class="form-control" rows="1" placeholder="Enter ..." name="order_GeneralComments"><?php echo isset($orders->order_GeneralComments)?$orders->order_GeneralComments:'';?></textarea> 
                           
                        </div>
                  </div>
                </div>

                  <!-- append -->
               <?php } else {?>
<!-- append -->
                  <div class="box-body">
                    <div class="card-header">
                                    <h3 class="card-title">Order Details</h3>
                                 </div>
                  <div class="box-body " style="background: #f9f9f9;">
                     <!-- Bill Form -->
                     <table id="billtable" class="billtable" style="width:100%">
                        <thead>
                           <tr>
                              <th>No</th>
                              <th style="width: 25%">Particulars </th>
                              <th>No of Pcs</th>
                              <th>Rate</th>
                              <th>Amount</th>
                              <th>Comments</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr class="count_row">
                              <td> </td>
                              <td>
                                 <select class="form-control select1 order_Item" name="OD_ProductName[]" onchange="menuprice(1)" id='order_Item1' required="">
                                    <option value=''>-select-</option>
                                   <?php foreach($product as $pro) {?>
                                    <option value="<?php echo $pro->id?>"><?php echo $pro->product_Name?></option>
                                 <?php }?>
                                 </select>
                              </td>
                              <td> <input type="number" class="form-control"  name="OD_ProductQty[]" id="Pqty1" value="1"   onkeyup="menucal(1)" required  min="0"> </td>
                              <td>
                                 <input type="number" class="form-control" name="OD_ProductRate[]"   id="Prate1"   required min="0" onkeyup="menucal(1)">
                                 
                              </td>
                              <td>
                                 <input type="number" class="form-control sumprice" name="OD_ProductAmount[]" id="Pamount1" required readonly min="0">
                                 
                              </td>
                              <td>
                                 <textarea class="form-control" rows="1" placeholder="Enter ..." name="OD_ProductComment[]"></textarea> 
                              </td>
                              <td> <button type="button" class="btn btn-info add_row" onclick="add_row()">+</button> <button type="button" class="btn btn-danger remove_row">-</button></td>
                           </tr>
                        </tbody>
                     </table>
                    
                     <div class="form-group col-xs-6 col-sm-6">
                          <label>Gentral Comments</label>
                          <textarea class="form-control" rows="1" placeholder="Enter ..." name="order_GeneralComments"><?php echo isset($orders->order_GeneralComments)?$orders->order_GeneralComments:'';?></textarea> 
                           
                        </div>
                  </div>
                </div>
               <?php } ?>
                <!-- payment -->
                  <div class="box-body">
                    <div class="card-header">
                                    <h3 class="card-title">Payment Details</h3>
                                 </div>
                           <div class="col-md-12">      
                     <div class="row"  style="background: #f2f2f2;">
                       
                       <div class="form-group col-xs-6 col-sm-2">
                          <label>Total Amount</label>
                          <input type="text" class="form-control totalPrice" placeholder="" name="order_TotalAmount" 
                              id="order_TotalAmount" value="<?php echo isset($orders->order_TotalAmount)?$orders->order_TotalAmount:'';?>">
                           <?php echo form_error('order_TotalAmount'); ?>
                        </div>
                        <div class="form-group col-xs-6 col-sm-2">
                              <label>Advance</label>
                              <input type="text" class="form-control" placeholder="" name="order_Advance" value="<?php echo isset($orders->order_Advance)?$orders->order_Advance:'';?>" id="order_Advance">
                            <input type="hidden" class="form-control" placeholder="" name="order_Status" value="Order">
                             <?php echo form_error('order_Advance'); ?>
                        </div>
                         
                     </div>
                  </div>
                  </div>
                  <!-- payment -->
                 <!-- measurement -->
                  <div class="box-body">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="card card-info">
                              <div class="card-header">
                                 <h3 class="card-title">Measurements (in Inches)</h3>
                              </div>
                              <div class="card-body">
                                 <div class="row">
                                    <div class="col-12 col-md-6">
                                       <div class="card card-secondary light-bg">
                                          <div class="card-header">
                                             <h3 class="box-title text-center">Top</h3>
                                          </div>
                                          <!-- /.card-header -->
                                          <!-- form start -->
                                          <div class="card-body">
                                             <div class="row">
                                                <div class="form-group col-xs-6 col-sm-2">
                                                   <!-- text input -->
                                                   <div class="form-group">
                                                      <label>Length</label>
                                                      <input type="text" class="form-control" placeholder="" name="toplength" value="<?php echo isset($measurement)?$measurement->toplength:'';?>">
                                                   </div>
                                                </div>
                                                <div class="form-group col-xs-6 col-sm-2">
                                                   <div class="form-group">
                                                      <label>Shoulder</label>
                                                      <input type="text" class="form-control" placeholder="" name="topshoulder" value="<?php echo isset($measurement)?$measurement->topshoulder:'';?>">
                                                   </div>
                                                </div>
                                                <div class="form-group col-xs-6 col-sm-2">
                                                   <div class="form-group">
                                                      <label>Chest</label>
                                                      <input type="text" class="form-control" placeholder="" name="topchest" value="<?php echo isset($measurement)?$measurement->topchest:'';?>">
                                                   </div>
                                                </div>
                                                <!-- /.form group -->
                                                <div class="form-group col-xs-6 col-sm-2">
                                                   <div class="form-group">
                                                      <label>Waist</label>
                                                      <input type="text" class="form-control" placeholder="" name="topwaist" value="<?php echo isset($measurement)?$measurement->topwaist:'';?>">
                                                   </div>
                                                </div>
                                                <div class="form-group col-xs-6 col-sm-2">
                                                   <div class="form-group">
                                                      <label>Hip</label>
                                                      <input type="text" class="form-control" placeholder="" name="tophip" value="<?php echo isset($measurement)?$measurement->tophip:'';?>">
                                                   </div>
                                                </div>
                                                <div class="form-group col-xs-6 col-sm-2">
                                                   <div class="form-group">
                                                      <label>Sit Open</label>
                                                      <input type="text" class="form-control" placeholder="" name="topsitopen" value="<?php echo isset($measurement)?$measurement->topsitopen:'';?>">
                                                   </div>
                                                </div>
                                                <div class="form-group col-xs-6 col-sm-2">
                                                   <div class="form-group">
                                                      <label>Armhole</label>
                                                      <input type="text" class="form-control" placeholder="" name="toparmhole" value="<?php echo isset($measurement)?$measurement->toparmhole:'';?>">
                                                   </div>
                                                </div>
                                                <div class="form-group col-xs-6 col-sm-2">
                                                   <div class="form-group">
                                                      <label>Sleeve Length</label>
                                                      <input type="text" class="form-control" placeholder="" name="topsleevelength" value="<?php echo isset($measurement)?$measurement->topsleevelength:'';?>">
                                                   </div>
                                                </div>
                                                <div class="form-group col-xs-6 col-sm-2">
                                                   <div class="form-group">
                                                      <label>Sleeve Open</label>
                                                      <input type="text" class="form-control" placeholder="" name="topsleeveopen" value="<?php echo isset($measurement)?$measurement->topsleeveopen:'';?>">
                                                   </div>
                                                </div>
                                                <div class="form-group col-xs-6 col-sm-2">
                                                   <div class="form-group">
                                                      <label>Neck Width</label>
                                                      <input type="text" class="form-control" placeholder="" name="topsneckwidth" value="<?php echo isset($measurement)?$measurement->topsneckwidth:'';?>">
                                                   </div>
                                                </div>
                                                <div class="form-group col-xs-6 col-sm-2">
                                                   <div class="form-group">
                                                      <label>Neck Drop</label>
                                                      <input type="text" class="form-control" placeholder="" name="topsneckdrop" value="<?php echo isset($measurement)?$measurement->topsneckdrop:'';?>">
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <!-- /.card-footer -->
                                       </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                       <div class="card card-secondary light-bg">
                                          <div class="card-header">
                                             <h3 class="box-title text-center">Bottom</h3>
                                          </div>
                                          <!-- /.card-header -->
                                          <!-- form start -->
                                          <div class="card-body">
                                             <div class="row">
                                                <div class="form-group col-xs-6 col-sm-2">
                                                   <!-- text input -->
                                                   <div class="form-group">
                                                      <label>Length</label>
                                                      <input type="text" class="form-control" placeholder="" name="bottomlength" value="<?php echo isset($measurement_bottom)?$measurement_bottom->bottomlength:'';?>">
                                                   </div>
                                                </div>
                                                <div class="form-group col-xs-6 col-sm-2">
                                                   <div class="form-group">
                                                      <label>Hip</label>
                                                      <input type="text" class="form-control" placeholder="" name="bottomhip" value="<?php echo isset($measurement_bottom)?$measurement_bottom->bottomhip:'';?>">
                                                   </div>
                                                </div>
                                                <div class="form-group col-xs-6 col-sm-2">
                                                   <div class="form-group">
                                                      <label>Thigh</label>
                                                      <input type="text" class="form-control" placeholder="" name="bottomthigh" value="<?php echo isset($measurement_bottom)?$measurement_bottom->bottomthigh:'';?>">
                                                   </div>
                                                </div>
                                                <div class="form-group col-xs-6 col-sm-2">
                                                   <div class="form-group">
                                                      <label>Knee</label>
                                                      <input type="text" class="form-control" placeholder="" name="bottomknee" value="<?php echo isset($measurement_bottom)?$measurement_bottom->bottomknee:'';?>">
                                                   </div>
                                                </div>
                                                <div class="form-group col-xs-6 col-sm-2">
                                                   <div class="form-group">
                                                      <label>Calf</label>
                                                      <input type="text" class="form-control" placeholder="" name="bottomcalf" value="<?php echo isset($measurement_bottom)?$measurement_bottom->bottomcalf:'';?>">
                                                   </div>
                                                </div>
                                                <div class="form-group col-xs-6 col-sm-2">
                                                   <div class="form-group">
                                                      <label>Leg Open</label>
                                                      <input type="text" class="form-control" placeholder="" name="bottomlegopen" value="<?php echo isset($measurement_bottom)?$measurement_bottom->bottomlegopen:'';?>">
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php if(isset($orders->order_Status)) {
                      if($orders->order_Status=="Not Assign"){ ?>
                    <!-- Drawing Pad -->
                  <div class="box-body">
                     <div class="card-header">
                     </div>
                     <div class="box-body">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="light-bg">
                                 <div class="popupdraw" style="display: none1">
                                    <h3 class="box-title text-center">Drawing</h3>
                                    <div id="wPaint" style="position:relative; width:100%; height:300px; background:#ccc; border:solid black 1px;"></div>
                                    <div style="text-align: center;margin: 10px 0px 0px; "> 
                                       <a href="javascript:saveImage();" class="btn btn-primary">Save Image</a> 
                                       <a href="javascript:clearCanvas();" class="btn btn-danger">Clear Draw</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  
                   
                  <!-- Drawing -->
                  <div class="box-body">
                     <div class="card-header">
                     </div>
                     <div class="box-body">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="light-bg">
                                 <h3 class="box-title text-center">Drawing Images</h3>
                                 <label id="show" class="btn btn-primary" style="display: none;">Add Draw</label>
                                 <div class="" id="DrawBox">
                                    <img id="canvasImage" src="" style="display: none" />
                                    <img id="canvasImageData" src="" style="display: none" />
                                 </div>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="light-bg">
                                 <h3 class="box-title text-center">Upload Images</h3>
                                 <input type="file" multiple id="gallery-photo-add" class="form-control">
                                 <div class="gallery"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                    <!--drawing -->
                  <?php } } else {?>
                    <!-- Drawing Pad -->
                  <div class="box-body">
                     <div class="card-header">
                     </div>
                     <div class="box-body">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="light-bg">
                                 <div class="popupdraw" style="display: none1">
                                    <h3 class="box-title text-center">Drawing</h3>
                                    <div id="wPaint" style="position:relative; width:100%; height:300px; background:#ccc; border:solid black 1px;"></div>
                                    <div style="text-align: center;margin: 10px 0px 0px; "> 
                                       <a href="javascript:saveImage();" class="btn btn-primary">Save Image</a> 
                                       <a href="javascript:clearCanvas();" class="btn btn-danger">Clear Draw</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  
                   
                  <!-- Drawing -->
                  <div class="box-body">
                     <div class="card-header">
                     </div>
                     <div class="box-body">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="light-bg">
                                 <h3 class="box-title text-center">Drawing Images</h3>
                                 <label id="show" class="btn btn-primary" style="display: none;">Add Draw</label>
                                 <div class="" id="DrawBox">
                                    <img id="canvasImage" src="" style="display: none" />
                                    <img id="canvasImageData" src="" style="display: none" />
                                 </div>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="light-bg">
                                 <h3 class="box-title text-center">Upload Images</h3>
                                 <input type="file" multiple id="gallery-photo-add" class="form-control">
                                 <div class="gallery"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                    <!--drawing -->
                  <?php } ?>
                    <!--Task -->
                    <?php if(isset($orders->order_Status)) {
                      if($orders->order_Status=="Assign"){ ?>
                    <div class="box-body">
                    <div class="card-header">
                                    <h3 class="card-title">Task</h3>
                                 </div>
                  <div class="box-body " style="background: #f9f9f9;">
                     <!-- Bill Form -->
                     <table id="billtable" class="billtable" style="width:100%">
                        <thead>
                           <tr>
                      <th>No</th>
                    <th>Order No</th>
                    <th>Item No</th>
                   <th>Item</th>
                    <th>Status</th>
                           </tr>
                        </thead>
                        <tbody>
                          <?php foreach($task  as $ta){ ?>  
                           <tr class="count_row" style="cursor: pointer; <?php if($production['task_Priority']=='YES'){echo 'color: red';}?>">
                              <td> </td>
                              <td><?php echo $ta->order_Number;?></td>

                              <td> <?php echo $ta->task_ItemCode;?></td>
                              <td><?php echo $ta->task_ProductName;?></td>
                             <td>
                      <?php
                      $titemcode = $ta->task_ItemCode;
                      $sql ="SELECT TA_assignDept,TA_assignuserID,TA_status FROM adora_taskassign WHERE TA_itemCode='$titemcode'";
                      $query = $this->db->query($sql)->result_array();
                      foreach ($query as $adpt) {

                      $sql1 ="SELECT department_Icon FROM adora_departmnt WHERE id='$adpt[TA_assignDept]'";
                      $query1 = $this->db->query($sql1)->result_array();
                      foreach ($query1 as $adpt1) {
                      ?>
                        <label class="btn <?php if($adpt[TA_assignuserID]=='0'){echo 'btn-default';}else if($adpt[TA_status]=='NOT STARTED'){echo 'btn-danger';}else if($adpt[TA_status]=='ITEM READY'){echo 'btn-success';}else if($adpt[TA_status]=='IN PRODUCTION'){echo 'btn-warning';}?>"><img src="<?=base_url();?>assets/dist/img/<?=$adpt1[department_Icon];?>" class="user-image" alt="User Image"></label>
                      <?php } }?>
                      </td>
                             
                           </tr>
                         <?php }?>
                        </tbody>
                     </table>
                    
                  </div>
                </div>
                <!--Task -->
                <?php if(isset($sales)) { ?>
                <!--bill -->
                    <div class="box-body">
                    <div class="card-header">
                                    <h3 class="card-title">Bills</h3>
                                 </div>
                  <div class="box-body " style="background: #f9f9f9;">
                     <!-- Bill Form -->
                     <table id="billtable" class="billtable" style="width:100%">
                        <thead>
                           <tr>
                              <th>No</th>
                              <th style="width: 25%">Order No </th>
                              <th>Bill Number</th>
                              
                              <th>Amount</th>
                              <th>Bill Date</th>
                              
                           </tr>
                        </thead>
                        <tbody>
                            <?php foreach($sales  as $sa){ ?>  
                           <tr class="count_row">
                            <td></td>
                              <td> <?php echo $sa->order_Number;?></td>
                              <td><?php echo $sa->sales_Number;?></td>
                              <td> <?php echo $sa->sales_Advance;?></td>
                              <td><?php echo date('d-m-Y',strtotime($sa->sales_Date));?></td>
                              
                           </tr>
                         <?php } ?>
                        </tbody>
                     </table>
                    
                     
                  </div>
                </div>
                <!--bill -->
              <?php } } } ?>
                  <div class="box-footer text-center">
                     <?php  $bill=$this->uri->segment(4); if($bill=="Bill"){  ?><input  type="submit" class="btn btn-primary" Value="Bill" > <input  type="hidden" class="btn btn-primary" Value="Bill" name="obill">  <?php } else { ?>
                     
                     <?php  } ?>
                     <?php if(isset($orders->order_Status)) {
                      if($orders->order_Status=="Not Assign"){?>
                  <input  type="submit" class="btn btn-primary ordersave" Value="Update" id="orderbtn">
                     <?php }
                        else {?>
                     <?php } }
                     else {?>
                     
              <input  type="submit" class="btn btn-primary ordersave" Value="Save" id="orderbtn">
                     <?php }?>
                  </div>
               </form>
            </div>
         </div>
      </section>
   </div>
   <!-- /.container -->
</div>
<!-- /.content-wrapper -->
<script>
$(document).ready(function(){
  $("#hide").click(function(){
    $(".popupdraw").hide();
  });
  $("#show").click(function(){
    $(".popupdraw").show();
  });
});
</script>
<!--draw Script-->
<script type="text/javascript">
   var wp = $("#wPaint").wPaint({
     image: "",
     drawDown: function(e, mode){ $("#canvasDown").val(this.settings.mode + ": " + e.pageX + ',' + e.pageY); },
     drawMove: function(e, mode){ $("#canvasMove").val(this.settings.mode + ": " + e.pageX + ',' + e.pageY); },
     drawUp: function(e, mode){ $("#canvasUp").val(this.settings.mode + ": " + e.pageX + ',' + e.pageY); }
   }).data('_wPaint');
   
   function saveImage(){
     var imageData = $("#wPaint").wPaint("image");
     $("#canvasImage").attr('src', imageData);
     $("#canvasImageData").val(imageData);
     $('#DrawBox').append('<img id="drawimage" class="w-100" src="'+imageData+'" />')
     clearCanvas();
   }
   
   function clearCanvas(){
     $("#wPaint").wPaint("clear");
   }
</script>
<!--image Previw-->
<script type="text/javascript">
   $(function() {
      // Multiple images preview in browser
      var imagesPreview = function(input, placeToInsertImagePreview) {
   
          if (input.files) {
              var filesAmount = input.files.length;
   
              for (i = 0; i < filesAmount; i++) {
                  var reader = new FileReader();
   
                  reader.onload = function(event) {
                      $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                  }
   
                  reader.readAsDataURL(input.files[i]);
              }
          }
   
      };
   
      $('#gallery-photo-add').on('change', function() {
          imagesPreview(this, 'div.gallery');
      });
   });
</script>
<script type="text/javascript"> 
   $('#order').submit(function(e){  
        e.preventDefault();
      
   var me = $(this);
   
   $.ajax({
   
    url : me.attr('action'),
    type : 'post',
    data : me.serialize(),
    dataType : 'json',
    success : function(response) {
        
      if (response.success == true) {
        //alert("yeas");
        window.location.href="<?php echo base_url('OrderDetails'); ?>";
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
   $('#order_OrderDate').on('change', function() {
     $('#order_DeliveryDate').val('');
   });
   $('#order_DeliveryDate').on('change', function() {
   var odate=$('#order_OrderDate').val();
    var delivery_date=$('#order_DeliveryDate').val();
     //if(new Date(odate) <= new Date(delivery_date)) { 
       url="<?php echo base_url()?>OrderProcess/checkworkdays";
 $.ajax({
         url: url,
         type: 'POST',
         data: "odate="+odate+"&delivery_date="+delivery_date,
         success: function (data) {
          //alert(data);
           if(data==0){
            $('.errorshows').html("Please select Delivery date greater than order date");
            $('.ordersave').attr("disabled",true);
            
           }
            else{
               $('.ordersave').attr("disabled",false);
               $('.errorshows').html("");
            }
          $('#workingdays').val(data);
         }
      });
   // }
    /*else {
      alert('Please select a different End Date.');
    }*/
   
});
    
</script>
<script type="text/javascript">
   function sumprice (){
  // initialize the sum (total price) to zero
  var sum = 0;
  // we use jQuery each() to loop through all the textbox with 'price' class
  // and compute the sum for each loop
  $('.sumprice').each(function() {
      sum += Number($(this).val());
  });
  // set the computed value to 'totalPrice' textbox
  $('.totalPrice').val(sum);
}
function menucal($id){
  //alert($id);
  
  
  price = $('#Prate'+$id).val();
  //alert(price);
  qty = $('#Pqty'+$id).val();
  //alert(qty);
  
  //$('#uTotal'+$id).val(mpqty);
  $('#Pamount'+$id).val(qty*price);
  //alert(qty*price);
  sumprice();
  
}
   $(document).ready(function(){
   
     
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
     
       $('.customerinput').hide();
       
       $(".customerinput").keyup(function(){
         var fulname=$('.customerinput').val();
    $("#customer_fullName").val(fulname);
  });
     $('#customer_Name').on('change', function() {
  var value=this.value;
  //alert(value);
  if(value==0){
   //alert('input');

   $('.customername span.select2').hide();
$(".customerselect").removeAttr("name");
$(".customerselect").removeAttr("id");
    $('.customerinput').show();
$(".customerinput").attr("name","customer_Name");
$(".customerinput").attr("id","customer_Name");
  }else{
   //alert('select');
$('.customerinput').hide();
$('.customername span.select2').show();
$(".customerinput").removeAttr("name");
$(".customerinput").removeAttr("id");
$(".customerselect").attr("name","customer_Name");
$(".customerselect").attr("id","customer_Name");
url="<?php echo base_url()?>OrderProcess/getCustomer";
     $.ajax({
         url: url,
         type: 'POST',
         dataType: 'json',
         data: {cusId:value},
         success: function (data) {
           $('#customer_fullName').val(data['customer_Name']);
           $('#customer_Mobile').val(data['customer_Mobile']);
           $('#customer_Area').val(data['customer_Area']);
           $('#customer_City').val(data['customer_City']);
           $('#customer_Street').val(data['customer_Street']);
             } 
       });

  }
   
   });
   });
   <?php 
      if(isset($orders_details)){
        ?> var i= <?php echo count($orders_details); ?>;
   <?php 
      }else{
      ?>
   var i=1;
   <?php } ?>
   /*add and remove row*/
   function add_row(){
       i++;
 /*$itemStr ='';
 
 $('.order_Item').each(function(){
     $itemStr += $(this).val().toString()+',';
 });*/

  url="<?php echo base_url()?>OrderProcess/getextramenu";
 $.ajax({
         url: url,
         type: 'POST',
         //data: { itemStr:$itemStr },
          data: {  },
         success: function (data) {
            //alert(data);
           $('.extramenu'+i).html(data);
         } 
       });
    $("#billtable").append('<tr role="row" class="odd"> <td ></td> <td> <select class="form-control order_Item select1 extramenu'+i+'" name="OD_ProductName[]" onchange="menuprice('+i+')" id="order_Item'+i+'" required=""> </select> </td><td> <input type="number" class="form-control"  name="OD_ProductQty[]" id="Pqty'+i+'" value="" onkeyup="menucal('+i+')" required> </td><td><input type="number" class="form-control" name="OD_ProductRate[]"   id="Prate'+i+'" onkeyup="menucal('+i+')" required> </td> <td><input type="number" class="form-control sumprice" name="OD_ProductAmount[]" id="Pamount'+i+'"  readonly required></td> <td> <textarea class="form-control" rows="1" placeholder="Enter ..."></textarea> </td> <td> <button type="button" class="btn btn-info add_row" onclick="add_row()">+</button> <button type="button" class="btn btn-danger remove_row">-</button></td> </tr>');
    $('.select1').select2();
   }

   function menuprice($id) {
        $('#order_Item'+$id).each(function(){
             //alert($id);
             menuId = $(this).val();

             url="<?php echo base_url()?>OrderProcess/getPrice";
             $.ajax({
                 url: url,
                 type: 'POST',
                 dataType: 'json',
                 data: {menuId:menuId},
                 success: function (data) {
                   $('#Pqty'+$id).val('1');
                   $('#Prate'+$id).val(data['product_Price']);
                   var qtyp=$('#Pqty'+$id).val();
                   
                   $('#Pamount'+$id).val(data['product_Price']*qtyp);
                   
                   sumprice();
                 } 
            });
        });

}
   // Remove parent of 'remove' link when link is clicked.
   $('#billtable').on('click', '.remove_row', function(e) {
    e.preventDefault();
    $(this).parent().parent().remove();
    //$(this).find("tr:gt(0)").remove();
    sumprice();
   });

</script>