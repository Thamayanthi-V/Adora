<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all common db related functions
 * @author Teamtweaks
 *
 */
class TaskModel extends My_Model { 

	/**
	 * 
	 * This function connect the database and load the functions from CI_Model
	 */
	public function __construct()  {
		parent::__construct();
  }
	
  
  public function getTaskDetails($taskid){
    if($taskid!=''){
    $sql=$this->db->select('t1.id, t1.orderID,t1.order_Number,t1.customerID, t1.task_ItemCode, t1.task_DeliveryDate, t1.task_ProductComment,t1.task_ProductId,t1.task_Priority, t2.customer_Name, t3.product_Name, t3.product_departmentDetails, t4.order_MeasurmentTop, t4.order_MeasurmentBottom')
      ->from('adora_task as t1')
      ->where('t1.id', $taskid)
      ->join('adora_customer as t2', 't1.customerId = t2.id', 'LEFT')
      ->join('adora_product as t3', 't1.task_ProductId = t3.id', 'LEFT')
      ->join('adora_order as t4', 't1.orderID = t4.id', 'LEFT')
      ->get();
    return $sql->row();
    }

    else{
    $sql=$this->db->select('t1.id, t1.orderID,t1.order_Number, t1.customerID, t1.task_ItemCode, t1.task_DeliveryDate,t1.task_Status,t1.task_Priority, t2.customer_Name, t3.product_Name')
      ->from('adora_task as t1')
      ->where('t1.task_type', 'SERVICE')
      ->where('t1.Active', 'A')
      ->join('adora_customer as t2', 't1.customerId = t2.id', 'LEFT')
      ->join('adora_product as t3', 't1.task_ProductId = t3.id', 'LEFT')
      ->get();
    return $sql->result_array();
    }
  }


  public function getProductionList(){
    $sql=$this->db->select('t1.id, t1.order_Number, t1.task_ItemCode, t1.task_DeliveryDate,t1.task_Status,t1.task_Priority, t2.customer_Name, t3.product_Name')
      ->from('adora_task as t1')
      ->where('t1.task_Status', 'ASSIGN')
      ->where('t1.task_type', 'SERVICE')
      ->where('t1.Active', 'A') 
      ->join('adora_customer as t2', 't1.customerId = t2.id', 'LEFT')
      ->join('adora_product as t3', 't1.task_ProductId = t3.id', 'LEFT')
      ->get();
    return $sql->result_array();
  }

  public function StatusUpdate($table,$field,$id){
    $this->db->where('id',$id);
    return $this->db->update($table,$field);
  }

  public function commonInsert($table,$field){
    $this->db->insert($table,$field);
    return true;
  }

  public function delete($table,$field,$value){
    return $this->db->query("delete FROM ".$table." where ".$field."=".$value." ");
  }

  public function CommonUpdate($table,$update,$id,$field){
    $this->db->where($field, $id);
    return $this->db->update($table,$update);
   }


  

 
 }