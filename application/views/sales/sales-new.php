<!-- Full Width Column -->
<div class="content-wrapper">
   <div class="container">
      <section class="content-header">
         <h1>
            New Sales 
         </h1>
         <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">New Sales</li>
         </ol>
      </section>
      <!--Order New-->
      <section class="content">
         <div class="row">
            <div class="box box-primary">
               <!-- /.box-header -->
               <!-- form start -->
               <form role="form" id="order" action="<?php echo base_url()?>Sales/saveSales" method="POST">
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
                        <div class="form-group col-xs-6 col-sm-2">
                              <label>Street</label>
                              <input type="text" class="form-control" placeholder="" name="customer_Street" id="customer_Street"value="<?php echo isset($ordercustomer->customer_Street)?$ordercustomer->customer_Street:'';?>">
                          
                        </div>
                        <div class="form-group col-xs-6 col-sm-2">
                              <label>Area</label>
                              <input type="text" class="form-control" placeholder="" name="customer_Area" id="customer_Area" value="<?php echo isset($ordercustomer->customer_Area)?$ordercustomer->customer_Area:'';?>" >
                           
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
                                    <h3 class="card-title">Sales</h3>
                                 </div>
                                 <div class="col-md-12"> 
                     <div class="row"  style="background: #f2f2f2;">

                        <div class="form-group col-xs-6 col-sm-3">
                            <label>Bill No</label>
                              <input type="text" class="form-control" placeholder="" readonly="" name="sales_Number" id="sales_Number"  value="<?php echo isset($orders->sales_Number)?$orders->sales_Number:$sales_Number;?>"> 
                              <input type="hidden" class="form-control " name="order_ID" id="order_ID" value="<?php echo isset($orders->id)?$orders->id:'';?>" >
                              <?php echo form_error('order_Number'); ?>
                        </div>
                       <div class="form-group col-md-3">
                  <label>Bill Date</label>
                  <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right datepicker" name="order_OrderDate" id="order_OrderDate" value="<?php echo isset($orders->order_OrderDate)?date('d-m-Y',strtotime($orders->order_OrderDate)):date('d-m-Y');?>" >
                  <?php echo form_error('order_OrderDate'); ?>
                </div>
                </div>
                        
                        
                     </div>
                  </div>
                  </div>
                  

                  <!-- append -->
                  <?php if(isset($orders_details)) { ?>
                  <!-- append -->
                  <div class="box-body">
                    <div class="card-header">
                                    <h3 class="card-title">Sales Details</h3>
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
                              
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $sno=1; foreach($orders_details as $odpro ) { ?>
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
                                 <input type="number" class="form-control" name="OD_ProductRate[]"   id="Prate<?php echo $odpro->id?>" onchange="menuprice(<?php echo $odpro->id?>)"  required onkeyup="menucal(<?php echo $sno;?>)" value="<?php echo $odpro->OD_ProductRate?>" min="0">
                                 
                              </td>
                              <td>
                                 <input type="number" class="form-control sumprice" name="OD_ProductAmount[]" id="Pamount<?php echo $odpro->id?>"  readonly required value="<?php echo $odpro->OD_ProductAmount?>" min="0">
                                 
                              </td>
                              
                              <td> <button type="button" class="btn btn-info add_row" onclick="add_row()">+</button> 
                                 <button type="button" class="btn btn-danger remove_row">-</button></td>
                           </tr>
                        <?php  }?>
                        </tbody>
                     </table>
                    
                     
                  </div>
                </div>

                  <!-- append -->
               <?php } else {?>
<!-- append -->
                  <div class="box-body">
                    <div class="card-header">
                                    <h3 class="card-title">Sales Details</h3>
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
                              <td> <input type="number" class="form-control"  name="OD_ProductQty[]" id="Pqty1" value="1" onkeyup="menucal(1)" required  min="0"> </td>
                              <td>
                                 <input type="number" class="form-control" name="OD_ProductRate[]"   id="Prate1" onkeyup="menucal(1)"  required  min="0">
                                 
                              </td>
                              <td>
                                 <input type="number" class="form-control sumprice" name="OD_ProductAmount[]" id="Pamount1" required min="0">
                                 
                              </td>
                             
                              <td> <button type="button" class="btn btn-info add_row" onclick="add_row()">+</button> <button type="button" class="btn btn-danger ">-</button></td>
                           </tr>
                        </tbody>
                     </table>
                    
                     
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
                              id="order_TotalAmount" value="<?php echo isset($orders->order_TotalAmount)?$orders->order_TotalAmount:'';?>" readonly>
                           <?php echo form_error('order_TotalAmount'); ?>
                        </div>
                       
                        <div class="form-group col-xs-6 col-sm-2">
                              <label>Discount</label>
                              <input type="text" class="form-control" placeholder="" name="order_Discount" value="<?php echo isset($orders->sales_Discount)?$orders->sales_Discount:'';?>" id="order_Discount">
                            <input type="hidden" class="form-control" placeholder="" name="order_Status" value="Sales">
                             <?php echo form_error('order_Advance'); ?>
                        </div>
                         <div class="form-group col-xs-6 col-sm-2">
                              <label>Sales Amount</label>
                              <input type="text" class="form-control" placeholder="" name="order_Advance" value="<?php echo isset($orders->sales_Advance)?$orders->sales_Advance:'';?>" id="order_Advance">
                           <input type="hidden" class="form-control" placeholder="" name="sales_Source" value="Sales">
                             <?php echo form_error('sales_Advance'); ?>
                        </div>
                     </div>
                  </div>
                  </div>
                  <!-- payment -->
                 
                   

                  <div class="box-footer text-center">
                     <?php  $bill=$this->uri->segment(4); if($bill=="Bill"){  ?><input  type="submit" class="btn btn-primary" Value="Bill" > <input  type="hidden" class="btn btn-primary" Value="Bill" name="obill">  <?php } else { ?>
                     
                     <?php  } ?>
                    
                     <input  type="submit" class="btn btn-primary ordersave" Value="PrintBill" id="orderbtn"> 
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
        $ss=response.order_id;
        
       url="<?php echo base_url('sales-print/'); ?>"+$ss;
        
        window.location.href=url;
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
  var dis=$('#order_Discount').val();
if(dis==''){
  
  disc=0;
}
else{
  var disc=$('#order_Discount').val();
}
  
  $('.totalPrice').val(sum);
  var total=$('.totalPrice').val();
  
  var bal=total-disc;
  
  $('#order_Advance').val(bal);
}
function menucal($id){
  alert($id);
  
  
  price = $('#Prate'+$id).val();
  //alert(price);
  qty = $('#Pqty'+$id).val();
  //alert(qty);
  
  //$('#uTotal'+$id).val(mpqty);
  $('#Pamount'+$id).val(qty*price);
  //alert(qty*price);
  sumprice();
  
}
$('#order_Discount').on('keyup', function() {
  var dis=$('#order_Discount').val();

  
  var total=$('.totalPrice').val();
  var bal=total-dis;
  $('#order_Advance').val(bal);
  });
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
 $itemStr ='';
 
 $('.order_Item').each(function(){
     $itemStr += $(this).val().toString()+',';
 });

  url="<?php echo base_url()?>Sales/getextramenu";
 $.ajax({
         url: url,
         type: 'POST',
         data: { itemStr:$itemStr },
         success: function (data) {
            //alert(data);
           $('.extramenu'+i).html(data);
         } 
       });
    $("#billtable").append('<tr role="row" class="odd"> <td ></td> <td> <select class="form-control order_Item select1 extramenu'+i+'" name="OD_ProductName[]" onchange="menuprice('+i+')" id="order_Item'+i+'" required=""> </select> </td><td> <input type="number" class="form-control"  name="OD_ProductQty[]" id="Pqty'+i+'" value="1" onkeyup="menucal('+i+')" required> </td><td><input type="number" class="form-control" name="OD_ProductRate[]"   id="Prate'+i+'" onkeyup="menucal('+i+')" required> </td> <td><input type="number" class="form-control sumprice" name="OD_ProductAmount[]" id="Pamount'+i+'"  readonly required></td>  <td> <button type="button" class="btn btn-info add_row" onclick="add_row()">+</button> <button type="button" class="btn btn-danger remove_row">-</button></td> </tr>');
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