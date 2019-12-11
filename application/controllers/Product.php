<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

	
	function __construct()
    {
        parent::__construct();
        $this->load->model('My_Model','userM');

        $this->table = TABLE_PRODUCT;

		$this->column_order = array('id', 'product_Name','product_Price','product_type');

		// Set default order
        $this->order = array('id' => 'desc');

        /* check login */
        $this->checkLogin('U'); 
    }

    public function index()
    {
        $this->load->view('temp-parts/header');

        $this->load->view('product/product_list');
        $this->load->view('temp-parts/footer');
    }

        /* ajax datatable load starts */
    public function pageLoad()
    {
        $draw = $_POST['draw'];
        $row    = $i = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        /*$columnName = $this->column_order[$_POST['order']['0']['column']]; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc*/
        $searchValue = $_POST['search']['value']; // Search value
        $searchName     = $_POST['name_search']; // Search value
        $searchType   = $_POST['type_search']; // Search value

        if(isset($_POST['order'])){
           $columnName = $this->column_order[$_POST['order']['0']['column']];
           $columnSortOrder = $_POST['order']['0']['dir'];
        }else if(isset($this->order)){
            $columnName = 'id';
            $columnSortOrder = 'desc';
        }
       
       // echo $columnName ;exit();
        ## Search 
        $searchQuery = " ";
        if($searchValue != ''){
           $searchQuery = " and (product_Name like '%".$searchValue."%' )";
        }
        if($searchName != ''){
           $searchQuery .= " and (product_Name like '%".$searchName."%' )";
        }if($searchType != ''){
           $searchQuery .= " and (product_type= '".$searchType."' )";
        }

        ## Total number of records without filtering
        $sel = $this->userM->ExecuteQuery("select count(*) as allcount from ". $this->table." WHERE product_active!='E'");
        $records = $sel->row();
        $totalRecords = $records->allcount;

        ## Total number of record with filtering
        $sel = $this->userM->ExecuteQuery("select count(*) as allcount from ". $this->table." WHERE product_active!='E'".$searchQuery);
        $records = $sel->row();
        $totalRecordwithFilter = $records->allcount;

        ## Fetch records
        $empQuery = "select id as bid,product_Name,product_Price,product_type from ". $this->table."  WHERE product_active!='E' ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
        $empRecords = $this->userM->ExecuteQuery($empQuery);
        $data = array();

        $row = $empRecords->result();


        foreach ($row as $r) {
            $i++;

            
            $edit   = base_url('product-edit/'.base64_encode($r->bid).'');
            $delt   = "confirm_delete('product-delete/".base64_encode($r->bid)."')";

            $action_data = '<a href="'.$edit.'">
                    <button type="button" class="btn btn-cyan btn-sm">Edit</button></a>';
           
            /*if($this->data['LoginPrivilege'] =='ADMIN'){        
                $action_data .='<button type="button" onclick="'.$delt.'" class="btn btn-danger btn-sm">Delete</button>';
            }*/

            if($r->product_type=='SALE')
                $prd_type = 'Selling';
            else
                $prd_type = 'Service';
            
            $data[] = array($r->product_Name,$r->product_Price,$prd_type,$action_data);
           
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

    /* new product add form starts */
    public function add($mode='',$memId='')
    {
        $data = $this->data;

        $this->load->view('temp-parts/header');

        $data['departs']  = $this->userM->getParticularDetails('id,department_Name,department_Icon',TABLE_DEPARTMENT,array('department_active !='=>'E'))->result();

        /* Edit or view mode */
        if($memId!='' && $mode!=''){
            $q = "select product_Name,id as bid,product_Price,product_type,product_departmentDetails,product_active from ". $this->table." WHERE  id='".base64_decode($memId)."'";
            $data['prdDetails'] = $this->userM->ExecuteQuery($q)->row();
            $data['mode'] = $mode;

            $this->load->view('product/product',$data);

        }else{
            $data['prdDetails'] = array();
            $data['mode'] = 'Add';
            $this->load->view('product/product',$data);
        }
        /*$m = $this->userM->ExecuteQuery('select max(id) as maxID from '.$this->table.'')->row();
        //print_r($m);
        if(!empty($m))
        {
            $data['mId'] = $m->maxID + 1;
        }else
            $data['mId'] = '1';*/
        
        
        $this->load->view('temp-parts/footer'); 
    }
    /* new branch add form ends */
    
    /* Product Save Starts */
    public function save()
    {
        $data = $this->data;
        $data = array('success' => false, 'messages' =>array());
        $bUpdate = $this->input->post('bUpdate');

        
        $prdType = $this->input->post('product_type');
        if ($prdType == 'SALE') {
        /* Selling type start */
        $config = array(
            array(
                    'field' => 'product_Price',
                    'label' => 'Price',
                    'rules' => 'required',
                    'errors' => array(
                            'required' => 'Price is required...',
                    )
            )
        );
        if ($bUpdate==0) {
           $config[] = array(
                    'field' => 'product_Name',
                    'label' => 'Product Name',
                    'rules' => 'required|callback_exists_in_database',
                     'errors' => array('required' => 'Product Name is required...',
                    )                
             );
        }else{
            $config[] = array(
                    'field' => 'product_Name',
                    'label' => 'Product Name',
                    'rules' => 'required|callback_exists_in_database_ById',
                     'errors' => array('required' => 'Product Name is required...',
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
            if ($bUpdate==0) {
                /* insert */
                $fieldAr = array(
                    'product_Name'       =>$this->security->xss_clean($this->input->post('product_Name')),
                    'product_Price'       =>round($this->security->xss_clean($this->input->post('product_Price')),2),
                    'product_type'       => 'SALE',
                    'product_departmentDetails'       => '',
                    'product_created_by' => $this->data['LoginID'],
                    
                );

                $err_msg    = "Faill to insert record";
                $succ_msg   = "Record inserted successfully";

                $this->userM->simpleInsert($this->table,$fieldAr);
                if($this->db->affected_rows()>0){       
                    $data['success'] =  true;
                }
            }else{
                $err_msg    = "Faill to update record";
                $succ_msg   = "Record updated successfully";
                /* update */
                $fieldAr = array(
                    'product_Name'       =>$this->security->xss_clean($this->input->post('product_Name')),
                    'product_Price'       =>round($this->security->xss_clean($this->input->post('product_Price')),2),
                    'product_updated_by' => $this->data['LoginID'],
                    'product_updated_at' => date('Y-m-d H:i:s')                  
                );

                $this->userM->updateDetails($this->table,$fieldAr,array('id'=>$this->input->post('bId')));
                if($this->db->affected_rows()>0){       
                    $data['success'] = true;
                }

            }        
        }
        /* Selling type end */
        }else{
            /* Service type start */
            $config = array(
                array(
                        'field' => 'product_Price',
                        'label' => 'Price',
                        'rules' => 'required',
                        'errors' => array(
                                'required' => 'Price is required...',
                        )
                )
            );
            if ($bUpdate==0) {
               $config[] = array(
                        'field' => 'product_Name',
                        'label' => 'Product Name',
                        'rules' => 'required|callback_exists_in_database',
                         'errors' => array('required' => 'Product Name is required...',
                        )                
                 );
            }else{
                $config[] = array(
                        'field' => 'product_Name',
                        'label' => 'Product Name',
                        'rules' => 'required|callback_exists_in_database_ById',
                         'errors' => array('required' => 'Product Name is required...',
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
                $departAr = $this->input->post('department');
                $departDetails ='';
                foreach ($departAr as $key => $value) {
                    $departDetails .= $value.'==>'.$this->input->post('max_'.$value).'|'.$this->input->post('med_'.$value).'|'.$this->input->post('min_'.$value).'/**/';
                }
                $departDetails = rtrim($departDetails,'/**/');

                if ($bUpdate==0) {
                    /* insert */
                    $fieldAr = array(
                        'product_Name'       =>$this->security->xss_clean($this->input->post('product_Name')),
                        'product_Price'       =>round($this->security->xss_clean($this->input->post('product_Price')),2),
                        'product_type'       => 'SERVICE',
                        'product_departmentDetails'       => $departDetails,
                        'product_created_by' => $this->data['LoginID'],
                        
                    );

                    $err_msg    = "Faill to insert record";
                    $succ_msg   = "Record inserted successfully";

                    $this->userM->simpleInsert($this->table,$fieldAr);
                    if($this->db->affected_rows()>0){       
                        $data['success'] =  true;
                    }
                }else{
                    $err_msg    = "Faill to update record";
                    $succ_msg   = "Record updated successfully";
                    /* update */
                    $fieldAr = array(
                        'product_Name'       =>$this->security->xss_clean($this->input->post('product_Name')),
                        'product_Price'       =>round($this->security->xss_clean($this->input->post('product_Price')),2),
                        'product_departmentDetails'       => $departDetails,
                        'product_updated_by' => $this->data['LoginID'],
                        'product_updated_at' => date('Y-m-d H:i:s')                  
                    );

                    $this->userM->updateDetails($this->table,$fieldAr,array('id'=>$this->input->post('bId')));
                    if($this->db->affected_rows()>0){       
                        $data['success'] = true;
                    }

                }        
            }

            /* Service type end */
        }

       echo json_encode($data);

    }
    /* Product Save ends */

    /* check existence start */
    public function exists_in_database()
    {
        $value = $this->input->post('product_Name');
        $type = $this->input->post('product_type');
        $query = $this->db->get_where($this->table, array('product_Name'=> $value,'product_type'=>$type,'product_active !='=>'E' )); 

            if ($query->num_rows() > 0 )
            {
                    $this->form_validation->set_message('exists_in_database', 'Product Already Exist in '.strtolower($type).'....');
                    return FALSE;
            }
            else
            {
                    return TRUE;
            }


    }
    public function exists_in_database_ById()
    {
        $value = $this->input->post('product_Name');
        $bId = $this->input->post('bId');
        $type = $this->input->post('product_type');
        $query = $this->db->get_where($this->table, array( 'id !=' => $bId,'product_Name'=> $value,'product_type'=>$type,'product_active !='=>'E' )); 

            if ($query->num_rows() > 0 )
            {
                    $this->form_validation->set_message('exists_in_database_ById', 'Product Already Exist in '.strtolower($type).'....');
                    return FALSE;
            }
            else
            {
                    return TRUE;
            }


    }

    /* check existence end */
    /* Product type based form field load  start */
    public function getPrdFields()
    { 
        $product_type = $this->input->post('prdType');
        $product_id = $this->input->post('bid');
        $prdAr = array();
        if($product_id!=''){
            $q = "select product_Name,id as bid,product_Price,product_type,product_departmentDetails,product_active from ". $this->table." WHERE  id='".$product_id."'";
            $prdAr = $this->userM->ExecuteQuery($q)->row();
            
        }
        if ($product_type=='SALE') {
            $pname = (!(empty($prdAr))?$prdAr->product_Name:'');    
            $pPrice = (!(empty($prdAr))?$prdAr->product_Price:'0');    
            echo '<div class="row col-sm-12"><div class="form-group col-xs-6 col-sm-4">
                              <label>Product Name</label>
                              <input type="text" class="form-control dev_sale" name="product_Name" id="product_Name" value="'.$pname.'"  placeholder="Name"  />
                           </div>
                           <div class="form-group col-xs-6 col-sm-4">
                              <label>Price</label>
                              <input type="text" class="form-control dev_sale" name="product_Price" id="product_Price" onkeypress="return floatKeypress(event)" value="'.$pPrice.'"  placeholder="Price"  />
                           </div></div>';
        }else{
            $pname = (!(empty($prdAr))?$prdAr->product_Name:'');    
            $pPrice = (!(empty($prdAr))?$prdAr->product_Price:'0'); 
            $pDeptLst = $pTime = array();
            if(!(empty($prdAr))){ 
                $pD= explode('/**/', $prdAr->product_departmentDetails);
                foreach ($pD as $key => $value) {
                    $pT  = explode('==>', $value);
                    $pDeptLst[] = $pT[0];
                    $p = explode('|', $pT[1]); 
                    $pTime[$pT[0]] = $p;
                }
              
            }
            echo '<div class="row col-sm-12"><div class="form-group col-xs-6 col-sm-4">
                  <label>Product Name</label>
                  <input type="text" class="form-control dev_service" name="product_Name" id="product_Name" value="'.$pname.'"  placeholder="Name"  />
               </div>
               <div class="form-group col-xs-6 col-sm-4">
                  <label>Price</label>
                  <input type="text" class="form-control dev_service" name="product_Price" id="product_Price" value="'.$pPrice.'" onkeypress="return floatKeypress(event)"   placeholder="Price"  />
               </div></div>';
            $departs = $this->userM->getParticularDetails('id,department_Name,department_Icon',TABLE_DEPARTMENT,array('department_active !='=>'E'))->result();
   
            if(!empty($departs)){ 
                echo '<table class="table">
                  <thead>';
                foreach ($departs as $dept) {
                    if(!empty($prdAr))
                    {   
                       
                        $selDept = (in_array($dept->id, $pDeptLst)?'checked':'');
                        $selDmin = (in_array($dept->id, $pDeptLst)? ($pTime[$dept->id][2]):'');
                        $selDmed = (in_array($dept->id, $pDeptLst)? ($pTime[$dept->id][1]):'');
                        $selDmax = (in_array($dept->id, $pDeptLst)? ($pTime[$dept->id][0]):'');
                    }
                    echo '
                     <tr>
                        <th scope="col">
                           <label class="btn btn-default toggle-checkbox primary">
                           <i class="fa fa-fw"></i> <img src="'.base_url().'assets/depart_img/'.$dept->department_Icon.'" title="'.$dept->department_Name.'" class="user-image" alt="'.$dept->department_Name.'">
                           <input id="departs_'.$dept->id.'" autocomplete="off" name="department[]" class="dev_pdept" type="checkbox" value="'.$dept->id .'" onchange="setRequireToTime()" '.$selDept.' />
                           </label>
                        </th>
                        <th scope="col">
                           <label>Max Work Time(hr)</label>
                           <input type="text" class="form-control pdTime" name="max_'.$dept->id.'" id="max_'.$dept->id.'" value="'.$selDmax.'" onkeypress="return floatKeypress(event)"   placeholder=""  />
                        </th>
                        <th scope="col">
                           <label>Med Work Time(hr)</label>
                           <input type="text" class="form-control pdTime" name="med_'.$dept->id.'" id="med_'.$dept->id.'" value="'.$selDmed.'" onkeypress="return floatKeypress(event)"   placeholder=""  />
                        </th>
                        <th scope="col">
                           <label>Min Work Time(hr)</label>
                           <input type="text" class="form-control pdTime" name="min_'.$dept->id .'" id="min_'.$dept->id.'" value="'.$selDmin.'"  onkeypress="return floatKeypress(event)"  placeholder=""  />
                        </th>
                     </tr>';
                     }
                echo '  </thead>

                  <tbody>
                  </tbody>
               </table>';
            } else {
               echo "No Department Added.";

            } 
        }
    }
    /* Product type based form field load  ends */
}