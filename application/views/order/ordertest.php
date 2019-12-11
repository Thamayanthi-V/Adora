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
                              <?php echo isset($ordercustomer['customer_Name'])?'<option value="'.$ordercustomer['id'].'" selected>'.$ordercustomer['customer_Name'].'</option>':'';?>
                           </select>
                           <input type="text" class="form-control customerinput" placeholder="" name="customer_Name" 
                              id="customer_name">
                            <?php echo form_error('customer_Name'); ?>
                        </div>
                       <div class="form-group col-xs-6 col-sm-3">
                          <label>Mobile</label>
                          <input type="text" class="form-control" placeholder="" name="customer_Mobile" 
                              id="customer_Mobile" value="<?php echo isset($ordercustomer['customer_Mobile'])?$ordercustomer['customer_Mobile']:'';?>">
                           <?php echo form_error('customer_Mobile'); ?>
                        </div>
                        <div class="form-group col-xs-6 col-sm-2">
                              <label>Street</label>
                              <input type="text" class="form-control" placeholder="" name="customer_Street" value="<?php echo isset($ordercustomer['customer_Street'])?$ordercustomer['customer_Street']:'';?>">
                          
                        </div>
                        <div class="form-group col-xs-6 col-sm-2">
                              <label>Area</label>
                              <input type="text" class="form-control" placeholder="" name="customer_Area" value="<?php echo isset($ordercustomer['customer_Area'])?$ordercustomer['customer_Area']:'';?>" >
                           
                        </div>
                        <div class="form-group col-xs-6 col-sm-2">
                              <label>City</label>
                              <input type="text" class="form-control" placeholder="" name="customer_City" value="<?php echo isset($ordercustomer['customer_City'])?$ordercustomer['customer_City']:'';?>">
                           
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
                              <input type="text" class="form-control" placeholder="" readonly="" name="order_Number" id="order_Number" value="<?php echo $order_number; ?>" value="<?php echo isset($orders['order_Number'])?$orders['order_Number']:$order_number;?>"> 
                              <input type="hidden" class="form-control " name="order_ID" id="order_ID" value="<?php echo isset($orders['id'])?$orders['id']:'';?>" >
                              <?php echo form_error('order_Number'); ?>
                        </div>
                       <div class="form-group col-md-3">
                  <label>Order Date</label>
                  <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right datepicker" name="order_OrderDate" id="order_OrderDate" value="<?php echo isset($orders['order_OrderDate'])?date('d-m-Y',strtotime($orders['order_OrderDate'])):date('d-m-Y');?>" >
                  <?php echo form_error('order_OrderDate'); ?>
                </div>
                </div>
                        
                        <div class="form-group col-xs-6 col-sm-2">
                             <label>Delivery Date</label>
                              <div class="input-group">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                    </span>
                                 </div>
                                 <input type="text" class="form-control float-right datepicker" name="order_DeliveryDate" id="order_DeliveryDate" value="<?php echo isset($orders['order_DeliveryDate'])?date('d-m-Y',strtotime($orders['order_DeliveryDate'])):'';?>"> 
                              <?php echo form_error('order_DeliveryDate'); ?>
                              </div>
                          
                        </div>
                        <div class="form-group col-xs-6 col-sm-2">
                              <label>Days for Delivery</label>
                              <input type="text" class="form-control" placeholder="" readonly="" name="order_DaysOfDelivery" id="workingdays" value="<?php echo isset($orders['order_DaysOfDelivery'])?date('d-m-Y',strtotime($orders['order_DaysOfDelivery'])):'';?>">
                           
                        </div>
                        <div class="form-group col-xs-6 col-sm-2">
                              <div class="icheck-primary d-inline" style="margin-top: 30px">
                                 <input type="checkbox" id="checkboxPrimary1"  name="order_Priority" value="YES" <?php if(isset($orders['order_Priority'])) { if($orders['order_Priority']=="YES") { echo "checked";}}?>>
                                 <label for="checkboxPrimary1">
                                 Priority
                                 </label>
                              </div>
                           
                        </div>
                     </div>
                  </div>
                  </div>
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
                                    <option value="<?php echo $pro['id']?>"><?php echo $pro['product_Name']?></option>
                                 <?php }?>
                                 </select>
                              </td>
                              <td> <input type="number" class="form-control"  name="OD_ProductQty[]" id="Pqty1" value="1" onkeyup="menuprice(1)" required> </td>
                              <td>
                                 <input type="number" class="form-control" name="OD_ProductRate[]"   id="Prate1" onchange="menuprice(1)"  required readonly="">
                                 
                              </td>
                              <td>
                                 <input type="number" class="form-control" name="OD_ProductAmount[]" id="Pamount1"  readonly required>
                                 
                              </td>
                              <td>
                                 <textarea class="form-control" rows="1" placeholder="Enter ..." name="OD_ProductComment[]"></textarea> 
                              </td>
                              <td> <button type="button" class="btn btn-info add_row" onclick="add_row()">+</button> <button type="button" class="btn btn-danger">-</button></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
                </div>

                  <!-- append -->
 <!-- payment -->
                  <div class="box-body">
                    <div class="card-header">
                                    <h3 class="card-title">Payment Details</h3>
                                 </div>
                           <div class="col-md-12">      
                     <div class="row"  style="background: #f2f2f2;">
                       
                       <div class="form-group col-xs-6 col-sm-3">
                          <label>Total Amount</label>
                          <input type="text" class="form-control" placeholder="" name="order_TotalAmount" 
                              id="order_TotalAmount" value="<?php echo isset($orders['order_TotalAmount'])?$orders['order_TotalAmount']:'';?>">
                           <?php echo form_error('order_TotalAmount'); ?>
                        </div>
                        <div class="form-group col-xs-6 col-sm-2">
                              <label>Advance</label>
                              <input type="text" class="form-control" placeholder="" name="order_Advance" value="<?php echo isset($orders['order_Advance'])?$orders['order_Advance']:'';?>">
                          
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
                                 <h3 class="card-title">Measurements</h3>
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
                                                <div class="form-group col-xs-6 col-sm-4">
                                                   <!-- text input -->
                                                   <div class="form-group">
                                                      <label>Length</label>
                                                      <input type="text" class="form-control" placeholder="" name="toplength">
                                                   </div>
                                                </div>
                                                <div class="form-group col-xs-6 col-sm-4">
                                                   <div class="form-group">
                                                      <label>Shoulder</label>
                                                      <input type="text" class="form-control" placeholder="" name="topshoulder">
                                                   </div>
                                                </div>
                                                <div class="form-group col-xs-6 col-sm-4">
                                                   <div class="form-group">
                                                      <label>Chest</label>
                                                      <input type="text" class="form-control" placeholder="" name="topchest">
                                                   </div>
                                                </div>
                                                <!-- /.form group -->
                                                <div class="form-group col-xs-6 col-sm-4">
                                                   <div class="form-group">
                                                      <label>Waist</label>
                                                      <input type="text" class="form-control" placeholder="" name="topwaist">
                                                   </div>
                                                </div>
                                                <div class="form-group col-xs-6 col-sm-4">
                                                   <div class="form-group">
                                                      <label>Hip</label>
                                                      <input type="text" class="form-control" placeholder="" name="topwaist">
                                                   </div>
                                                </div>
                                                <div class="form-group col-xs-6 col-sm-4">
                                                   <div class="form-group">
                                                      <label>Sit Open</label>
                                                      <input type="text" class="form-control" placeholder="" name="topsitopen">
                                                   </div>
                                                </div>
                                                <div class="form-group col-xs-6 col-sm-4">
                                                   <div class="form-group">
                                                      <label>Armhole</label>
                                                      <input type="text" class="form-control" placeholder="" name="toparmhole">
                                                   </div>
                                                </div>
                                                <div class="form-group col-xs-6 col-sm-4">
                                                   <div class="form-group">
                                                      <label>Sleeve Length</label>
                                                      <input type="text" class="form-control" placeholder="" name="topsleevelength">
                                                   </div>
                                                </div>
                                                <div class="form-group col-xs-6 col-sm-4">
                                                   <div class="form-group">
                                                      <label>Sleeve Open</label>
                                                      <input type="text" class="form-control" placeholder="" name="topsleeveopen">
                                                   </div>
                                                </div>
                                                <div class="form-group col-xs-6 col-sm-4">
                                                   <div class="form-group">
                                                      <label>Neck Width</label>
                                                      <input type="text" class="form-control" placeholder="" name="topsneckwidth">
                                                   </div>
                                                </div>
                                                <div class="form-group col-xs-6 col-sm-4">
                                                   <div class="form-group">
                                                      <label>Neck Drop</label>
                                                      <input type="text" class="form-control" placeholder="" name="topsneckdrop">
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
                                                <div class="form-group col-xs-6 col-sm-4">
                                                   <!-- text input -->
                                                   <div class="form-group">
                                                      <label>Length</label>
                                                      <input type="text" class="form-control" placeholder="" name="bottomlength">
                                                   </div>
                                                </div>
                                                <div class="form-group col-xs-6 col-sm-4">
                                                   <div class="form-group">
                                                      <label>Hip</label>
                                                      <input type="text" class="form-control" placeholder="" name="bottomhip">
                                                   </div>
                                                </div>
                                                <div class="form-group col-xs-6 col-sm-4">
                                                   <div class="form-group">
                                                      <label>Thigh</label>
                                                      <input type="text" class="form-control" placeholder="" name="bottomthigh">
                                                   </div>
                                                </div>
                                                <div class="form-group col-xs-6 col-sm-4">
                                                   <div class="form-group">
                                                      <label>Knee</label>
                                                      <input type="text" class="form-control" placeholder="" name="bottomknee">
                                                   </div>
                                                </div>
                                                <div class="form-group col-xs-6 col-sm-4">
                                                   <div class="form-group">
                                                      <label>Calf</label>
                                                      <input type="text" class="form-control" placeholder="" name="bottomcalf">
                                                   </div>
                                                </div>
                                                <div class="form-group col-xs-6 col-sm-4">
                                                   <div class="form-group">
                                                      <label>Leg Open</label>
                                                      <input type="text" class="form-control" placeholder="" name="bottomlegopen">
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
                  
                 
                  <div class="box-footer text-center">
                     <?php  $bill=$this->uri->segment(4); if($bill=="Bill"){  ?><input  type="submit" class="btn btn-primary" Value="Bill" > <input  type="hidden" class="btn btn-primary" Value="Bill" name="obill">  <?php } else { ?>
                     <input  type="submit" class="btn btn-primary" Value="Save" id="orderbtn">
                     <?php  } ?>
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
        //window.location.href="<?php echo base_url('OrderProcess/'); ?>";
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
     $('#customer_Name').on('change', function() {
  var value=this.value;
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
 $itemStr ='';
 
 $('.order_Item').each(function(){
     $itemStr += $(this).val().toString()+',';
 });

  url="<?php echo base_url()?>OrderProcess/getextramenu";
 $.ajax({
         url: url,
         type: 'POST',
         data: { itemStr:$itemStr },
         success: function (data) {
            //alert(data);
           $('.extramenu'+i).html(data);
         } 
       });
    $("#billtable").append('<tr role="row" class="odd"> <td ></td> <td> <select class="form-control order_Item select1 extramenu'+i+'" name="OD_ProductName[]" onchange="menuprice('+i+')" id="order_Item'+i+'" required=""> </select> </td><td> <input type="number" class="form-control"  name="OD_ProductQty[]" id="Pqty'+i+'" value="1" onkeyup="menuprice('+i+')" required> </td><td><input type="number" class="form-control" name="OD_ProductRate[]"   id="Prate'+i+'" readonly required> </td> <td><input type="number" class="form-control" name="OD_ProductAmount[]" id="Pamount'+i+'"  readonly required></td> <td> <textarea class="form-control" rows="1" placeholder="Enter ..."></textarea> </td> <td> <button type="button" class="btn btn-info add_row" onclick="add_row()">+</button> <button type="button" class="btn btn-danger remove_row">-</button></td> </tr>');
    $('.select1').select2();
   }
   function menuprice($id){
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
           //$('#Pqty'+$id).val('1');
           $('#Prate'+$id).val(data['product_Price']);
           var qtyp=$('#Pqty'+$id).val();
           
           $('#Pamount'+$id).val(data['product_Price']*qtyp);
           
          // sumprice();
         } 
       });
 });

}
   // Remove parent of 'remove' link when link is clicked.
   $('#billtable').on('click', '.remove_row', function(e) {
    e.preventDefault();
    $(this).parent().parent().remove();
    sumprice();
   });
</script>