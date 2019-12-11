<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Measurements extends MY_Controller {

	
	function __construct()
    {
        parent::__construct();
        $this->load->model('My_Model','userM');

        $this->table = TABLE_MEASUREMENT;

		$this->column_order = array('id', 'measurement_category', 'measurement_title');

		// Set default order
        $this->order = array('id' => 'desc');
        /* check login */
   		$this->checkLogin('U'); 
    }
	public function index()
	{
		$this->load->view('temp-parts/header');

		$this->load->view('measurements/measurement_list');
		$this->load->view('temp-parts/footer');
	}

	/* 
	* Add new measurements 
	*/
	public function add($mode='',$memId='')
	{
		$data = $this->data;
		/* Edit or view mode */
		if($memId!='' && $mode!='') {
			$q = "select id as mid, measurement_category, measurement_title from ". $this->table." WHERE  id='".base64_decode($memId)."'";
			$data['mesurementDetails'] = $this->userM->ExecuteQuery($q)->row();
			$data['mode'] = $mode;
		} else {
			$data['mesurementDetails'] = array();
			$data['mode'] = 'Add';
		}
		
		$this->load->view('temp-parts/header');
		$this->load->view('customer/customer_form',$data);
		$this->load->view('temp-parts/footer');	
	}
	/* 
	* Add new measurements - End 
	*/

	/* 
	* Save measurement - Start 
	*/
	public function save()
	{ 
		$data = $this->data;
		$data = array('success' => false, 'messages' =>array());
		$bUpdate = $this->input->post('bUpdate');
		$config = array(
			array(
	                'field' => 'measurement_category',
	                'label' => 'Category Name',
	                'rules' => 'required'
	        ),

	      	array(
	                'field' => 'measurement_title',
	                'label' => 'Measurement Title',
	                'rules' => 'required',
	                
	          ),
        
    	);

		$this->form_validation->set_rules($config);
	    $this->form_validation->set_error_delimiters('<p class="text-danger" style="color:white;">', '</p>');


	    if ($this->form_validation->run() == FALSE)
		{
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = form_error($key);
			}
		}
		else
		{ 
			if($bUpdate==0)
			{
				/* insert */
				$fieldAr = array(
					'measurement_category'	=>$this->security->xss_clean($this->input->post('measurement_category')),
					'measurement_title'		=>$this->security->xss_clean($this->input->post('customer_title')),
					
				);

				$err_msg 	= "Faill to insert record";
	        	$succ_msg 	= "Record inserted successfully";

	        	$this->userM->simpleInsert($this->table,$fieldAr);
	           	if($this->db->affected_rows()>0){		
	        		$data['success'] =  true;
	        		
				}

			}else
			{
				$err_msg 	= "Faill to update record";
	        	$succ_msg 	= "Record updated successfully";
				/* 
				* Update 
				*/
				$fieldAr = array('measurement_category'=>$this->security->xss_clean($this->input->post('measurement_category')));
				$this->userM->updateDetails($this->table,$fieldAr,array('id'=>$this->input->post('id')));

	      		if($this->db->affected_rows()>0) {
					$data['success'] = true;			
	      		}		
			}

			if($data['success'] == true) {
	            $this->setErrorMessage('success',$succ_msg);
	        } else {
	            $this->setErrorMessage('error_msg', $err_msg);
        	}
		}
		echo json_encode($data);
	}

	/* 
	* Delete measurement - Starts 
	*/
	public function deleteMeasurement($Id)
	{
		$data = $this->data;
		$err_msg 	= "Faill to delete record";
    	$succ_msg 	= "Record deleted successfully";
    	
    	$bID = base64_decode($Id);
  		$this->userM->updateDetails($this->table,array('measurement_active'=>'E'),array('id'=>$bID)); 
    	if($this->db->affected_rows()>0) {		
			echo $data['success'] =  true;
		} 
    
	    if($data['success']==true) {
	        $this->setErrorMessage('success',$succ_msg);
	    } else {
	        $this->setErrorMessage('error_msg', $err_msg);
		}

		redirect(base_url('measurement-master'));

	}
	
	/* 
	* Delete customer - Ends 
	*/

}	