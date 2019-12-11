<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderProcess extends MY_Controller {

	
	function __construct()
    {
        parent::__construct();
        $this->load->model('OrderModel');
    }
	 public function index($id)
	{
    
  
		$this->load->view('temp-parts/header');
		$this->load->view('temp-parts/drawing');
    $orderCount         = $this->OrderModel->ExecuteQuery("select count(id) as maxID from adora_order")->row();
    $oID = (!empty($orderCount))?($orderCount->maxID+1):'1';
     $data['order_number']=$oID;
    $data['product']=$this->core_model->getDetailsByResultArray("adora_product",array('product_active'=>'A'));

    if(isset($id))
     {
      $data['orders']=$this->core_model->getDetailsByRow("adora_order",array('Active'=>'A','id'=>base64_decode($id) ));
       $data['ordercustomer']=$this->core_model->getDetailsByRow("adora_customer",array('customer_active'=>'A','id'=>$data['orders']->order_CustomerID)); 

     $top=$data['orders']->order_MeasurmentTop;
     $data['measurement']=json_decode($top);
     $bottom=$data['orders']->order_MeasurmentBottom;
    $data['measurement_bottom']=json_decode($bottom);
     $data['orders_details']=$this->core_model->getDetailsByResultArray("adora_orderdetails",array('Active'=>'A','orderID'=>base64_decode($id)));
      $data['orders']=$this->core_model->getDetailsByRow("adora_order",array('Active'=>'A','id'=>base64_decode($id) ));
      $data['sales']=$this->core_model->getDetailsByResultArray("adora_sales",array('Active'=>'A','orderID'=>base64_decode($id)));
      $data['task']=$this->core_model->getDetailsByResultArray("adora_task",array('Active'=>'A','orderID'=>base64_decode($id),'task_type'=>'SERVICE'));
    // $data['sales']=$this->core_model->getDetailsByResultArray("adora_sales",array('Active'=>'A','orderID'=>base64_decode($id))); 
     }
		$this->load->view('order/orderprocess',$data);
		$this->load->view('temp-parts/footer');
	}
   public function orderlist()
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
    //print_r($data['orderlist']);
   
    $this->load->view('order/orderlist',$data);
    $this->load->view('temp-parts/footer');
  }
  public function deleteorder($id){
    
    $this->OrderModel->update('adora_order',array('Active'=>"E"),base64_decode($id),'id');
    $this->OrderModel->update('adora_orderdetails',array('Active'=>"E"),base64_decode($id),'orderID');
    $this->OrderModel->update('adora_task',array('Active'=>"E"),base64_decode($id),'orderID');
    redirect('OrderDetails');
  }
	 // Get users
   public function getUsers(){

      // Search term
      $searchTerm = $this->input->post('searchTerm');

      // Get users
      $response = $this->OrderModel->getUsers($searchTerm);

      echo json_encode($response);
   }
   public function getextramenu(){
		//print_r($_POST);
		
		$itemStr 	= $this->input->post('itemStr');
		
		$itemAr     = explode(',', $itemStr);
		
    	$menu 	=  $this->OrderModel->getNotInvalues('adora_product','product_active',$itemAr);
    	
    	echo '<option value="">-Select-</option>';
    	foreach($menu as $menuval){
                        
    		echo  "<option value=".$menuval['id'].">".$menuval['product_Name']."</option>";
        } 
  }
  public function getPrice(){
		$menuId = $_POST['menuId'];
		$menup 	=  $this->OrderModel->getMenuPrice($menuId);
		echo json_encode($menup);
	}
  public function getCustomer(){
    $cusId = $_POST['cusId'];
    $cus  =  $this->OrderModel->getDetailsByRow("adora_customer",array('id'=>$cusId,'customer_active'=>"A"));
    echo json_encode($cus);
  }
   public function checkworkdays(){
   
    //get dates
     /*$odate = date('Y-m-d',strtotime($this->input->post('odate') ));
    $delivery_date= date('Y-m-d',strtotime($this->input->post('delivery_date')));
   
   // Declare two dates 
$Date1 = $odate; 
$Date2 = $delivery_date; 
  
// Declare an empty array 
$array = array(); 
  
// Use strtotime function 
$Variable1 = strtotime($Date1); 
$Variable2 = strtotime($Date2); 
  
// Use for loop to store dates into array 
// 86400 sec = 24 hrs = 60*60*24 = 1 day 
for ($currentDate = $Variable1; $currentDate <= $Variable2;  
                                $currentDate += (86400)) { 
                                      
$Store = date('Y-m-d', $currentDate); 
$array[] = $Store; 
} 
  
// Display the dates in array format 
$totalcount=count($array); 
 //$string_version = implode(',', $array);
$string_version =implode("','", $array);
 $response = $this->OrderModel->getInvalues("adora_calender",$string_version);
 $incount=count($response);
 echo $totalcount-$incount; */
  


  $odate = date('Y-m-d',strtotime($this->input->post('odate') ));
  $delivery_date= date('Y-m-d',strtotime($this->input->post('delivery_date')));

$Variable1 = strtotime($odate); 

$Variable2 = strtotime($delivery_date); 
  if($Variable1<=$Variable2){
  	$start = new DateTime($odate);
$end = new DateTime($delivery_date);
// otherwise the  end date is excluded (bug?)
$end->modify('+1 day');

$interval = $end->diff($start);

// total days
$days = $interval->days;

// create an iterateable period of date (P1D equates to 1 day)
$period = new DatePeriod($start, new DateInterval('P1D'), $end);

// best stored as array, so you can add more than one
$holidays = array('2012-09-07');

foreach($period as $dt) {
    $curr = $dt->format('D');

    // substract if Saturday or Sunday
    /*if ($curr == 'Sat' || $curr == 'Sun') {
        $days--;
    }*/
 if ($curr == 'Sun') {
        $days--;
    }

    // (optional) for the updated question
    /*elseif (in_array($dt->format('Y-m-d'), $holidays)) {
        $days--;
    }*/
}


echo $days;
  }
  else {
  	echo 0;
  }
    
    
   }
   public function testdate(){
   	$start = new DateTime('2019-09-25');
$end = new DateTime('2019-09-30');
// otherwise the  end date is excluded (bug?)
$end->modify('+1 day');

$interval = $end->diff($start);

// total days
$days = $interval->days;

// create an iterateable period of date (P1D equates to 1 day)
$period = new DatePeriod($start, new DateInterval('P1D'), $end);

// best stored as array, so you can add more than one
$holidays = array('2019-09-26','2019-09-27','2019-09-30');

foreach($period as $dt) {
    $curr = $dt->format('D');

    // substract if Saturday or Sunday
    if ($curr == 'Sat' || $curr == 'Sun') {
        $days--;
    }

    // (optional) for the updated question
    elseif (in_array($dt->format('Y-m-d'), $holidays)) {
        $days--;
    }
}


echo $days; // 4
   }
  
   public function saveorder(){
    
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
                'field' => 'order_Number',
                'label' => 'Order Number',
                'rules' => 'required|is_unique[adora_order.order_Number]',
                
          ),
         array(
                'field' => 'order_OrderDate',
                'label' => 'Order Date',
                'rules' => 'required',
                
          ),
         array(
                'field' => 'order_DeliveryDate',
                'label' => 'Delivery Date',
                'rules' => 'required',
                
          ),
         array(
                'field' => 'customer_Email',
                'label' => 'Email',
                'rules' => 'required',
         ),
          /*array(
                'field' => 'order_Advance',
                'label' => 'Advance',
                'rules' => 'required',
                
          ),
       array(
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
                'field' => 'order_Number',
                'label' => 'order Number',
                'rules' => 'required'
        ),);
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
                   //update
             
             if($order_ID!='') {
               $customer_name=$this->input->post('customer_Name');
                   //customer new
                 if($customer_name==0)
                   {
               $customer=array('customer_Name'=>$this->input->post('customer_Name'),'customer_Mobile'=>$this->input->post('customer_Mobile'), 'customer_Email'=>$this->input->post('customer_Email'), 'customer_Street'=>$this->input->post('customer_Street'),'customer_Area'=>$this->input->post('customer_Area'),'customer_City'=>$this->input->post('customer_City'),'branch_ID'=>$this->session->userdata('customer_branch'));
                $resultsc = $this->core_model->simpleInsert('adora_customer',$customer);
               $customerid=$this->core_model->getLastInsertId(); 
                      }
                      //customer new end
                      //customer old start
                  else{
               $customerid=$this->input->post('customer_Name');
               $customerupdate=array('customer_Name'=>$this->input->post('customer_fullName'),'customer_Mobile'=>$this->input->post('customer_Mobile'), 'customer_Email'=>$this->input->post('customer_Email'), 'customer_Street'=>$this->input->post('customer_Street'),'customer_Area'=>$this->input->post('customer_Area'),'customer_City'=>$this->input->post('customer_City'),'customer_updated_at'=>date('Y-m-d h:i:s'),'branch_ID'=>$this->session->userdata('customer_branch'));
                   $resultupdate = $this->OrderModel->update('adora_customer',$customerupdate,$customerid,'id');
                     }
                    
                     //product  and task insert
                 $delete=$this->OrderModel->delete('adora_orderdetails','orderID',$order_ID);
                 $deletetask=$this->OrderModel->delete('adora_task','orderID',$order_ID);
                 if($delete==true){
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
          
           /* $payment=array(
                          'orderID'=>$order_ID,
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
                          'orderID'=>$order_ID,
                          'order_Number'=>$this->input->post('order_Number'),
                          'customerID'=>$customerid,
                          'OD_ProductName'=>$product_Name[$x],
                          'OD_ProductID'=>$order_Item[$x],
                          'OD_ProductQty'=>$order_Qty[$x],
                          'OD_ProductRate'=> $order_Unitprice[$x],
                          'OD_ProductAmount'=>$totalamount[$x],
                           'OD_ProductComment' =>trim($OD_ProductComment[$x]),
                           
                          //'created_BY' => $this->data['royalLoginID'],
                          'order_OrderDate'=>date('Y-m-d',strtotime($this->input->post('order_OrderDate'))),'order_DeliveryDate'=>date('Y-m-d',strtotime($this->input->post('order_DeliveryDate'))),'branch_ID'=>$this->session->userdata('customer_branch'));
                        
                        $orderdetails_res=$this->OrderModel->commonInsert('adora_orderdetails',$order_Details);
                         $orderdetailsID=$this->core_model->getLastInsertId();
                         
                        for($t = 0; $t <$order_Qty[$x]; $t++){
                         $task_Details=array(
                          'orderID'=>$order_ID,
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
                          'task_DeliveryDate'=>date('Y-m-d',strtotime($this->input->post('order_DeliveryDate'))),
                          'task_type'=>($product_Type[$x]=="SALE")?'SALE':'SERVICE',
                          'branch_ID'=>$this->session->userdata('customer_branch'),
                          'task_Priority'=>(!$this->input->post('order_Priority') )?'NO':'YES') ;
                         $task=$this->OrderModel->commonInsert('adora_task',$task_Details);
                         $s++;
                        }
                      
                        
                             }
                 }
                  //order update
                     $qtycount=array_sum($this->input->post('OD_ProductQty'));
              //$top=$this->input->post('toplength').",".$this->input->post('topshoulder');
                $top = array('toplength'=>$this->input->post('toplength'), 
                  'topshoulder'=>$this->input->post('topshoulder'),   
                  'topchest'=>$this->input->post('topchest'),
                  'topwaist'=>$this->input->post('topwaist'),
                            'tophip'=>$this->input->post('tophip'),
                            'topsitopen'=>$this->input->post('topsitopen'),
                            'toparmhole'=>$this->input->post('toparmhole'),
                          'topsleevelength'=>$this->input->post('topsleevelength'),
                          'topsleeveopen'=>$this->input->post('topsleeveopen'),
                            'topsneckwidth'=>$this->input->post('topsneckwidth'),
                          'topsneckdrop'=>$this->input->post('topsneckdrop'));
               
              
              $bottom=array('bottomlength'=>$this->input->post('bottomlength'),
                            'bottomhip'=>$this->input->post('bottomhip'),
                          'bottomthigh'=>$this->input->post('bottomthigh'),
                            'bottomknee'=>$this->input->post('bottomknee'),
                            'bottomcalf'=>$this->input->post('bottomcalf'),
                            "bottomlegopen"=>$this->input->post('bottomlegopen') );
                            
             
                $bal=$this->input->post('order_TotalAmount')-$this->input->post('order_Advance');
                   $booking=array('order_Number'=>$this->input->post('order_Number'),
                        'order_CustomerID'=>$customerid,
                        'order_CustomerName'=>$this->input->post('customer_fullName'),
                        'order_TotalQty'=>$qtycount,
                        'order_TotalAmount'=>$this->input->post('order_TotalAmount'),
                        'order_Advance'=>$this->input->post('order_Advance'),
                        'order_Balance'=>$bal,

                        //'order_Status'=>$this->input->post('order_Status'),
                        'sales_Source'=>$this->input->post('order_Status'),
                        'order_OrderDate'=>date('Y-m-d',strtotime($this->input->post('order_OrderDate'))),
                        'order_DeliveryDate'=>date('Y-m-d',strtotime($this->input->post('order_DeliveryDate'))),
                        'order_DaysOfDelivery'=>$this->input->post('order_DaysOfDelivery'),
                        'order_GeneralComments'=>$this->input->post('order_GeneralComments'),
                        'order_MeasurmentTop'=>json_encode($top),
                        'order_MeasurmentBottom'=>json_encode($bottom),
                        'order_Priority'=>(!$this->input->post('order_Priority') )?'NO':'YES',
                        'order_UpdatedDate'=>date('Y-m-d h:i:s'),
                        'branch_ID'=>$this->session->userdata('customer_branch')
                        //'order_CraetedBy' => $this->data['royalLoginID'],

                        );

                        $orderupdate = $this->OrderModel->update('adora_order',$booking,$this->input->post('order_ID'),'id');
                     //order update
             }
             //update
             //insert
             else{

                   $customer_name=$this->input->post('customer_Name');
                    //customer new
                 if($customer_name==0)
                   {
               $customer=array('customer_Name'=>$this->input->post('customer_Name'),'customer_Mobile'=>$this->input->post('customer_Mobile'), 'customer_Email'=>$this->input->post('customer_Email'), 'customer_Street'=>$this->input->post('customer_Street'),'customer_Area'=>$this->input->post('customer_Area'),'customer_City'=>$this->input->post('customer_City'),'branch_ID'=>$this->session->userdata('customer_branch'));
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
                $top = array('toplength'=>$this->input->post('toplength'), 
                  'topshoulder'=>$this->input->post('topshoulder'),   
                  'topchest'=>$this->input->post('topchest'),
                  'topwaist'=>$this->input->post('topwaist'),
                            'tophip'=>$this->input->post('tophip'),
                            'topsitopen'=>$this->input->post('topsitopen'),
                            'toparmhole'=>$this->input->post('toparmhole'),
                          'topsleevelength'=>$this->input->post('topsleevelength'),
                          'topsleeveopen'=>$this->input->post('topsleeveopen'),
                            'topsneckwidth'=>$this->input->post('topsneckwidth'),
                          'topsneckdrop'=>$this->input->post('topsneckdrop'));
               
              
              $bottom=array('bottomlength'=>$this->input->post('bottomlength'),
                            'bottomhip'=>$this->input->post('bottomhip'),
                          'bottomthigh'=>$this->input->post('bottomthigh'),
                            'bottomknee'=>$this->input->post('bottomknee'),
                            'bottomcalf'=>$this->input->post('bottomcalf'),
                            "bottomlegopen"=>$this->input->post('bottomlegopen') );
                            
             
                $bal=$this->input->post('order_TotalAmount')-$this->input->post('order_Advance');
                   $booking=array('order_Number'=>$this->input->post('order_Number'),
                        'order_CustomerID'=>$customerid,
                        'order_CustomerName'=>$this->input->post('customer_fullName'),
                        'order_TotalQty'=>$qtycount,
                        'order_TotalAmount'=>$this->input->post('order_TotalAmount'),
                        'order_Advance'=>$this->input->post('order_Advance'),
                        'order_Balance'=>$bal,

                        //'order_Status'=>$this->input->post('order_Status'),
                        'sales_Source'=>$this->input->post('order_Status'),
                        'order_OrderDate'=>date('Y-m-d',strtotime($this->input->post('order_OrderDate'))),
                        'order_DeliveryDate'=>date('Y-m-d',strtotime($this->input->post('order_DeliveryDate'))),
                        'order_DaysOfDelivery'=>$this->input->post('order_DaysOfDelivery'),
                        'order_GeneralComments'=>$this->input->post('order_GeneralComments'),
                        'order_MeasurmentTop'=>json_encode($top),
                        'order_MeasurmentBottom'=>json_encode($bottom),
                        'branch_ID'=>$this->session->userdata('customer_branch'),
                        'order_Priority'=>(!$this->input->post('order_Priority') )?'NO':'YES',
                        //'order_CraetedBy' => $this->data['royalLoginID'],

                        );
                     $order_res=$this->OrderModel->commonInsert('adora_order',$booking);
                     
                     if($order_res==true){
                        $orderid=$this->core_model->getLastInsertId(); 
                         
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
                          'orderID'=>$orderid,
                          'order_Number'=>$this->input->post('order_Number'),
                          'customerID'=>$customerid,
                          'OD_ProductName'=>$product_Name[$x],
                          'OD_ProductID'=>$order_Item[$x],
                          'OD_ProductQty'=>$order_Qty[$x],
                          'OD_ProductRate'=>$order_Unitprice[$x],
                          'OD_ProductAmount'=>$totalamount[$x],
                           'OD_ProductComment' =>trim($OD_ProductComment[$x]),
                           
                          //'created_BY' => $this->data['royalLoginID'],
                          'order_OrderDate'=>date('Y-m-d',strtotime($this->input->post('order_OrderDate'))),'order_DeliveryDate'=>$this->input->post('order_DeliveryDate'),'branch_ID'=>$this->session->userdata('customer_branch') );
                        
                        $orderdetails_res=$this->OrderModel->commonInsert('adora_orderdetails',$order_Details);
                         $orderdetailsID=$this->core_model->getLastInsertId();
                       
                         for($t = 0; $t <$order_Qty[$x]; $t++){
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
                          'task_Priority'=>(!$this->input->post('order_Priority') )?'NO':'YES',
                          'branch_ID'=>$this->session->userdata('customer_branch'));
                         
                          $task=$this->OrderModel->commonInsert('adora_task',$task_Details); 
                        $s++;
                        }
                         

                          }
                         
                          
                       
                           

             }
           }
        //insert
          $data['success'] = true;

          
  }
    echo json_encode($data);
   }
   
}
