<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TaskProcess extends MY_Controller {

	
	function __construct()
    {
        parent::__construct();
        $this->load->model('TaskModel');
    }

	public function index()
	{
		$this->load->view('temp-parts/header');
    $data['product']=$this->TaskModel->getTaskDetails();
		$this->load->view('task/task-list',$data);
		$this->load->view('temp-parts/footer');
	}

  public function TaskDetails($taskid)
  {
    $this->load->view('temp-parts/header');
    $data['taskdata']=$this->TaskModel->getTaskDetails($taskid);
    $data['employee']=$this->core_model->getDetailsByResultArray("adora_user",array('user_active'=>'A'));
    $data['deptm']=$this->core_model->getDetailsByResultArray("adora_departmnt",array('department_active'=>'A'));
    $data['taskassign']=$this->core_model->getDetailsByResultArray("adora_taskassign",array('taskID'=>$taskid,'Active'=>'A'));
    $this->load->view('task/task-details',$data);
    $this->load->view('temp-parts/footer');
  }


  /* save task assign start */
  public function save()
  {
    $data = $this->data;
    $data = array('success' => false, 'messages' =>array());
    $taskid = $this->input->post('taskid');
    $itemcode = $this->input->post('itemcode');
    $orderid = $this->input->post('orderid');
    $ordernumber = $this->input->post('ordernumber');
    $customerid = $this->input->post('customerid');
    $prdctid = $this->input->post('prdctid');
    $tdept = $this->input->post('tdept');
    $thour = $this->input->post('thour');
    $temp = $this->input->post('temp');
    $taskpriority1 = $this->input->post('taskpriority');
    if($taskpriority1=='YES'){
      $taskpriority = 'YES';
    }else{
      $taskpriority = 'NO';
    }

    $delete=$this->TaskModel->delete('adora_taskassign','taskID',$taskid);
    
    //Update Task Table
    $taskAr = array(
      'task_Status'=>'ASSIGN',
      'task_Priority'=>$taskpriority
    );  
    $this->TaskModel->StatusUpdate('adora_task',$taskAr,$taskid);
    //Update Order Table
    $taskAr = array(
      'order_Status'=>'ASSIGN'
    );
    $this->TaskModel->StatusUpdate('adora_order',$taskAr,$orderid);
    //Insert TaskAssign Table
    $ctdept = count($this->input->post('tdept'));
    for($x = 0; $x < $ctdept; $x++){
      $taskAssignAr = array(
        'orderID'=>$orderid,
        'order_Number'=>$ordernumber,
        'taskID'=>$taskid,
        'customerID'=>$customerid,
        'TA_itemCode'=>$itemcode,
        'TA_productID'=>$prdctid,
        'TA_assignDept'=>$tdept[$x],
        'TA_workingHours'=>$thour[$x],
        'TA_assignuserID'=>$temp[$x],
        'TA_Priority'=>$taskpriority
      ); 
      $this->TaskModel->commonInsert('adora_taskassign',$taskAssignAr);
    }

    if($this->db->affected_rows()>0){   
      $data['success'] =  true;
    }  

    if($data['success'] == true){ 
      $this->setErrorMessage('success','yes');
    }
    else{
      $this->setErrorMessage('error_msg', 'no');
    }
    echo json_encode($data);
  }
  /* save Task ends */

  
  public function ProductionList()
  {
    $this->load->view('temp-parts/header');
    $data['productionlist']=$this->TaskModel->getProductionList($taskid);
    $this->load->view('task/production-list',$data);
    $this->load->view('temp-parts/footer');
  }


  public function UserTaskList()
  {
    $this->load->view('temp-parts/header');
    $this->load->view('task/user-task-list');
    $this->load->view('temp-parts/footer');
  }



  public function UserTaskStart($id)
  {
    $this->load->view('temp-parts/header');
    $TAid = base64_decode($id);
    $data['TAid']=$TAid;
    $data['taskassign']=$this->core_model->getDetailsByRow("adora_taskassign",array('id'=>$TAid,'Active'=>'A'));
    $taskid = $data['taskassign']->taskID;
    $data['taskdata']=$this->TaskModel->getTaskDetails($taskid);
    $this->load->view('task/user-task-start',$data);
    $this->load->view('temp-parts/footer');
  }


  public function StartTaskTime()
  {
    $cdt = date('Y-m-d H:i:s');
    $tid = $_POST['tid'];
    $uid = $_POST['uid'];
    $TAupdate=array('TA_StartDateTime'=>$cdt,'TA_assignuserID'=>$uid,'TA_status'=>'IN PRODUCTION','TA_TimeType'=>'START');
   $this->TaskModel->CommonUpdate('adora_taskassign',$TAupdate,$tid,'id');

   if($this->db->affected_rows()>0){   
      $data['success'] =  true;
    }  

    echo json_encode($data);
  }

  public function PauseTaskTime()
  {
    $tid = $_POST['tid'];
    $sdatetime = $_POST['sdatetime'];
    $cdate = date('Y-m-d H:i:s');
    $pdatetime = $_POST['pdatetime'];

    $stime = strtotime($sdatetime);
    $ctime = strtotime($cdate);
    $ptime = strtotime($pdatetime);
    $caltime = $_POST['caltime'];
    
    if($caltime!=''){
      $ptimesec = abs($ctime - $ptime); 
      $timesec = $caltime+$ptimesec;
    }else{
      $timesec = abs($ctime - $stime);
    }

    $TAupdate=array('TA_CalTime'=>$timesec,'TA_TimeType'=>'PAUSE');
   $this->TaskModel->CommonUpdate('adora_taskassign',$TAupdate,$tid,'id');

   if($this->db->affected_rows()>0){   
      $data['success'] =  true;
    }  

    echo json_encode($data);
  }

  public function PauseStartTaskTime()
  {
    $tid = $_POST['tid'];
    $cdt = date('Y-m-d H:i:s');
    $TAupdate=array('TA_PauseDateTime'=>$cdt,'TA_TimeType'=>'START');
    $this->TaskModel->CommonUpdate('adora_taskassign',$TAupdate,$tid,'id');

   if($this->db->affected_rows()>0){   
      $data['success'] =  true;
    }  

    echo json_encode($data);
  }

  public function EndTaskTime()
  {

    $tid = $_POST['tid'];
    $ttype = $_POST['ttype'];
    $sdatetime = $_POST['sdatetime'];
    $cdate = date('Y-m-d H:i:s');
    $pdatetime = $_POST['pdatetime'];

    $stime = strtotime($sdatetime);
    $ctime = strtotime($cdate);
    $ptime = strtotime($pdatetime);
    $caltime = $_POST['caltime'];

    if($caltime!='' && $ttype=='START'){
      $ptimesec = abs($ctime - $ptime); 
      $timesec = $caltime+$ptimesec;
    }else if($caltime!='' && $ttype=='PAUSE'){
      $timesec = $caltime;
    }else if($caltime=='' && $ttype=='START'){
      $timesec = abs($ctime - $stime);
    }


    $TAupdate=array('TA_status'=>'ITEM READY','TA_EndDateTime'=>$cdate,'TA_CalTime'=>$timesec,'TA_TimeType'=>'END');
    $this->TaskModel->CommonUpdate('adora_taskassign',$TAupdate,$tid,'id');

   if($this->db->affected_rows()>0){   
      $data['success'] =  true;
    }  

    echo json_encode($data);
  }

  



}
