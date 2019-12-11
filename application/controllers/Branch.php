<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch extends MY_Controller {

	
	function __construct()
    {
        parent::__construct();
        $this->load->model('BranchModel','userM');

        $this->table = TABLE_BRANCH;

		$this->column_order = array('b.id', 'b.branch_Name','m.user_Name','b.branch_active');

		// Set default order
        $this->order = array('b.id' => 'desc');
        /* check login */
   		$this->checkLogin('U'); 
    }
	public function index()
	{
		$this->load->view('temp-parts/header');

		$this->load->view('branch/branch_list');
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
		   $searchQuery = " and (b.branch_Name like '%".$searchValue."%' )";
		}

		## Total number of records without filtering
		$sel = $this->userM->ExecuteQuery("select count(*) as allcount from ". $this->table." b inner join ".TABLE_USER." m on m.id=b.branch_manager  WHERE b.branch_active!='E'");
		$records = $sel->row();
		$totalRecords = $records->allcount;

		## Total number of record with filtering
		$sel = $this->userM->ExecuteQuery("select count(*) as allcount from ". $this->table." b inner join ".TABLE_USER." m on m.id=b.branch_manager WHERE b.branch_active!='E' ".$searchQuery);
		$records = $sel->row();
		$totalRecordwithFilter = $records->allcount;

		## Fetch records
		$empQuery = "select b.branch_Name,b.id as bid,m.user_Name as manager,b.branch_active from ". $this->table." b inner join ".TABLE_USER." m on m.id=b.branch_manager WHERE b.branch_active!='E' ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
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
			$edit 	= base_url('branch-edit/'.base64_encode($r->bid).'');
           	$delt 	= "confirm_delete('branch-delete/".base64_encode($r->bid)."')";

			$action_data = '<a href="'.$edit.'">
                    <button type="button" class="btn btn-cyan btn-sm">Edit</button></a>';
           
           	if($this->data['LoginPrivilege'] =='ADMIN'){        
            	$action_data .='<button type="button" onclick="'.$delt.'" class="btn btn-danger btn-sm">Delete</button>';
        	}
			
		   	$data[] = array($r->branch_Name,$r->manager,$action_data		      
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
		/* Edit or view mode */
		if($memId!='' && $mode!=''){
			$q = "select b.branch_Name,b.id as bid,b.branch_manager,b.branch_active,m.user_Name as manager from ". $this->table." b inner join ".TABLE_USER." m on m.id=b.branch_manager WHERE  b.id='".base64_decode($memId)."'";
			$data['branchDetails'] = $this->userM->ExecuteQuery($q)->row();
			$data['mode'] = $mode;
		}else{
			$data['branchDetails'] = array();
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
		$this->load->view('branch/branch_form',$data);
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
	                'field' => 'branch_manager',
	                'label' => 'Branch Manager',
	                'rules' => 'required',
	                'errors' => array(
	                        'required' => 'Manager is required...',
	                )
	        )
	    );
		if($bUpdate==0){
			$config[] = array(
	                'field' => 'branch_Name',
	                'label' => 'Branch Name',
	                'rules' => 'required|callback_branch_exists_in_database',
	                 'errors' => array('required' => 'Branch Name is required...',
	                )                
	         );
		}else{
			$config[] = array(
	                'field' => 'branch_Name',
	                'label' => 'Branch Name',
	                'rules' => 'required|callback_branch_exists_in_database_ById',
	                 'errors' => array('required' => 'Branch Name is required...',
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
					'branch_Name'		=>$this->security->xss_clean($this->input->post('branch_Name')),
					'branch_created_by' => $this->data['LoginID'],
					
				);

				$err_msg 	= "Faill to insert record";
	        	$succ_msg 	= "Record inserted successfully";

	        	$this->userM->simpleInsert($this->table,$fieldAr);
	           	if($this->db->affected_rows()>0){		
	        		$data['success'] =  true;
	        		$branch_ID = $this->db->insert_id();
	        		$userAr = array(
						'user_Name'			=> $this->security->xss_clean($this->input->post('branch_manager')),
						'user_created_by' 	=> $this->data['LoginID'],
						'branch_ID'			=> $branch_ID,
						'user_manager'    	=> 0,
						'user_privileges'   => 'BRANCH MANAGER'
						
					);
	        		$this->userM->simpleInsert(TABLE_USER,$userAr);
	        		if($this->db->affected_rows()>0){
	        			$branch_manager = $this->db->insert_id();
	        			$this->userM->updateDetails($this->table,array('branch_manager' => $branch_manager),array('id'=>$branch_ID));

	        			

	        		}
				}

			}else
			{
				$err_msg 	= "Faill to update record";
	        	$succ_msg 	= "Record updated successfully";
				/* update */
				$fieldAr = array(
					'branch_Name'		=>$this->security->xss_clean($this->input->post('branch_Name')),
					'branch_updated_by' => $this->data['LoginID'],
					'branch_updated_at' => date('Y-m-d H:i:s')					
				);

				$this->userM->updateDetails($this->table,$fieldAr,array('id'=>$this->input->post('bId')));
	      		if($this->db->affected_rows()>0){		
					$data['success'] = true;
					$userAr = array(
						'user_Name'			=> $this->security->xss_clean($this->input->post('branch_manager')),					
					);
					$this->userM->updateDetails(TABLE_USER,$userAr,array('id'=>$this->input->post('userId')));

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

	/* check existence start */
	public function branch_exists_in_database()
    {
    	$value = $this->input->post('branch_Name');
        $query = $this->db->get_where($this->table, array('branch_Name'=> $value,'branch_active !='=>'E' )); 

            if ($query->num_rows() > 0 )
            {
                    $this->form_validation->set_message('branch_exists_in_database', 'Branch Already Exist....');
                    return FALSE;
            }
            else
            {
                    return TRUE;
            }


    }
    public function branch_exists_in_database_ById()
    {
    	$value = $this->input->post('branch_Name');
    	$bId = $this->input->post('bId');
        $query = $this->db->get_where($this->table, array( 'id !=' => $bId,'branch_Name'=> $value,'branch_active !='=>'E' )); 

            if ($query->num_rows() > 0 )
            {
                    $this->form_validation->set_message('branch_exists_in_database_ById', 'Branch Already Exist....');
                    return FALSE;
            }
            else
            {
                    return TRUE;
            }


    }

	/* check existence end */


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

	/* load manager start */
	// Get users
   	public function getManager(){

      // Search term
      $searchTerm = $this->input->post('searchTerm');

      // Get users
      $response = $this->userM->getManager($searchTerm);

      echo json_encode($response);
   }
	/* load manager ends */

}