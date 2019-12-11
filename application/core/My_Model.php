<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all common db related functions
 * @author Teamtweaks
 *
 */
class My_Model extends CI_Model { 

	/**
	 * 
	 * This function connect the database and load the functions from CI_Model
	 */
	public function __construct()  
	{
		parent::__construct();
//		$this->load->database();

		
	}

	/**
	 * 
	 * This function returns the table contents based on data
	 * @param String $table	->	Table name
	 * @param Array $condition	->	Conditions
	 * @param Array $sortArr	->	Sorting details
	 * 
	 * return Array
	 */
	public function getAllDetails($table='',$condition='',$sortArr=''){
	//print_r($table);die;
		if ($sortArr != '' && is_array($sortArr)){
			
			foreach ($sortArr as $sortRow){
				if (is_array($sortRow)){;
					$this->db->order_by($sortRow['field'],$sortRow['type']);
				}
			}			
		}		
		//echo $this->db->last_query(); 
        $this->db->reconnect();			  
		return $this->db->get_where($table,$condition);
	}

	/* 
	get row count 
	*
	condition as string
	*
	*
	returns numeric value
	*
	 */
	
	public function getCount($table='',$condition=''){
		//$Query = "SELECT * from ".$table." where ".$condition." ";
		$query = $this->db->get_where($table,$condition);
		return $query->num_rows();
	}

	/*
	* details of single row by identity
	*/
	public function getDetailsByRow($table,$condition){
		$query = $this->db->get_where($table,$condition);
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return false;
		}
	}
	/*
	* array of result by identity
	*/
	public function getDetailsByResultArray($table,$condition){
		$query = $this->db->get_where($table,$condition);
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	
	}
	/**
	 * 
	 * Simple function for inserting data into a table
	 * @param String $table
	 * @param Array $data
	 */
	public function simpleInsert($table='',$data=''){
	//echo "<pre>";print_r($data);die;
		$this->db->insert($table,$data);
	}
	/**
	 * 
	 * This function update the table contents based on params
	 * @param String $table		->	Table name
	 * @param Array $data		->	New data
	 * @param Array $condition	->	Conditions
	 */
	public function updateDetails($table='',$data='',$condition='',$in=''){
	
		if(!empty($condition))
		{
		   
			$this->db->where($condition);
			if(!empty($in)){
				$this->db->where_in("id", $in);
			}
			$this->db->reconnect();
			$this->db->update($table,$data);
		}
	}

	/**
	 * 
	 * For getting last insert id
	 */
	public function getLastInsertId(){
		return $this->db->insert_id();
	}
	
	/**
	 * 
	 * This function do the delete operation
	 * @param String $table
	 * @param Array $condition
	 */
	public function commonDelete($table='',$condition=''){
		$this->db->delete($table,$condition);
	}

	/**
	 * 
	 * This function do the custom query execution
	 * @param String $Query
	 */

	public function ExecuteQuery($Query){
		$this->db->reconnect();
		return $this->db->query($Query); 
	}

	/**
	 * 
	 * This function do the select specfic fields operation
	 * @param String $fields -> fields needs to select
	 * @param String $table
	 * @param Array $condition
	 * @param Array $sortArr -> sorting details
	 */

	public function getParticularDetails($fields='',$table='',$condition='',$sortArr=''){
		//$this->db->cache_on();
		
				//echo "<pre>";print_r($condition); 
				$this->db->select($fields); 
			if ($sortArr != '' && is_array($sortArr)){
			foreach ($sortArr as $sortRow){
				if (is_array($sortRow)){
					$this->db->order_by($sortRow['field'],$sortRow['type']);
				}
			}
		}
		return $this->db->get_where($table,$condition);
	}
	
 }