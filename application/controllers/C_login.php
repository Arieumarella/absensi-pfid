<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_dinamis');
		
	}

	public function index()
	{
		$tmp['tittle'] = 'Login Page';
		$this->session->sess_destroy();
		$this->load->view('login.php', $tmp);
	}

	public function setLogin()
	{
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));

		$data = array(
			'username' => $username,
			'password' => $password
		);

		$login = $this->M_dinamis->getById('tb_administrator', $data);
		
		if ($login) {
			
		$data = array(
            'logged' => TRUE,
            'id_slug' => $login->idx,
            'name'   => $login->username
        );
        $this->session->set_userdata($data);
        redirect('C_event');

		}

			$this->session->set_flashdata('login', 'username or password is invalid');
       	    redirect('C_login');
		
	}



	public function Distroy()
	{
        $this->session->sess_destroy();

        $this->session->set_flashdata('login', 'you have logged out.!');
        redirect('C_login');
	}

}

/* End of file loginAbsensi.php */
/* Location: ./application/controllers/loginAbsensi.php */