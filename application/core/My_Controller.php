<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
error_reporting(-1);
/**
 * 
 * This controller contains the common functions
 * @author Teamtweaks 
 *
 */ 
date_default_timezone_set('Asia/Kolkata'); 
class MY_Controller extends CI_Controller {  
	public $data = array();
	function __construct()
    {
        parent::__construct();
		ob_start();
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->load->helper('url');
        $this->load->helper('text');
       	$this->load->helper(array('form', 'url', 'html','date'));
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->load->library(array('session', 'form_validation'));
		$this->load->database();

		$this->load->model('My_model', 'core_model');

		/* Error message display */
		$this->data['flash_data'] = $this->session->flashdata('sErrMSG');
		//$this->data['flash_data'] 		= "test";
		$this->data['flash_data_type'] = $this->session->flashdata('sErrMSGType');
		
        $this->data['LoginID'] = $this->session->userdata('customer_id');
        $this->data['LoginName'] = $this->session->userdata('customer_name');
        $this->data['Login_branchID'] = $this->session->userdata('customer_branch');
        $this->data['LoginPrivilege'] = $this->session->userdata('customer_privilege');
	}


    /**
     * 
     * This function set the error message and type in session
     * @param string $type
     * @param string $msg
     */
    public function setErrorMessage($type='',$msg=''){
    	($type == 'success') ? $msgVal = 'alert-success' : $msgVal = 'alert-danger';
		$this->session->set_flashdata('sErrMSGType', $msgVal);
		$this->session->set_flashdata('sErrMSG', $msg);
	
    }


    public function checkLogin($userType='')
    {
    	if($userType=='U'){
	   		if($this->session->userdata('customer_id') == ""){
        		redirect(base_url('login'));
        	}
        }
    }

    public function deleteAllDBCache()
    {
    	$this->db->cache_delete_all();
    }

    
}