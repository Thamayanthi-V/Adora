<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signin extends MY_Controller {

	
	function __construct()
    {
        parent::__construct();
        $this->load->model('My_Model','userM');

        $this->table = TABLE_USER;

		$this->column_order = array('u.user_Name','u.user_privileges','m.user_Name','u.user_active');

		// Set default order
        $this->order = array('u.id' => 'desc');
    }

    public function index()
    {
         /* check login */
        if($this->session->userdata('customer_id') != ""){
            redirect(base_url('OrderProcess'));
        }

        $this->load->view('login/login');
    }

    public function usernamecheck()
    {  
         $username = $_REQUEST['name'];
           
            
        $this->db->group_start();
        $this->db->or_where('user_loginkey', $username);
        $this->db->group_end();
        $query = $this->db->get(TABLE_USER);
        //echo $this->db->last_query();
        //echo $query->num_rows();
        if ($query->num_rows() > 0 )
        {  
            echo 'true';  
        } else {
            echo 'false';
        }
       
    }
    
    public function loginSubmit()
    {
         /* check login */
        if($this->session->userdata('customer_id') != ""){
            redirect(base_url('OrderProcess'));
        }

        $data = array('success' => false, 'msg' => "", 'messages' =>array());
        $this->load->library('form_validation');
        $config = array(
                
              array(
                    'field' => 'dev_username',
                    'label' => 'username',
                    'rules' => 'required'
                    
                ),
              array(
                    'field' => 'dev_pwd',
                    'label' => 'Password',
                    'rules' => 'required'
                    
                )
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

            $username   = $this->input->post('dev_username');
            $pwd        = $this->input->post('dev_pwd');
   
    
        
            $this->db->where('user_loginkey', $username);
            $this->db->where('user_loginpwd',base64_encode($pwd));
            
            $query = $this->db->get(TABLE_USER);
            
            if ($query->num_rows() > 0 )
            {   
                $result = $query->row();
                $data['success'] = true;
                $data['msg'] = "Correct";


                $newdata = array(
                    'customer_id'   => $result->id,
                    'customer_name' => $result->user_Name,
                    'customer_branch' => $result->branch_ID,   
                    'customer_privilege' => $result->user_privileges
                  );
                $this->session->set_userdata($newdata);
                          
            }
            else
            {
                $data['success'] = true;
                $data['msg'] = "InCorrect";
            }         
        }

        echo json_encode($data);
    }

    public function logout()
    {


        foreach (array_keys($this->session->userdata) as $key)
        {
            $this->session->unset_userdata($key); 
        }

         redirect(base_url());
    }

}

