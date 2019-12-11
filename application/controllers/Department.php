<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends MY_Controller {

	
	function __construct()
    {
        parent::__construct();
        $this->load->model('My_Model','userM');

        $this->table = TABLE_DEPARTMENT;

		$this->column_order = array('d.id', 'd.department_Name','b.branch_Name');

		// Set default order
        $this->order = array('d.id' => 'desc');
        /* check login */
   		$this->checkLogin('U'); 
    }
	public function index()
	{
		$this->load->view('temp-parts/header');
		if(($this->data['LoginPrivilege']=='ADMIN') || ($this->data['LoginPrivilege']=='MANAGER') ){
			$condition = array('branch_active !='=>'E');
		}else{
			$condition = array('branch_active !='=>'E','id'=> $this->data['Login_branchID']);
		}

		$data['Branch']  = $this->userM->getParticularDetails('id,branch_Name',TABLE_BRANCH,$condition)->result();

		$this->load->view('department/department_list',$data);
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
		   $searchQuery = " and (d.department_Name like '%".$searchValue."%' or (b.branch_Name like '%".$searchValue."%') )";
		}
		if($searchName != ''){
		   $searchQuery .= " and (d.department_Name like '%".$searchName."%' )";
		}if($searchBranch != ''){
		   $searchQuery .= " and (b.id ='".$searchBranch."' )";
		}

		## Total number of records without filtering
		$sel = $this->userM->ExecuteQuery("select count(*) as allcount from ". $this->table." d inner join ".TABLE_BRANCH." b on b.id=d.branch_ID WHERE d.department_active!='E'");
		$records = $sel->row();
		$totalRecords = $records->allcount;

		## Total number of record with filtering
		$sel = $this->userM->ExecuteQuery("select count(*) as allcount from ". $this->table." d inner join ".TABLE_BRANCH." b on b.id=d.branch_ID WHERE d.department_active!='E' ".$searchQuery);
		$records = $sel->row();
		$totalRecordwithFilter = $records->allcount;

		## Fetch records
		$empQuery = "select d.department_Name,d.id as bid,d.department_active,b.branch_Name from ". $this->table." d inner join ".TABLE_BRANCH." b on b.id=d.branch_ID WHERE d.department_active!='E' ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
		$empRecords = $this->userM->ExecuteQuery($empQuery);
		$data = array();

		$row = $empRecords->result();


		foreach ($row as $r) {
			$i++;

			
			$edit 	= base_url('department-edit/'.base64_encode($r->bid).'');
           	$delt 	= "confirm_delete('department-delete/".base64_encode($r->bid)."')";

			$action_data = '<a href="'.$edit.'">
                    <button type="button" class="btn btn-cyan btn-sm">Edit</button></a>';
           
           	/*if($this->data['LoginPrivilege'] =='ADMIN'){        
            	$action_data .='<button type="button" onclick="'.$delt.'" class="btn btn-danger btn-sm">Delete</button>';
        	}*/
			
		   	$data[] = array($r->department_Name,$r->branch_Name,$action_data);
		   
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
		if($this->data['LoginPrivilege']=='ADMIN')
			$data['Branch']  = $this->userM->getParticularDetails('id,branch_Name',TABLE_BRANCH,array('branch_active !='=>'E'))->result();

		/* Edit or view mode */
		if($memId!='' && $mode!=''){
			$q = "select d.id as bid,d.department_Name,d.department_Icon,d.department_active from ". $this->table." d WHERE  d.id='".base64_decode($memId)."'";
			$data['departDetails'] = $this->userM->ExecuteQuery($q)->row();
			$data['mode'] = $mode;
		}else{
			$data['departDetails'] = array();
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
		$this->load->view('department/department_form',$data);
		$this->load->view('temp-parts/footer');	
	}
	/* new department add form ends */

	/* save department start */
	public function save()
	{ //print_r($_FILES);
		$data = $this->data;
		$data = array('success' => false, 'messages' =>array());
		$bUpdate = $this->input->post('bUpdate');
		
		if($bUpdate==0){
			$config = array(
					        array(
					                'field' => 'department_Name',
					                'label' => 'department Name',
					                'rules' => 'required|callback_exists_in_database',
					                 'errors' => array('required' => 'Department Name is required...',
					                )                
					         )
					    );
			 if (empty($_FILES))
				{
				$config[] =	array(
					                'field' => 'department_Icon',
					                'label' => 'department Icon',
					                'rules' => 'required',
					                'errors' => array(
					                        'required' => 'Icon is required...',
					                )
					        );
				}
			
		}else{
			$config[] = array(
	                'field' => 'department_Name',
	                'label' => 'Department Name',
	                'rules' => 'required|callback_exists_in_database_ById',
	                 'errors' => array('required' => 'Department Name is required...',
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

				$config['upload_path']          = './assets/depart_img/';
		        $config['allowed_types']        = 'gif|jpg|png|jpeg';	 

		        $this->load->library('upload', $config);      

				$this->upload->do_upload('department_Icon'); 
		      	$file_info = $this->upload->data();
		      	/*$img ="https://s3.ap-south-1.amazonaws.com/images-minmegamweb/minmegam/minkanaku/purchase_bill/".$file_info['file_name'];*/
		      	$img = $filename = $file_info['file_name'];
		      	/*$path="upload_img/".$filename;

		        $this->load->library('someclass');
		        $this->someclass->sendFile("minmegam/minkanaku/purchase_bill/".$filename,$path);

		        unlink($path);*/

				$fieldAr = array(
					'department_Name'		=>$this->security->xss_clean($this->input->post('department_Name')),
					'department_created_by' => $this->data['LoginID'],
					'department_Manager' 	=> 0,
					'department_Icon'		=> $img,
					'branch_ID' 			=> $this->security->xss_clean($this->input->post('branch_ID')),
					
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
					'department_Name'		=>$this->security->xss_clean($this->input->post('department_Name')),
					'branch_ID' 			=> $this->security->xss_clean($this->input->post('branch_ID')),
					'department_updated_by' => $this->data['LoginID'],
					'department_updated_at' => date('Y-m-d H:i:s')					
				);

				if(!empty($_FILES)){
					$config['upload_path']          = './assets/depart_img/';
			        $config['allowed_types']        = 'gif|jpg|png|jpeg';	 

			        $this->load->library('upload', $config);      

					$this->upload->do_upload('department_Icon'); 
			      	$file_info = $this->upload->data();
			      	/*$img ="https://s3.ap-south-1.amazonaws.com/images-minmegamweb/minmegam/minkanaku/purchase_bill/".$file_info['file_name'];*/
			      	$img = $filename = $file_info['file_name'];

			      	$fieldAr['department_Icon']  = $img;
			      	unlink('./asserts/depart_img/'.$img);
				}

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
	public function exists_in_database()
    {
    	$value = $this->input->post('department_Name');
        $query = $this->db->get_where($this->table, array('department_Name'=> $value,'department_active !='=>'E' )); 

            if ($query->num_rows() > 0 )
            {
                    $this->form_validation->set_message('exists_in_database', 'Department Already Exist....');
                    return FALSE;
            }
            else
            {
                    return TRUE;
            }


    }
    public function exists_in_database_ById()
    {
    	$value = $this->input->post('department_Name');
    	$bId = $this->input->post('bId');
        $query = $this->db->get_where($this->table, array( 'id !=' => $bId,'department_Name'=> $value,'department_active !='=>'E' )); 

            if ($query->num_rows() > 0 )
            {
                    $this->form_validation->set_message('exists_in_database_ById', 'Department Already Exist....');
                    return FALSE;
            }
            else
            {
                    return TRUE;
            }


    }

	/* check existence end */


	/* Delete customer starts */
	public function deleteDepartment($Id)
	{
		$data = $this->data;
		$err_msg 	= "Faill to delete record";
    	$succ_msg 	= "Record deleted successfully";
    	
    	$bID = base64_decode($Id);//exit();
  		$this->userM->updateDetails($this->table,array('department_active'=>'E'),array('id'=>$bID)); 
    	if($this->db->affected_rows()>0){		
			echo $data['success'] =  true;
		} 
    
	    if($data['success']==true){
	        $this->setErrorMessage('success',$succ_msg);
	        
	    }else{
	        $this->setErrorMessage('error_msg', $err_msg);
	        
		}
		redirect(base_url('department-master'));

	}
	
	/* Delete customer ends */

}	