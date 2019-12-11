<div class="content-wrapper">
   <div class="container">
      <section class="content-header">
         <h1>
            New Product
         </h1>
      </section>
      <!--Order New-->
      <section class="content">
         <div class="row">
            <div class="box box-primary">
               <form role="form" id="dev_addProduct" action="<?php echo base_url('product-save');?>">

                  <input type="hidden" name="bUpdate" value="<?php echo (!empty($prdDetails))?'1':'0' ; ?>">
                  <input type="hidden" name="bId" value="<?php echo (!empty($prdDetails))? $prdDetails->bid:'0' ; ?>">

                  <div class="box-body">
                     <div class="row">
                        <div class="col-sm-12 row">
                           <div class="form-group">
                              <?php if (empty($prdDetails)){ ?>
                              <div class="form-group col-xs-12 col-sm-12">
                                 <label class="btn btn-default toggle-checkbox primary">
                                 <i class="fa fa-fw"></i>
                                 <input id="dev_prdService" name="product_type" value="SERVICE" autocomplete="off" class="" type="radio" checked oninput="productTypeCols()" />
                                 Service
                                 </label>
                                 <label class="btn btn-default toggle-checkbox primary">
                                 <i class="fa fa-fw"></i>
                                 <input id="dev_prdSell" name="product_type" value="SALE" autocomplete="off" class="" type="radio"  oninput ="productTypeCols()" />
                                 Selling
                                 </label>
                              </div>
                           <?php } else{
                              $product_type = $prdDetails->product_type;
                              if($product_type=='SERVICE'){
                                 $prdT  = $prdText = 'Service';
                              }
                              else{
                                 $prdT = 'Sell';
                                 $prdText = 'Selling';
                              }
                              ?>
                              <div class="form-group col-xs-12 col-sm-12">
                                 <label class="btn btn-default toggle-checkbox primary">
                                 <i class="fa fa-fw"></i>
                                 <input id="dev_prd<?php echo $prdT; ?>" name="product_type" value="<?php echo  $product_type; ?>" autocomplete="off" class="" type="radio" checked oninput="productTypeCols(<?php echo $prdDetails->bid ;?>)" />
                                 <?php echo $prdText; ?>
                                 </label>

                              </div>
                           <?php } ?>
                           </div>
                        </div>
                        <div  id="dev_prdFieldLoad" class="form-group col-xs-12 col-sm-12">

                        </div>

                        <div class="form-group col-xs-12 col-sm-12">
                           <p id='dept_error' style="color: red"></p>
                           <div class="text-center">
                              <button type="submit" class="btn btn-info add_row" >Save</button> 
                              <button type="button" class="btn btn-danger" onclick="goBack('product-master');">Cancel</button>
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
<script type="text/javascript">
   $(document).ready(function(){

      productTypeCols(<?php echo (!empty($prdDetails))? $prdDetails->bid:'' ; ?>);  
       
   });
</script>
