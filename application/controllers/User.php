<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	
	function __construct()
    {
        parent::__construct();
        $this->load->model('My_Model','userM');

        $this->table = TABLE_USER;

		$this->column_order = array('u.user_Name','u.user_privileges','m.user_Name','u.user_active');

		// Set default order
        $this->order = array('u.id' => 'desc');
        /* check login */
   		$this->checkLogin('U');  
    }
	public function index()
	{
		$this->load->view('temp-parts/header');
		//echo $this->data['LoginPrivilege'];
		if(($this->data['LoginPrivilege']=='ADMIN') || ($this->data['LoginPrivilege']=='MANAGER') ){
			$condition = array('branch_active !='=>'E');
		}else{
			$condition = array('branch_active !='=>'E','id'=> $this->data['Login_branchID']);
		}

		$data['Branch']  = $this->userM->getParticularDetails('id,branch_Name',TABLE_BRANCH,$condition)->result();

		$this->load->view('user/user-list',$data);
		$this->load->view('temp-parts/footer');
	}


	/* ajax datatable load starts */
	public function pageLoad()
	{
		$draw = $_POST['draw'];
		$row 	= $i = $_POST['start'];
		$rowperpage = $_POST['length']; // Rows display per page
		$columnIndex = $_POST['order'][0]['column']; // Column index
		/*$columnName = $this->column_order[$_POST['order']['0']['column']]; // Column name
		$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc*/
		$searchValue = $_POST['search']['value']; // Search value
		$searchName 	= $_POST['name_search']; // Search value
		$searchBranch 	= $_POST['branch_search']; // Search value
		$searchManager 	= $_POST['manager_search']; // Search value


		if(isset($_POST['order'])){
           $columnName = $this->column_order[$_POST['order']['0']['column']];
           $columnSortOrder = $_POST['order']['0']['dir'];
        }else if(isset($this->order)){
            $columnName = 'b.id';
            $columnSortOrder = 'desc';
        }
       
       // echo $columnName ;exit();
		## Search 
		$searchQuery = " ";
		if($searchValue != ''){
		   $searchQuery = " and (u.user_Name like '%".$searchValue."%' )";
		}
		if($searchName != ''){
		   $searchQuery .= " and (u.user_Name like '%".$searchName."%' )";
		}if($searchManager != ''){
		   $searchQuery .= " and (m.user_Name like '%".$searchManager."%' )";
		}if($searchBranch != ''){
		   $searchQuery .= " and (u.branch_ID ='".$searchBranch."' )";
		}

		## Total number of records without filtering
		$sel = $this->userM->ExecuteQuery("select count(*) as allcount from ". $this->table." u inner join ".TABLE_USER." m on m.id=u.user_Manager  WHERE u.user_active!='E'");
		$records = $sel->row();
		$totalRecords = $records->allcount;

		## Total number of record with filtering
		$sel = $this->userM->ExecuteQuery("select count(*) as allcount from ". $this->table." u inner join ".TABLE_USER." m on m.id=u.user_Manager WHERE u.user_active!='E' ".$searchQuery);
		$records = $sel->row();
		$totalRecordwithFilter = $records->allcount;

		## Fetch records
		$empQuery = "select u.id as bid,u.user_privileges,u.user_Name,m.user_Name as manager,u.user_active from ". $this->table." u inner join ".TABLE_USER." m on m.id=u.user_Manager WHERE u.user_active!='E' ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
		$empRecords = $this->userM->ExecuteQuery($empQuery);
		$data = array();

		$row = $empRecords->result();


		foreach ($row as $r) {
			$i++;

			if($r->branch_active =='A'){
                $Status = 'Active';
                $btnStatus = 'btn-success';
            }
            else{
                $Status = 'Inactive';
                $btnStatus = 'btn-danger';
            }
            $status = '<span class="btn  '. $btnStatus.' " style= "border-radius: 30px" >'.$Status.'</span>';
			$edit 	= base_url('user-edit/'.base64_encode($r->bid).'');
           	$delt 	= "confirm_delete('user-delete/".base64_encode($r->bid)."')";

			$action_data = '<a href="'.$edit.'">
                    <button type="button" class="btn btn-cyan btn-sm">Edit</button></a>';
           
           
			
		   	$data[] = array($r->user_Name,ucwords(strtolower($r->user_privileges)),$r->manager,$action_data		      
		   );
		   
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

	/* new branch add form starts */
	public function add($mode='',$memId='')
	{
		$data = $this->data;

		if(($this->data['LoginPrivilege']=='ADMIN') || ($this->data['LoginPrivilege']=='MANAGER') ){
			$condition = array('branch_active !='=>'E');
		}else{
			$condition = array('branch_active !='=>'E','id'=> $this->data['Login_branchID']);
		}

		$data['Branch']  = $this->userM->getParticularDetails('id,branch_Name',TABLE_BRANCH,$condition)->result();
		/*$data['Managers']  = $this->userM->getParticularDetails('id,user_Name',TABLE_USER,array('user_active !='=>'E','user_privileges '=>'MANAGER'))->result();*/
		$data['departs']  = $this->userM->getParticularDetails('id,department_Name,department_Icon',TABLE_DEPARTMENT,array('department_active !='=>'E'))->result();

		/* Edit or view mode */
		if($memId!='' && $mode!=''){
			$q = "select u.user_Name,u.id as bid,u.user_Manager,u.user_active,u.user_loginpwd,u.user_loginkey,m.user_Name as manager,u.user_privileges,u.branch_ID,u.user_departments from ". $this->table." u inner join ".TABLE_USER." m on m.id=u.user_Manager WHERE  u.id='".base64_decode($memId)."'";
			$data['userDetails'] = $this->userM->ExecuteQuery($q)->row();
			$data['mode'] = $mode;
		}else{
			$data['userDetails'] = array();
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
		$this->load->view('user/user',$data);
		$this->load->view('temp-parts/footer');	
	}
	/* new branch add form ends */

	/* save branch start */
	public function save()
	{
		$data = $this->data;
		$data = array('success' => false, 'messages' =>array());
		$bUpdate = $this->input->post('bUpdate');
		$config = array(
	        array(
	                'field' => 'user_Name',
	                'label' => 'user Name',
	                'rules' => 'required',
	                'errors' => array(
	                        'required' => 'Name is required...',
	                )
	        ),array(
	                'field' => 'user_loginpwd',
	                'label' => 'Password',
	                'rules' => 'required',
	                 'errors' => array('required' => 'Password is required...',
	                )                
	         )
	    );

	    if($memUpdate=='0'){
			$config[] = array(
	                'field' => 'user_loginkey',
	                'label' => 'username',
	                'rules' => 'required|callback_exists_in_database',
	                 'errors' => array('required' => 'Login username is required...',
	                )                
	         );
		}else{
			$config[] = array(
	                'field' => 'user_loginkey',
	                'label' => 'username',
	                'rules' => 'required|callback_exists_in_database_byID',
	                 'errors' => array('required' => 'Login username is required...',
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
				$dept = implode(',', $this->input->post('department'));
				/* insert */
				$fieldAr = array(
					'user_Name'		=>$this->security->xss_clean($this->input->post('user_Name')),
					'user_Manager'		=>$this->security->xss_clean($this->input->post('user_Manager')),
					'user_privileges'		=>$this->security->xss_clean($this->input->post('user_privileges')),
					'user_loginkey'		=>$this->security->xss_clean($this->input->post('user_loginkey')),
					'user_loginpwd'		=> base64_encode($this->security->xss_clean($this->input->post('user_loginpwd'))),
					'branch_ID'		=>$this->security->xss_clean($this->input->post('branch_ID')),
					'user_departments' => $dept,
					'user_created_by' => $this->data['LoginID'],
					
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
	        	$dept = implode(',', $this->input->post('department'));
				/* update */
				$fieldAr = array(
					'user_Name'		=>$this->security->xss_clean($this->input->post('user_Name')),
					'user_Manager'		=>$this->security->xss_clean($this->input->post('user_Manager')),
					'user_privileges'		=>$this->security->xss_clean($this->input->post('user_privileges')),
					'user_loginkey'		=>$this->security->xss_clean($this->input->post('user_loginkey')),
					'user_loginpwd'		=> base64_encode($this->security->xss_clean($this->input->post('user_loginpwd'))),
					'branch_ID'		=>$this->security->xss_clean($this->input->post('branch_ID')),
					'user_departments' => $dept,
					'user_updated_by' => $this->data['LoginID'],
					'user_updated_at' => date('Y-m-d H:i:s')					
				);

				$this->userM->updateDetails($this->table,$fieldAr,array('id'=>$this->input->post('bId')));
	      		if($this->db->affected_rows()>0){		
					$data['success'] = true;
					

				}
			}

			if($data['success'] == true){
        		
	            $this->setErrorMessage('success',$succ_msg);
	           
	        }else{
	        	
	            $this->setErrorMessage('error_msg', $err_msg);
	            
        	}
		}
		echo json_encode($data);

	}
	/* save branch ends */

	


	/* Delete Branch starts */
	public function deleteBranch($Id)
	{
		$data = $this->data;
		$err_msg 	= "Faill to delete record";
    	$succ_msg 	= "Record deleted successfully";
    	
    	$bID = base64_decode($Id);//exit();
  		$this->userM->updateDetails($this->table,array('branch_active'=>'E'),array('id'=>$bID)); 
    	if($this->db->affected_rows()>0){		
			echo $data['success'] =  true;
		} 
    
	    if($data['success']==true){
	        $this->setErrorMessage('success',$succ_msg);
	        
	    }else{
	        $this->setErrorMessage('error_msg', $err_msg);
	        
		}
		redirect(base_url('branch-master'));

	}
	
	/* Delete branch ends */

	/* check existence start */
	public function exists_in_database()
    {
    	$value = $this->input->post('user_loginkey');
        $query = $this->db->get_where($this->table, array('user_loginkey'=> $value,'user_active !='=>'E' )); 

            if ($query->num_rows() > 0 )
            {
                    $this->form_validation->set_message('exists_in_database', 'Username Already Exist....');
                    return FALSE;
            }
            else
            {
                    return TRUE;
            }


    }
    public function exists_in_database_ByID()
    {
    	$value = $this->input->post('user_loginkey');
    	$bId = $this->input->post('bId');
        $query = $this->db->get_where($this->table, array( 'id !=' => $bId,'user_loginkey'=> $value,'user_active !='=>'E' )); 

            if ($query->num_rows() > 0 )
            {
                    $this->form_validation->set_message('exists_in_database_ByID', 'Username Already Exist....');
                    return FALSE;
            }
            else
            {
                    return TRUE;
            }


    }

	/* check existence end */

	/* Check Admin password to delete particular user */
	public function checkAdminPassword() 
	{
		$passwd = $this->input->post('pswd');
		$userId = $this->input->post('uid');
		
		$data = $this->data;
		$err_msg 	= "Faill to delete user";
    	$succ_msg 	= "User deleted successfully";

		$adminId = $this->session->userdata('customer_id');
        $adminData=$this->core_model->getDetailsByRow($this->table,array('user_active'=>'A','id'=>$adminId));

        if($passwd == $adminData->user_loginpwd || md5($passwd) == $adminData->user_loginpwd) {
        	echo $data['result'] = true;
        	$this->deleteUser($userId);
        } else {
        	$this->setErrorMessage('error_msg', $err_msg);
        } 
	}
		
	/* Delete user starts */
	public function deleteUser($Id)
	{
		$err_msg 	= "Fail to delete user";
    	$succ_msg 	= "User deleted successfully";
    	
    	$UserId = base64_decode($Id);
  		$this->userM->updateDetails($this->table,array('user_active'=>'E'),array('id'=>$Id));

    	if($this->db->affected_rows()>0){		
			echo $data['result'] =  true;
		} 
    
	    if($data['result']==true) {
	        $this->setErrorMessage('success',$succ_msg);
	        
	    } else {
	        $this->setErrorMessage('error_msg', $err_msg);
		}
		redirect(base_url('user-master'));
	}
	/* Delete user ends */
}