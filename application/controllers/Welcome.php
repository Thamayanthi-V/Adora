<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html

	 */
	function __construct()
    {
        parent::__construct();
    }
	public function index()
	{
		$this->load->view('temp-parts/header');

		$this->load->view('index');
		$this->load->view('temp-parts/footer');
	}
	public function login()
	{
		$this->load->view('temp-parts/header');

		$this->load->view('login/login');
		$this->load->view('temp-parts/footer');
	}
	public function userprofile()
	{
		$this->load->view('temp-parts/header');

		$this->load->view('user-profile/user-profile');
		$this->load->view('temp-parts/footer');
	}
	public function sales()
	{
		$this->load->view('temp-parts/header');

		$this->load->view('sales/sales');
		$this->load->view('temp-parts/footer');
	}
	public function saleslist()
	{
		$this->load->view('temp-parts/header');

		$this->load->view('sales/sales-list');
		$this->load->view('temp-parts/footer');
	}
	public function orderlist()
	{
		$this->load->view('temp-parts/header');

		$this->load->view('order/orderlist');
		$this->load->view('temp-parts/footer');
	}
	public function product()
	{
		$this->load->view('temp-parts/header');

		$this->load->view('product/product');
		$this->load->view('temp-parts/footer');
	}
	public function customer()
	{
		$this->load->view('temp-parts/header');
		$this->load->view('customer/customer');
		$this->load->view('temp-parts/footer');
	}
	public function customerlist()
	{
		$this->load->view('temp-parts/header');
		$this->load->view('customer/customer-list');
		$this->load->view('temp-parts/footer');
	}
	public function user()
	{
		$this->load->view('temp-parts/header');
		$this->load->view('user/user');
		$this->load->view('temp-parts/footer');
	}
	public function userlist()
	{
		$this->load->view('temp-parts/header');
		$this->load->view('user/user-list');
		$this->load->view('temp-parts/footer');
	}
	public function department()
	{
		$this->load->view('temp-parts/header');
		$this->load->view('department/department');
		$this->load->view('temp-parts/footer');
	}
	public function departmentlist()
	{
		$this->load->view('temp-parts/header');
		$this->load->view('department/department-list');
		$this->load->view('temp-parts/footer');
	}
	public function calendar()
	{
		$this->load->view('temp-parts/header');
		$this->load->view('calendar/calendar');
		$this->load->view('temp-parts/footer');
	}
}

