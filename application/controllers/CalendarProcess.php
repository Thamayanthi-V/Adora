<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CalendarProcess extends MY_Controller {

	
	function __construct()
    {
        parent::__construct();
        $this->load->model('CalendarModel');
    }

	public function index(){
		$this->load->view('temp-parts/header');
		$this->load->view('calendar/holiday');
		$this->load->view('temp-parts/footer');
	}

	public function TaskCalendar(){
		$this->load->view('temp-parts/header');
		$data['task']=$this->core_model->getDetailsByResultArray("adora_task",array('Active'=>'A'));
		$this->load->view('calendar/task-calendar',$data);
		$this->load->view('temp-parts/footer');
	}

}