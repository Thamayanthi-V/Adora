<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MY_Controller {

	
	function __construct()
    {
        parent::__construct();
        $this->load->model('My_Model','userM');

        $this->table = TABLE_CUSTOMER;

		$this->column_order = array('d.id', 'd.customer_Name');

		// Set default order
        $this->order = array('d.id' => 'desc');
        /* check login */
   		$this->checkLogin('U'); 
    }
	public function index()
	{
		$this->load->view('temp-parts/header');

		$this->load->view('customer/customer_list');
		$this->load->view('temp-parts/footer');
	}


	/* ajax datatable load starts */
	public function pageLoad()
	{
		$draw 	= $_POST['draw'];
		$row 	= $i = $_POST['start'];
		$rowperpage 	= $_POST['length']; // Rows display per page
		$columnIndex 	= $_POST['order'][0]['column']; // Column index
		/*$columnName = $this->column_order[$_POST['order']['0']['column']]; // Column name
		$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc*/
		$searchValue 	= $_POST['search']['value']; // Search value
		$searchName 	= $_POST['name_search']; // Search value
		$searchMobile 	= $_POST['mob_search']; // Search value
		

		if(isset($_POST['order'])){
           $columnName = $this->column_order[$_POST['order']['0']['column']];
           $columnSortOrder = $_POST['order']['0']['dir'];
        }else if(isset($this->order)){
            $columnName = 'd.id';
            $columnSortOrder = 'desc';
        }
       
       // echo $columnName ;exit();
		## Search 
		$searchQuery = " ";
		if($searchValue != ''){
		   $searchQuery = " and (d.customer_Name like '%".$searchValue."%' or (d.customer_Mobile like '%".$searchValue."%' ) )";
		}if($searchName != ''){
		   $searchQuery .= " and (d.customer_Name like '%".$searchName."%' )";
		}if($searchMobile != ''){
		   $searchQuery .= " and (d.customer_Mobile like '%".$searchMobile."%' )";
		}

		## Total number of records without filtering
		$sel = $this->userM->ExecuteQuery("select count(*) as allcount from ". $this->table." d   WHERE d.customer_active!='E'");
		$records = $sel->row();
		$totalRecords = $records->allcount;

		## Total number of record with filtering
		$sel = $this->userM->ExecuteQuery("select count(*) as allcount from ". $this->table." d WHERE d.customer_active!='E' ".$searchQuery);
		$records = $sel->row();
		$totalRecordwithFilter = $records->allcount;

		## Fetch records
		$empQuery = "select d.customer_Name,d.customer_Mobile,d.id as bid,d.customer_active from ". $this->table." d WHERE d.customer_active!='E' ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
		$empRecords = $this->userM->ExecuteQuery($empQuery);
		$data = array();

		$row = $empRecords->result();


		foreach ($row as $r) {
			$i++;

			
			$edit 	= base_url('customer-edit/'.base64_encode($r->bid).'');
           	$delt 	= "confirm_delete('customer-delete/".base64_encode($r->bid)."')";

			$action_data = '<a href="'.$edit.'">
                    <button type="button" class="btn btn-cyan btn-sm">Edit</button></a>';
           /*
           	if($this->data['LoginPrivilege'] =='ADMIN'){        
            	$action_data .='<button type="button" onclick="'.$delt.'" class="btn btn-danger btn-sm">Delete</button>';
        	}*/
			
		   	$data[] = array($r->customer_Name,$r->customer_Mobile,$action_data);
		   
		}



		## Response
		$response = array(
		  "draw" => intval($draw),
		  "iTotalRecords" => $totalRecordwithFilter,
		  "iTotalDisplayRecords" => $totalRecords,
		  "data" => $data
		);

		echo json_encode($response);
	}
	/* ajax datatable load ends */
	/* new department add form starts */
	public function add($mode='',$memId='')
	{
		$data = $this->data;
		/* Edit or view mode */
		if($memId!='' && $mode!=''){
			$q = "select d.id as bid,d.customer_Name,d.customer_Mobile,d.customer_Area,d.customer_City,d.customer_Phone,d.customer_Email,d.customer_active from ". $this->table." d WHERE  d.id='".base64_decode($memId)."'";
			$data['customDetails'] = $this->userM->ExecuteQuery($q)->row();
			$data['mode'] = $mode;
		}else{
			$data['customDetails'] = array();
			$data['mode'] = 'Add';
		}
		/*$m = $this->userM->ExecuteQuery('select max(id) as maxID from '.$this->table.'')->row();
		//print_r($m);
		if(!empty($m))
		{
			$data['mId'] = $m->maxID + 1;
		}else
			$data['mId'] = '1';*/
		$this->load->view('temp-parts/header');
		$this->load->view('customer/customer_form',$data);
		$this->load->view('temp-parts/footer');	
	}
	/* new department add form ends */

	/* save department start */
	public function save()
	{ //print_r($_FILES);
		$data = $this->data;
		$data = array('success' => false, 'messages' =>array());
		$bUpdate = $this->input->post('bUpdate');
		
		$config = array(
				        array(
				                'field' => 'customer_Name',
				                'label' => 'Customer Name',
				                'rules' => 'required',
				                 'errors' => array('required' => 'Customer Name is required...',
				                )                
				         )
				    );

		if($bUpdate==0){
			
			 $config[] = array(
                'field' => 'customer_Mobile',
                'label' => 'Customer Mobile',
                'rules' => 'required|regex_match[/^[0-9]{10}$/]|callback_mobile_exists_in_database',
                 'errors' => array('required' => 'Customer Mobile is required...','regex_match' => 'Mobile Not in correct format...',
                )                
	         );
			
		}else{
			 $config[] = array(
	                'field' => 'customer_Mobile',
	                'label' => 'Customer Mobile',
	                'rules' => 'required|regex_match[/^[0-9]{10}$/]|callback_mobile_exists_in_database_ById',
	                 'errors' => array('required' => 'Customer Mobile is required...','regex_match' => 'Mobile Not in correct format...',
	                )                
	         );

			
		}

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
					'customer_Name'		=>$this->security->xss_clean($this->input->post('customer_Name')),
					'customer_Area'		=>$this->security->xss_clean($this->input->post('customer_Area')),
					'customer_City'		=>$this->security->xss_clean($this->input->post('customer_City')),
					'customer_Mobile'		=>$this->security->xss_clean($this->input->post('customer_Mobile')),'
					customer_Phone'		=>$this->security->xss_clean($this->input->post('customer_Phone')),
					'customer_Email'		=>$this->security->xss_clean($this->input->post('customer_Email')),
					'customer_created_by' => $this->data['LoginID'],
					
					'branch_ID' 			=> $this->data['Login_branchID'],
					
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
				/* update */
				$fieldAr = array(
					'customer_Name'		=>$this->security->xss_clean($this->input->post('customer_Name')),
					'customer_updated_by' => $this->data['LoginID'],
					'customer_updated_at' => date('Y-m-d H:i:s')					
				);

				$this->userM->updateDetails($this->table,$fieldAr,array('id'=>$this->input->post('bId')));
	      		if($this->db->affected_rows()>0)		
					$data['success'] = true;			
			}

			if($data['success'] == true){
        		
	            $this->setErrorMessage('success',$succ_msg);
	           
	        }else{
	        	
	            $this->setErrorMessage('error_msg', $err_msg);
	            
        	}
		}
		echo json_encode($data);
	}


	/* check existence start */
	public function mobile_exists_in_database()
    {
    	$value = $this->input->post('customer_Mobile');
        $query = $this->db->get_where($this->table, array('customer_Mobile'=> $value,'customer_active !='=>'E' )); 

            if ($query->num_rows() > 0 )
            {
                    $this->form_validation->set_message('mobile_exists_in_database', 'Department Already Exist....');
                    return FALSE;
            }
            else
            {
                    return TRUE;
            }


    }
    public function mobile_exists_in_database_ById()
    {
    	$value = $this->input->post('customer_Mobile');
    	$bId = $this->input->post('bId');
        $query = $this->db->get_where($this->table, array( 'id !=' => $bId,'customer_Mobile'=> $value,'customer_active !='=>'E' )); 

            if ($query->num_rows() > 0 )
            {
                    $this->form_validation->set_message('mobile_exists_in_database_ById', 'Department Already Exist....');
                    return FALSE;
            }
            else
            {
                    return TRUE;
            }


    }

	/* check existence end */


	/* Delete customer starts */
	public function deleteCustomer($Id)
	{
		$data = $this->data;
		$err_msg 	= "Faill to delete record";
    	$succ_msg 	= "Record deleted successfully";
    	
    	$bID = base64_decode($Id);//exit();
  		$this->userM->updateDetails($this->table,array('customer_active'=>'E'),array('id'=>$bID)); 
    	if($this->db->affected_rows()>0){		
			echo $data['success'] =  true;
		} 
    
	    if($data['success']==true){
	        $this->setErrorMessage('success',$succ_msg);
	        
	    }else{
	        $this->setErrorMessage('error_msg', $err_msg);
	        
		}
		redirect(base_url('customer-master'));

	}
	
	/* Delete customer ends */

}	