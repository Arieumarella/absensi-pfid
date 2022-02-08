<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_formulir extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_dinamis');
		if($this->session->userdata('logged') != TRUE){
			redirect(base_url("C_login"));
		}
	}

	public function index($id = NULL)
	{
		if ($id != null) {
			
		$tmp['tittle'] = 'Form Absensi';
		$tmp['dataEvent'] = $this->M_dinamis->getById('tb_event', array('idx' => $id));
		$tmp['dataBidang'] = $this->M_dinamis->add_in('tb_bidang', 'id_slug,nama_bidang', 'id_slug', 'asc', explode(",",$tmp['dataEvent']->slug_bidang));
		$tmp['dataProvinsi'] = $this->M_dinamis->add_all('tb_provinsi', 'id_slug,name', 'id_slug', 'asc');
		if ($tmp['dataEvent']) {
			
			$this->load->view('content/c_formulir.php', $tmp);
			return true;
		}
		$res = array(
			"code" => 500,
			"status" => "false",
			"Massage" => "Parameter Tidak Ditemukan."
		);

		echo json_encode($res);

		}else{

		$res = array(
			"code" => 500,
			"status" => "false",
			"Massage" => "Parameter Tidak Boleh Kosong"
		);

		echo json_encode($res);

		}
		
	}

	public function saveForm($value='')
	{
		$name = $this->input->post('name');	
		$jabatan = $this->input->post('jabatan');	
		$instansi = $this->input->post('instansi');	
		$email = $this->input->post('email');	
		$tlp = $this->input->post('tlp');	
		$bidang = $this->input->post('bidang');	
		$provinsi = $this->input->post('provinsi');	
		$kota = $this->input->post('kota');	
		$slug_event = $this->input->post('slug_event');	

		$data = array(
			'name_peserta' => $name,
			'jabatan' => $jabatan,
			'slug_bidang' => $bidang,
			'slug_provinsi' => $provinsi,
			'slug_daerah' => $kota,
			'instansi' => $instansi,
			'email' => $email,
			'tlp' => $tlp,
			'slug_event' => $slug_event,
			'created_at' => date('Y-m-d h:i')
		);

		$save = $this->M_dinamis->save('tb_peserta', $data);

		if ($save) {
			$res = array(
				'code' => 200,
				'status' => 'true',
				'massage' => 'Data Berhasil Disimpan.!'
			);

			echo json_encode($res);
			return TRUE;
		}
		$res = array(
				'code' => 500,
				'status' => 'false',
				'massage' => 'Ada yg eror nih gan.!'
		);

		echo json_encode($res);
		return TRUE;
	}

	public function getKab()
	{
		$slug_provinsi = $this->input->post('slug_id');
		$lemparData = array(
			'id_provinsi' => $slug_provinsi
		);

		$data = $this->M_dinamis->getResult('tb_daerah', $lemparData);

		echo json_encode($data);
	}

}

/* End of file C_formulir.php */
/* Location: ./application/controllers/C_formulir.php */