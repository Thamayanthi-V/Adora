<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
      </div>
      <!-- /.container-fluid -->
   </section>
   <form role="form">
      <!-- Main content -->
      <section class="content">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-6">
                  <div class="card card-info">
                     <div class="card-header">
                        <h3 class="card-title">Customer Details</h3>
                     </div>
                     <div class="card-body">
                        <div class="row">
                           <div class="col-6 col-md-6">
                              <!-- text input -->
                              <div class="form-group">
                                 <label>Customer Name</label>
                                 <input type="text" class="form-control" placeholder="">
                              </div>
                           </div>
                           <div class="col-6 col-md-6">
                              <div class="form-group">
                                 <label>Mobile</label>
                                 <input type="text" class="form-control" placeholder="">
                              </div>
                           </div>
                        </div>
                        <!-- /.form group -->
                        <div class="row">
                           <div class="col-6 col-md-6">
                              <div class="form-group">
                                 <label>Street</label>
                                 <input type="text" class="form-control" placeholder="">
                              </div>
                           </div>
                           <div class="col-6 col-md-6">
                              <div class="form-group">
                                 <label>Area</label>
                                 <input type="text" class="form-control" placeholder="">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-6 col-md-6">
                              <div class="form-group">
                                 <label>City</label>
                                 <input type="text" class="form-control" placeholder="">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- /.card-body -->
               </div>
               <!-- /.card -->
               <div class="col-md-6">
                  <div class="card card-info">
                     <div class="card-header">
                        <h3 class="card-title">Order</h3>
                     </div>
                     <div class="card-body">
                        <!-- Date range -->
                        <div class="row">
                           <div class="col-6 col-md-6">
                              <!-- text input -->
                              <div class="form-group">
                                 <label>Order No</label>
                                 <input type="text" class="form-control" placeholder="">
                              </div>
                           </div>
                           <div class="col-6 col-md-6">
                              <div class="form-group">
                                 <label>Order Date</label>
                                 <div class="input-group">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text">
                                       <i class="far fa-calendar-alt"></i>
                                       </span>
                                    </div>
                                    <input type="text" class="form-control float-right" id="reservation">
                                 </div>
                                 <!-- /.input group -->
                              </div>
                           </div>
                        </div>
                        <!-- /.form group -->
                        <!-- Date and time range -->
                        <div class="row">
                           <div class="col-6 col-md-6">
                              <div class="form-group">
                                 <label>Delivery Date</label>
                                 <div class="input-group">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text">
                                       <i class="far fa-calendar-alt"></i>
                                       </span>
                                    </div>
                                    <input type="text" class="form-control float-right" id="reservation">
                                 </div>
                                 <!-- /.input group -->
                              </div>
                           </div>
                           <div class="col-6 col-md-6">
                              <!-- text input -->
                              <div class="form-group">
                                 <label>Days for Delivery</label>
                                 <input type="text" class="form-control" placeholder="">
                              </div>
                           </div>
                        </div>
                        <div class="row mt-0">
                           <div class="col-sm-6 mb-5">
                              <div class="form-group clearfix">
                                 <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="checkboxPrimary1" checked="">
                                    <label for="checkboxPrimary1">
                                    Priority
                                    </label>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- /.form group -->
                     </div>
                     <!-- /.card-body -->
                  </div>
               </div>
            </div>
         </div>
         <!-- /.col (left) -->
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                  <div class="card card-info">
                     <div class="card-header">
                        <h3 class="card-title">Order Details</h3>
                     </div>
                     <div class="card-body">
                        <!-- Date range -->
                        <div class="row">
                           <div class="box-body table-responsive" style="background: #f9f9f9;">
                              <table class="table table-striped" id="tab_append">
                                 <tbody>
                                    <tr>
                                       <th width="5%">No</th>
                                       <th width="20%">Particulars</th>
                                       <th width="15%">No of Pcs</th>
                                       <th width="15%">Rate</th>
                                       <th width="15%">Amount</th>
                                       <th width="20%">Comments</th>
                                       <th>Action</th>
                                    </tr>
                                    <tr>
                                       <td>1</td>
                                       <td>
                                          <select class="form-control select2 extramenu3 order_Item mpcal select2-hidden-accessible" onchange="menuprice(3)" name="order_Item[]" id="order_Item3" required="" data-select2-id="order_Item3" tabindex="-1" aria-hidden="true">
                                             <option value="" data-select2-id="67">-Select-</option>
                                             <option value="5">Blouse</option>
                                          </select>
                                          <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="64" style="width: 251px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-order_Item3-container"><span class="select2-selection__rendered" id="select2-order_Item3-container" role="textbox" aria-readonly="true" title="-Select-">-Select-</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                       </td>
                                       <td> <input type="text" class="form-control  mpcal" required="" id="mPkt3" onchange="menucal(3)" name="order_Pack[]" value=""> </td>
                                       <td>
                                          <input type="text" class="form-control" name="order_singleQty[]" id="order_Qty3" required="" value="" onchange="menucal(3)" onkeypress="return floatKeypress(event)" onblur="checkQuantity(this.value,3);">
                                          <p id="order_Qty3_er"></p>
                                       </td>
                                       <td>
                                          <input type="text" class="form-control" name="order_singleQty[]" id="order_Qty3" required="" value="" onchange="menucal(3)" onkeypress="return floatKeypress(event)" onblur="checkQuantity(this.value,3);">
                                          <p id="order_Qty3_er"></p>
                                       </td>
                                       <td>
                                          <textarea class="form-control" rows="1" placeholder="Enter ..."></textarea> 
                                       </td>
                                       <td> <button type="button" class="btn btn-info add_row" onclick="add_row()">+</button> <button type="button" class="btn btn-danger remove_row">-</button></td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <!-- /.form group -->
                        <!-- Date range -->
                        <div class="row">
                           <div class="col-4 col-md-3">
                              <!-- text input -->
                              <div class="form-group">
                                 <label>Total  Amount</label>
                                 <input type="text" class="form-control" placeholder="">
                              </div>
                           </div>
                           <div class="col-4 col-md-3">
                              <div class="form-group">
                                 <label>Advance</label>
                                 <input type="text" class="form-control" placeholder="">
                              </div>
                           </div>
                           <div class="col-4 col-md-3">
                              <div class="form-group">
                                 <label>Bill  Amount</label>
                                 <input type="text" class="form-control" placeholder="">
                              </div>
                           </div>
                        
                        <div class="col-12 col-md-3">
                              <!-- text input -->
                              <div class="form-group">
                                 <label>Comments</label>
                                 <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                              </div>
                           </div>
                        <!-- /.form group -->
                      </div>
                        <div class="row">
                           <div class="col-md-12">
                              <div class="card card-info">
                                 <div class="card-header">
                                    <h3 class="card-title">Measurements</h3>
                                 </div>
                                 <div class="card-body">
                                    <div class="row">
                                       <div class="col-12 col-md-6">
                                          <div class="card card-secondary">
                                             <div class="card-header">
                                                <h3 class="card-title">Top</h3>
                                             </div>
                                             <!-- /.card-header -->
                                             <!-- form start -->
                                             <div class="card-body">
                                                <div class="row">
                                                   <div class="col-6 col-md-4">
                                                      <!-- text input -->
                                                      <div class="form-group">
                                                         <label>Length</label>
                                                         <input type="text" class="form-control" placeholder="">
                                                      </div>
                                                   </div>
                                                   <div class="col-6 col-md-4">
                                                      <div class="form-group">
                                                         <label>Shoulder</label>
                                                         <input type="text" class="form-control" placeholder="">
                                                      </div>
                                                   </div>
                                                   <div class="col-6 col-md-4">
                                                      <div class="form-group">
                                                         <label>Chest</label>
                                                         <input type="text" class="form-control" placeholder="">
                                                      </div>
                                                   </div>
                                                
                                                <!-- /.form group -->
                                                
                                                   <div class="col-6 col-md-4">
                                                      <div class="form-group">
                                                         <label>Waist</label>
                                                         <input type="text" class="form-control" placeholder="">
                                                      </div>
                                                   </div>
                                                   <div class="col-6 col-md-4">
                                                      <div class="form-group">
                                                         <label>Hip</label>
                                                         <input type="text" class="form-control" placeholder="">
                                                      </div>
                                                   </div>
                                                   <div class="col-6 col-md-4">
                                                      <div class="form-group">
                                                         <label>Sit Open</label>
                                                         <input type="text" class="form-control" placeholder="">
                                                      </div>
                                                   </div>
                                             
                                                
                                                   <div class="col-6 col-md-4">
                                                      <div class="form-group">
                                                         <label>Armhole</label>
                                                         <input type="text" class="form-control" placeholder="">
                                                      </div>
                                                   </div>
                                                   <div class="col-6 col-md-4">
                                                      <div class="form-group">
                                                         <label>Sleeve Length</label>
                                                         <input type="text" class="form-control" placeholder="">
                                                      </div>
                                                   </div>
                                                   <div class="col-6 col-md-4">
                                                      <div class="form-group">
                                                         <label>Sleeve Open</label>
                                                         <input type="text" class="form-control" placeholder="">
                                                      </div>
                                                   </div>
                                             
                                                   <div class="col-6 col-md-4">
                                                      <div class="form-group">
                                                         <label>Neck Width</label>
                                                         <input type="text" class="form-control" placeholder="">
                                                      </div>
                                                   </div>
                                                   <div class="col-6 col-md-4">
                                                      <div class="form-group">
                                                         <label>Neck Drop</label>
                                                         <input type="text" class="form-control" placeholder="">
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- /.card-footer -->
                                          </div>
                                       </div>
                                       <div class="col-12 col-md-6">
                                          <div class="card card-secondary">
                                             <div class="card-header">
                                                <h3 class="card-title">Bottom</h3>
                                             </div>
                                             <!-- /.card-header -->
                                             <!-- form start -->
                                             <div class="card-body">
                                                <div class="row">
                                                   <div class="col-6 col-md-4">
                                                      <!-- text input -->
                                                      <div class="form-group">
                                                         <label>Length</label>
                                                         <input type="text" class="form-control" placeholder="">
                                                      </div>
                                                   </div>
                                                   <div class="col-6 col-md-4">
                                                      <div class="form-group">
                                                         <label>Hip</label>
                                                         <input type="text" class="form-control" placeholder="">
                                                      </div>
                                                   </div>
                                                   <div class="col-6 col-md-4">
                                                      <div class="form-group">
                                                         <label>Thigh</label>
                                                         <input type="text" class="form-control" placeholder="">
                                                      </div>
                                                   </div>
                                               
                                                   <div class="col-6 col-md-4">
                                                      <div class="form-group">
                                                         <label>Knee</label>
                                                         <input type="text" class="form-control" placeholder="">
                                                      </div>
                                                   </div>
                                                   <div class="col-6 col-md-4">
                                                      <div class="form-group">
                                                         <label>Calf</label>
                                                         <input type="text" class="form-control" placeholder="">
                                                      </div>
                                                   </div>
                                                   <div class="col-6 col-md-4">
                                                      <div class="form-group">
                                                         <label>Leg Open</label>
                                                         <input type="text" class="form-control" placeholder="">
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
                  </div>
                </div>
             </div>
          </div>
       </section>
    </form>
 </div>