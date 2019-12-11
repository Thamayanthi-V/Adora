<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all common db related functions
 * @author Teamtweaks
 *
 */
class BranchModel extends My_Model { 

	/**
	 * 
	 * This function connect the database and load the functions from CI_Model
	 */
	public function __construct()  
	{
		parent::__construct();		
	}

	function getManager($searchTerm=""){

     // Fetch users
     $this->db->select('*');
    // $this->db->where("customer_Name like '%".$searchTerm."%' ");
     $this->db->where("user_Name like '%".$searchTerm."%'");
     $this->db->where("user_active = 'A'");
     $this->db->where("user_privileges = 'MANAGER'");
     $fetched_records = $this->db->get(TABLE_USER);
     $users = $fetched_records->result_array();

     // Initialize Array with fetched data
     $data = array();
     // $data[] = array("id"=>"0","text"=>"New User");

     foreach($users as $user){
        $data[] = array("id"=>$user['id'], "text"=>$user['user_Name']);
     }

     return $data;
  }


}