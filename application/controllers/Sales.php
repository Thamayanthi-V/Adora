<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends MY_Controller {

	
	function __construct()
    {
        parent::__construct();
        $this->load->model('OrderModel');
    }

    public function index()
    {
        $this->load->view('temp-parts/header');
        
        if($this->input->post()) {
            $data['customer'] = $this->input->post('customer');
            $cus  =  $this->OrderModel->getDetailsByRow("adora_customer",array('id'=>$this->input->post('customer'),'customer_active'=>"A"));
            $data['customer_name'] = $cus->customer_Name;
            $data['order_Number'] = $this->input->post('order_Number');
             $data['sales_Number'] = $this->input->post('sales_Number');
            $data['from'] = $this->input->post('from');
             $data['to'] = $this->input->post('to');

        } else {
            $data['customer'] = "";
            $data['customer_name'] ="";
            $data['order_Number'] = "";
             $data['sales_Number'] = "";
            $data['from'] = "";
            $data['to'] = "";
        }
    $data['orderlist']=$this->OrderModel->getorder("adora_sales","sales_Date","sales_CustomerID","sales_Date"); 
        $this->load->view('sales/sales-list',$data);
        $this->load->view('temp-parts/footer');
    }
    public function ordersales()
    {
        $this->load->view('temp-parts/header');
          if($this->input->post()) {
            $data['customer'] = $this->input->post('customer');
            $cus  =  $this->OrderModel->getDetailsByRow("adora_customer",array('id'=>$this->input->post('customer'),'customer_active'=>"A"));
            $data['customer_name'] = $cus->customer_Name;
            $data['order_Number'] = $this->input->post('order_Number');
           
            $data['from'] = $this->input->post('from');
             $data['to'] = $this->input->post('to');

        } else {
            $data['customer'] = "";
            $data['customer_name'] ="";
            $data['order_Number'] = "";
           
            $data['from'] = "";
            $data['to'] = "";
        }
         $data['orderlist']=$this->OrderModel->getorder("adora_order","order_OrderDate","order_CustomerID","order_DeliveryDate"); 
        $this->load->view('sales/ordersaleslist',$data);
        $this->load->view('temp-parts/footer');
    }
    public function ordersalesnew($id=0)
    {
        $this->load->view('temp-parts/header');
        $orderCount         = $this->OrderModel->ExecuteQuery("select count(id) as maxID from adora_sales")->row();
    $oID = (!empty($orderCount))?($orderCount->maxID+1):'1';
    $data['sales_Number']=$oID;
    $data['product']=$this->core_model->getDetailsByResultArray("adora_product",array('product_active'=>'A'));

    if(isset($id))
     {
      
     $data['orders']=$this->core_model->getDetailsByRow("adora_order",array('Active'=>'A','id'=>base64_decode($id) ));
       $data['ordercustomer']=$this->core_model->getDetailsByRow("adora_customer",array('customer_active'=>'A','id'=>$data['orders']->order_CustomerID)); 
    
     $data['orders_details']=$this->core_model->getDetailsByResultArray("adora_task",array('Active'=>'A','orderID'=>base64_decode($id))); 
     }
      $this->load->view('sales/order-newsale',$data);
      $this->load->view('temp-parts/footer');
    }
public function salesnew()
    {
        $this->load->view('temp-parts/header');
        $orderCount         = $this->OrderModel->ExecuteQuery("select count(id) as maxID from adora_sales")->row();
    $oID = (!empty($orderCount))?($orderCount->maxID+1):'1';
    $data['sales_Number']=$oID;
    $data['product']=$this->core_model->getDetailsByResultArray("adora_product",array('product_active'=>'A','product_type'=>'SALE'));

    if(isset($id))
     {
      
     $data['orders']=$this->core_model->getDetailsByRow("adora_sales",array('Active'=>'A','id'=>base64_decode($id) ));
       $data['ordercustomer']=$this->core_model->getDetailsByRow("adora_customer",array('customer_active'=>'A','id'=>$data['orders']->sales_CustomerID)); 
    
     $data['orders_details']=$this->core_model->getDetailsByResultArray("adora_salesdetails",array('Active'=>'A','salesID'=>base64_decode($id))); 
     }
      $this->load->view('sales/sales-new',$data);
      $this->load->view('temp-parts/footer');
    }
    public function salesprint($id=0){
         $this->load->view('temp-parts/header');
          $data['product']=$this->core_model->getDetailsByResultArray("adora_product",array('product_active'=>'A'));

    if(isset($id))
     {
      
     $data['orders']=$this->core_model->getDetailsByRow("adora_sales",array('Active'=>'A','id'=>base64_decode($id) ));
       $data['ordercustomer']=$this->core_model->getDetailsByRow("adora_customer",array('customer_active'=>'A','id'=>$data['orders']->sales_CustomerID)); 
    
     $data['orders_details']=$this->core_model->getDetailsByResultArray("adora_salesdetails",array('Active'=>'A','salesID'=>base64_decode($id))); 
    
     }
      //print_r($data);
        $this->load->view('sales/sales_print',$data);
      $this->load->view('temp-parts/footer');
    }
    public function getextramenu(){
        //print_r($_POST);
        
        $itemStr    = $this->input->post('itemStr');
        
        $itemAr     = explode(',', $itemStr);
        
        $menu   =  $this->OrderModel->salegetNotInvalues('adora_product','product_active',$itemAr,'SALE');
        
        echo '<option value="">-Select-</option>';
        foreach($menu as $menuval){
                        
            echo  "<option value=".$menuval['id'].">".$menuval['product_Name']."</option>";
        } 
  }
  public function saveSales(){
    
    $data = array('success' => false, 'messages' =>array());
    $this->load->library('form_validation');
    $vid=$this->input->post('order_ID');
   if($vid==''){ 
    $config = array(
        array(
                'field' => 'customer_Name',
                'label' => 'customer Name',
                'rules' => 'required'
        ),

      array(
                'field' => 'customer_Mobile',
                'label' => 'Mobile',
                'rules' => 'required|regex_match[/^[0-9]{10}$/]',
                
          ),
      array(
                'field' => 'sales_Number',
                'label' => 'Sales Number',
                'rules' => 'required|is_unique[adora_sales.sales_Number]',
                
          ),
         array(
                'field' => 'order_OrderDate',
                'label' => 'bill Date',
                'rules' => 'required',
                
          ),
         
         array(
                'field' => 'order_Advance',
                'label' => 'Advance',
                'rules' => 'required',
                
          ),
        /*array(
                'field' => 'c_address',
                'label' => 'Address',
                'rules' => 'required',
                
            ),
        array(
                'field' => 'c_area',
                'label' => 'Area',
                'rules' => 'required',
                
            ),
        array(
                'field' => 'c_city',
                'label' => 'City',
                'rules' => 'required',
                
            ),*/
        
        
    );
 }
 else{
  $config = array(
        
       
        array(
                'field' => 'sales_Number',
                'label' => 'Sales Number',
                'rules' => 'required'
        ));
 }
    $this->form_validation->set_rules($config);
    $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
      if ($this->form_validation->run() == FALSE)
                {
                
                       foreach ($_POST as $key => $value) {
                        $data['messages'][$key] = form_error($key);
                       }
                }
          
                else
                {
                   $order_ID=$this->input->post('order_ID');
                   
            //insert
             $customer_name=$this->input->post('customer_Name');
                    //customer new
                 if($customer_name==0)
                   {
               $customer=array('customer_Name'=>$this->input->post('customer_Name'),'customer_Mobile'=>$this->input->post('customer_Mobile'), 'customer_Street'=>$this->input->post('customer_Street'),'customer_Area'=>$this->input->post('customer_Area'),'customer_City'=>$this->input->post('customer_City'),'branch_ID'=>$this->session->userdata('customer_branch'));
                $resultsc = $this->core_model->simpleInsert('adora_customer',$customer);
       
              $customerid=$this->core_model->getLastInsertId(); 
                      }
                       //customer new end
                       //customer old
                  else{
               $customerid=$this->input->post('customer_Name');
     
              }
               
                $qtycount=array_sum($this->input->post('OD_ProductQty'));
              //$top=$this->input->post('toplength').",".$this->input->post('topshoulder');
                
                            
             
                $bal=$this->input->post('order_TotalAmount')-$this->input->post('order_Advance');
                   $booking=array('sales_Number'=>$this->input->post('sales_Number'),
                        'sales_CustomerID'=>$customerid,
                        'sales_CustomerName'=>$this->input->post('customer_fullName'),
                        'sales_TotalQty'=>$qtycount,
                        'sales_TotalAmount'=>$this->input->post('order_TotalAmount'),
                        'sales_Advance'=>$this->input->post('order_Advance'),
                        'sales_Discount'=>$this->input->post('order_Discount'),
                        'sales_Balance'=>$bal,
                         'sales_Source'=>$this->input->post('sales_Source'),
                        //'order_Status'=>$this->input->post('order_Status'),
                        'branch_ID'=>$this->session->userdata('customer_branch'),
                        
                        'sales_Date'=>date('Y-m-d',strtotime($this->input->post('order_OrderDate'))),
                        
                        
                        
                        //'order_CraetedBy' => $this->data['royalLoginID'],

                        );
                     $order_res=$this->OrderModel->commonInsert('adora_sales',$booking);
                     
                     if($order_res==true){
                        $orderid=$this->core_model->getLastInsertId(); 
                          $data['order_id']=base64_encode($orderid);
                        $p=count($this->input->post('OD_ProductName'));
                         $order_Item=$this->input->post('OD_ProductName');
                         $order_Qty=$this->input->post('OD_ProductQty');
                         $order_Unitprice=$this->input->post('OD_ProductRate');
                          $totalamount  = $this->input->post('OD_ProductAmount');
                         $OD_ProductComment  =$this->input->post('OD_ProductComment');
                        
                           $inproduct=implode(",",$order_Item);
          $product_details=$this->OrderModel->getinproduct($inproduct);
          
           $product_Name = array_column($product_details, 'product_Name');
            $product_Type = array_column($product_details, 'product_type');
            /*$payment=array(
                          'orderID'=>$orderid,
                          'order_Number'=>$this->input->post('order_Number'),
                          'customerID'=>$customerid,
                          'payment_Amount'=>$this->input->post('order_Advance'),
                          'payment_Type'=>$this->input->post('payment_Type'),
                          );
                        $pay=$this->OrderModel->commonInsert('adora_payment',$payment);*/
                        $s=1;
                        for($x = 0; $x <$p; $x++){
                           //print_r($product_Name[$i]);
                        $order_Details=array(
                          'salesID'=>$orderid,
                          'sales_Number'=>$this->input->post('sales_Number'),
                          'customerID'=>$customerid,
                          'SD_ProductName'=>$product_Name[$x],
                          'SD_ProductID'=>$order_Item[$x],
                          'SD_ProductQty'=>$order_Qty[$x],
                          'SD_ProductRate'=>$order_Unitprice[$x],
                          'SD_ProductAmount'=>$totalamount[$x],
                           'branch_ID'=>$this->session->userdata('customer_branch'),
                           
                          //'created_BY' => $this->data['royalLoginID'],
                          'sales_Date'=>date('Y-m-d',strtotime($this->input->post('order_OrderDate'))),);
                        
                        $orderdetails_res=$this->OrderModel->commonInsert('adora_salesdetails',$order_Details);
                         $orderdetailsID=$this->core_model->getLastInsertId();
                       
                         /*for($t = 0; $t <$order_Qty[$x]; $t++){
                         $task_Details=array(
                          'orderID'=>$orderid,
                          'order_Number'=>$this->input->post('order_Number'),
                          'orderDeatilsID'=>$orderdetailsID,
                          'customerID'=>$customerid,
                          'task_ProductName'=>$product_Name[$x],
                          'task_ProductID'=>$order_Item[$x],
                          'task_ProductQty'=>1,
                          'task_ProductRate'=> $order_Unitprice[$x],
                          'task_ProductAmount'=>$order_Unitprice[$x],
                          'task_ProductComment' =>trim($OD_ProductComment[$x]),
                          'task_ItemCode'=>($this->input->post('order_Number'))."-".($s),
                          //'created_BY' => $this->data['royalLoginID'],
                          'task_OrderDate'=>date('Y-m-d',strtotime($this->input->post('order_OrderDate'))),
                          'task_DeliveryDate'=>$this->input->post('order_DeliveryDate'),
                          'task_type'=>($product_Type[$x]=="SALE")?'SALE':'SERVICE',
                          'task_Priority'=>(!$this->input->post('order_Priority') )?'NO':'YES');
                         
                          $task=$this->OrderModel->commonInsert('adora_task',$task_Details); 
                        $s++;
                        }*/
                
             }
           }
        //insert

          $data['success'] = true;

          
  }
    echo json_encode($data);
   }
    /* Product type based form field load  ends */
    public function saveordersale(){
        
        $data = array('success' => false, 'messages' =>array());
    $this->load->library('form_validation');
    $vid=$this->input->post('order_ID');
   if($vid==''){ 
    $config = array(
        array(
                'field' => 'customer_Name',
                'label' => 'customer Name',
                'rules' => 'required'
        ),

      array(
                'field' => 'customer_Mobile',
                'label' => 'Mobile',
                'rules' => 'required|regex_match[/^[0-9]{10}$/]',
                
          ),
      array(
                'field' => 'sales_Number',
                'label' => 'Sales Number',
                'rules' => 'required|is_unique[adora_sales.sales_Number]',
                
          ),
         array(
                'field' => 'order_OrderDate',
                'label' => 'bill Date',
                'rules' => 'required',
                
          ),
         
         array(
                'field' => 'order_Advance',
                'label' => 'Advance',
                'rules' => 'required',
                
          ),
        /*array(
                'field' => 'c_address',
                'label' => 'Address',
                'rules' => 'required',
                
            ),
        array(
                'field' => 'c_area',
                'label' => 'Area',
                'rules' => 'required',
                
            ),
        array(
                'field' => 'c_city',
                'label' => 'City',
                'rules' => 'required',
                
            ),*/
        
        
    );
 }
 else{
  $config = array(
        
       
        array(
                'field' => 'sales_Number',
                'label' => 'Sales Number',
                'rules' => 'required'
        ));
 }
    $this->form_validation->set_rules($config);
    $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
      if ($this->form_validation->run() == FALSE)
                {
                
                       foreach ($_POST as $key => $value) {
                        $data['messages'][$key] = form_error($key);
                       }
                }
          
                else
                {
                   $order_ID=$this->input->post('order_ID');
                   
            //insert
             $customer_name=$this->input->post('customer_Name');
                    //customer new
                 if($customer_name==0)
                   {
               $customer=array('customer_Name'=>$this->input->post('customer_Name'),'customer_Mobile'=>$this->input->post('customer_Mobile'), 'customer_Street'=>$this->input->post('customer_Street'),'customer_Area'=>$this->input->post('customer_Area'),'customer_City'=>$this->input->post('customer_City'),'branch_ID'=>$this->session->userdata('customer_branch'));
                $resultsc = $this->core_model->simpleInsert('adora_customer',$customer);
       
              $customerid=$this->core_model->getLastInsertId(); 
                      }
                       //customer new end
                       //customer old
                  else{
               $customerid=$this->input->post('customer_Name');
     
              }
               
                $qtycount=array_sum($this->input->post('OD_ProductQty'));
              //$top=$this->input->post('toplength').",".$this->input->post('topshoulder');
                
                            
             
                $bal=$this->input->post('order_TotalAmount')-$this->input->post('order_Advance');
                   $booking=array('sales_Number'=>$this->input->post('sales_Number'),
                        'order_Number'=>$this->input->post('order_Number'),
                        'orderID'=>$this->input->post('order_ID'),
                        'sales_CustomerID'=>$customerid,
                        'sales_CustomerName'=>$this->input->post('customer_fullName'),
                        'sales_TotalQty'=>$qtycount,
                        'sales_TotalAmount'=>$this->input->post('order_TotalAmount'),
                        'sales_Advance'=>$this->input->post('order_Advance'),
                        'sales_Discount'=>$this->input->post('order_Discount'),
                        'sales_Balance'=>$bal,
                        'sales_Source'=>$this->input->post('sales_Source'),
                        'sales_OrderDate'=>date('Y-m-d',strtotime($this->input->post('order_OrderDate'))),
                        //'order_Status'=>$this->input->post('order_Status'),
                        
                        'branch_ID'=>$this->session->userdata('customer_branch'), 
                        'sales_Date'=>date('Y-m-d',strtotime($this->input->post('sales_Date'))),
                        
                        
                        
                        //'order_CraetedBy' => $this->data['royalLoginID'],

                        );
                     $order_res=$this->OrderModel->commonInsert('adora_sales',$booking);
                     
                     if($order_res==true){
                        $orderid=$this->core_model->getLastInsertId(); 
                          $data['order_id']=base64_encode($orderid);
                        $p=count($this->input->post('OD_ProductName'));
                         $order_Item=$this->input->post('OD_ProductName');
                         $order_Qty=$this->input->post('OD_ProductQty');
                         $order_Unitprice=$this->input->post('OD_ProductRate');
                          $totalamount  = $this->input->post('OD_ProductAmount');
                         $taskid  = $this->input->post('task');
                        
                           $inproduct=implode(",",$order_Item);
          $product_details=$this->OrderModel->getinproduct($inproduct);
          
           $product_Name = array_column($product_details, 'product_Name');
            $product_Type = array_column($product_details, 'product_type');
            /*$payment=array(
                          'orderID'=>$orderid,
                          'order_Number'=>$this->input->post('order_Number'),
                          'customerID'=>$customerid,
                          'payment_Amount'=>$this->input->post('order_Advance'),
                          'payment_Type'=>$this->input->post('payment_Type'),
                          );
                        $pay=$this->OrderModel->commonInsert('adora_payment',$payment);*/
                        $s=1;
                        for($x = 0; $x <$p; $x++){
                           //print_r($product_Name[$i]);
                        $order_Details=array(
                          'salesID'=>$orderid,
                          'sales_Number'=>$this->input->post('sales_Number'),
                          'order_Number'=>$this->input->post('order_Number'),
                        'orderID'=>$this->input->post('order_ID'),
                          'customerID'=>$customerid,
                          'SD_ProductName'=>$product_Name[$x],
                          'SD_ProductID'=>$order_Item[$x],
                          'SD_ProductQty'=>$order_Qty[$x],
                          'SD_ProductRate'=>$order_Unitprice[$x],
                          'SD_ProductAmount'=>$totalamount[$x],
                           'branch_ID'=>$this->session->userdata('customer_branch'),
                           
                          //'created_BY' => $this->data['royalLoginID'],
                          'sales_Date'=>date('Y-m-d',strtotime($this->input->post('sales_Date'))),);
                        
                        $orderdetails_res=$this->OrderModel->commonInsert('adora_salesdetails',$order_Details);
                         $orderdetailsID=$this->core_model->getLastInsertId();
                       
                     $taskupdate=array('task_BillStatus'=>"YES");
                     $orderupdate = $this->OrderModel->update('adora_task',$taskupdate,$taskid[$x],'id');
                
             }
           }
           $tadvance=$this->input->post('orderpaidamount')+$this->input->post('order_Advance');
           $tdis=$this->input->post('orderdfinaldis')+$this->input->post('order_Discount');
            $bal=$this->input->post('orderfinal')-$tadvance;
             $orderqty=$this->input->post('order_TotalQty');
            $order_SoldQty=$this->input->post('order_SoldQty');
            $ocuurentsold=$order_SoldQty+count($this->input->post('OD_ProductName'));

                   $booking=array(
                        'order_Advance'=>$tadvance,
                        'order_Balance'=>$bal,
                        'order_Discount'=>$tdis,
                        'order_SoldQty'=>$ocuurentsold,
                        'order_Status'=>($orderqty==$ocuurentsold)?'Complete':'',
                          'order_UpdatedDate'=>date('Y-m-d h:i:s')
                        //'order_CraetedBy' => $this->data['royalLoginID'],

                        );

                        $orderupdate = $this->OrderModel->update('adora_order',$booking,$this->input->post('order_ID'),'id');
        //insert

          $data['success'] = true;

          
  }
    echo json_encode($data);
    }
}