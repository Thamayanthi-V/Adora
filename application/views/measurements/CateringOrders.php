<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all common db related functions
 * @author Teamtweaks
 *
 */
class CateringOrders extends My_Model { 

	/**
	 * 
	 * This function connect the database and load the functions from CI_Model
	 */
	public function __construct()  
	{
		parent::__construct();
//		$this->load->database();
	}

  
	public function getall($table){
   	
   	$query = $this->db->query('SELECT *  FROM '.$table.' WHERE customer_type="Catering" and active="A"');
     return $query->result_array();
   }

   public function delete($table,$field,$value){
    
   
    return $this->db->query("delete FROM ".$table." where ".$field."=".$value." ");
   }

   public function getorder($table,$date_field){
   		/*$query = $this->db->query('SELECT *  FROM `'.$table.'` WHERE `sales_Source` LIKE "Order" ORDER BY `id` ASC');
   		
     return $query->result_array();*/
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

  if($this->input->post('customer_Name'))
  {
    
     $this->db->where(''.$table.'.customer_ID',$this->input->post('customer_Name'));
  }
  
  if(!$this->input->post()){
     $this->db->where(''.$table.'.'.$date_field.'', $curr_date);
    // $this->db->where(''.$table.'.sales_Source', 'Order');
   }
  
  $this->db->where(''.$table.'.active', 'A');
    $query = $this->db->get();

    return $query->result_array();
   }

 }

 ?>