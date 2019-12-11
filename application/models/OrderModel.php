<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all common db related functions
 * @author Teamtweaks
 *
 */
class  OrderModel extends My_Model { 

	/**
	 * 
	 * This function connect the database and load the functions from CI_Model
	 */
	public function __construct()  
	{
		parent::__construct();
//		$this->load->database();

		
	}
	function getUsers($searchTerm=""){

     // Fetch users
     $this->db->select('*');
    // $this->db->where("customer_Name like '%".$searchTerm."%' ");
     $this->db->where("customer_Mobile like '%".$searchTerm."%' OR customer_Name like '%".$searchTerm."%'");
     $fetched_records = $this->db->get('adora_customer');
     $users = $fetched_records->result_array();

     // Initialize Array with fetched data
     //$data = array();
      $data[] = array("id"=>"0","text"=>"New User");

     foreach($users as $user){
        $data[] = array("id"=>$user['id'], "text"=>$user['customer_Name']."~".$user['customer_Mobile']);
     }

     return $data;
  }
  function getInvalues($table,$values){
   
    $sql=$this->db->query("SELECT *  FROM ".$table." WHERE `calender_Date` IN ('".$values."')");
    return $sql->result();
  }
  function getNotInvalues($table,$field,$itemAr){
   

    $this->db->select("*");
    $this->db->from($table);
    
    $this->db->where(array($field=>'A'));
    if(!empty($itemAr)){
        $this->db->where_not_in("id ", $itemAr);
      }
    $q = $this->db->get();
    return $q->result_array();
  }
  function salegetNotInvalues($table,$field,$itemAr){
   

    $this->db->select("*");
    $this->db->from($table);
    
    $this->db->where(array($field=>'A','product_type'=>'SALE'));
    if(!empty($itemAr)){
        $this->db->where_not_in("id ", $itemAr);
      }
    $q = $this->db->get();
    return $q->result_array();
  }
  function getTable($table){
     $sql=$this->db->query("SELECT *  FROM ".$table." ");
    return $sql->result_array();
  }
	public function getMenuPrice($menuId){
    
    $sql = $this->db->query("SELECT * FROM `adora_product` WHERE `id`='$menuId'");
    return $sql->row();
      
  }
  
  public function getinproduct($product){
      $query = $this->db->query('SELECT *  FROM `adora_product` WHERE  product_active="A" AND  `id` IN ('.$product.')');
    return $query->result_array();
   }
   public function commonInsert($table,$data) { 
    if($this->db->insert($table,$data))
      {
    // Code here after successful insert
    return true;   // to the controller
    }
    }
     public function getorder($table,$date_field,$customer,$listdate){
      
     $this->db->select(''.$table.'.*');
     $this->db->from(''.$table.''); 
     $date = new DateTime("now");
     $curr_date = $date->format('Y-m-d');
   
      if($this->input->post('from'))
       {
       $this->db->where(''.$table.'.'.$date_field.' >=',date('Y-m-d',strtotime($this->input->post('from'))));
       }
      if($this->input->post('to'))
        {
      $this->db->where(''.$table.'.'.$date_field.' <=',date('Y-m-d',strtotime($this->input->post('to'))));
        }
      if($this->input->post('order_Number'))
        {
      $this->db->like(''.$table.'.order_Number', $this->input->post('order_Number'));
        }
        if($this->input->post('sales_Number'))
        {
      $this->db->like(''.$table.'.sales_Number', $this->input->post('sales_Number'));
        }

        if($this->input->post('customer'))
        {
      $this->db->like(''.$table.'.'.$customer, $this->input->post('customer'));
        }
       if(!$this->input->post()){
       //$this->db->where(''.$table.'.'.$date_field.'', $curr_date);
        if($listdate=="order_DeliveryDate"){
         $this->db->not_like(''.$table.'.order_Status',"Complete");
        }
        
        $this->db->where('MONTH('.$listdate.')', date('m'));
    // $this->db->where(''.$table.'.sales_Source', 'Order');
        }
  
  $this->db->where(''.$table.'.Active', 'A');
  //$this->db->where(''.$table.'.sales_Source', $type);
    $query = $this->db->get();

    return $query->result();
   }
 public function update($table,$update,$id,$field){
    $this->db->where($field, $id);
    return $this->db->update($table,$update);

   }
   public function delete($table,$field,$value){
    
   
    return $this->db->query("delete FROM ".$table." where ".$field."=".$value." ");
   }
 }