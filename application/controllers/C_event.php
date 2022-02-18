<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_event extends CI_Controller {

	protected $tabel = 'tb_event';
	protected $idx = 'tb_event.idx';
	protected $select = 'tb_event.idx, tb_event.name_event, tb_event.location, tb_event.date_event, tb_event.date_start, tb_event.date_finish';
	protected $colom_search = array('tb_event.idx', 'tb_event.name_event', 'tb_event.location', 'tb_event.date_event', 'tb_event.date_start', 'tb_event.date_finish');
	protected $colom_order = array('tb_event.idx', 'tb_event.name_event', 'tb_event.location', 'tb_event.date_event', 'tb_event.date_start', 'tb_event.date_finish');
	protected $order = array('tb_event.idx' => 'asc');
	protected $where,$data;

	// M_dinamis
	protected $select2 = 'tb_event.idx, tb_event.name_event, tb_event.location, tb_event.date_event, tb_event.date_start, tb_event.date_finish';
	protected $order2 = 'tb_event.idx';
	protected $urut = 'asc';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_dinamis');
		if($this->session->userdata('logged') != TRUE){
			redirect(base_url("C_login"));
		}

	}

	public function index( $offset = 0 )
	{
		$tmp['tittle'] = 'Data Event';
		$tmp['content'] = 'content/c_event.php';
		$this->load->view('tamplate.php', $tmp);
	}

	public function getById(){
		$slug_id = $this->input->post('slug_id');

		$lemparData = array(
			'idx' => $slug_id
		);

		$data = $this->M_dinamis->getById($this->tabel, $lemparData);

		echo json_encode($data);		
	}

	public function getBidang()
	{
		$data = $this->M_dinamis->add_all('tb_bidang', 'tb_bidang.id_slug, tb_bidang.nama_bidang', 'tb_bidang.id_slug', 'asc');
		echo json_encode($data);
	}

	public function save()
	{
		$nama_event = $this->input->post('namaEvent');
		$tanggal = $this->input->post('dateTimePicker');
		$waktuMulai = $this->input->post('waktuMulai');
		$waktuAkhir = $this->input->post('waktuAkhir');
		$ValuewaktuAkhir = $this->input->post('setWaktuAkhir');
		$lokasi = $this->input->post('lokasi');
		$bidang = $this->input->post('bidang');
		$forUse = $this->input->post('forUse');
 		
		$data = array(
			'name_event' => $nama_event,
			'date_event' => $tanggal,
			'date_start' => $waktuMulai,
			'location' => $lokasi,
			'slug_bidang' => implode(",", $bidang),
			'for_use' => $forUse,
			'created_at' => date('Y-m-d h:i')
		);

		

		if ($waktuAkhir != 'selesai') {
			$data['date_finish'] = $ValuewaktuAkhir;
		}else{
			$data['date_finish'] = 'selesai';
		}

		$save = $this->M_dinamis->save('tb_event', $data);

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

	public function update()
	{
		$nama_event = $this->input->post('namaEvent');
		$tanggal = $this->input->post('dateTimePicker');
		$waktuMulai = $this->input->post('waktuMulai2');
		$waktuAkhir = $this->input->post('waktuAkhir');
		$ValuewaktuAkhir = $this->input->post('setWaktuAkhir');
		$lokasi = $this->input->post('lokasi');
		$bidang = $this->input->post('bidang');
		$idx = $this->input->post('idx');
		$forUse2 = $this->input->post('forUse2');

		$data = array(
			'name_event' => $nama_event,
			'date_event' => $tanggal,
			'date_start' => $waktuMulai,
			'location' => $lokasi,
			'slug_bidang' => implode(",", $bidang),
			'updated_at' => date('Y-m-d h:i'),
			'for_use' => $forUse2
		);

		if ($waktuAkhir != 'selesai') {
			$data['date_finish'] = $ValuewaktuAkhir;
		}else{
			$data['date_finish'] = 'selesai';
		}


		$where = array(
			'idx' => $idx
		);

		$proses = $this->M_dinamis->update($this->tabel, $data, $where);

		if ($proses) {
			return true;
		}else{
			return FALSE;
		}
	}



	public function delete()
	{
		
		$idx = $this->input->post('id_slug');
		$where = array(
				'idx' => $idx
			);

		$delete = $this->M_dinamis->delete($this->tabel, $where);

		if ($delete) {
			$res = array(
				'code' => 200,
				'status' => 'true',
				'massage' => 'Data Berhasil Dihapus.!'
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


	public function get_data_tables()
    {
        $list = $this->M_dinamis->get_datatables($this->tabel, $this->colom_order, $this->colom_search, $this->order, $this->select);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $main) {
            $no++;
            $row = array();
            $row[] = '<button class="btn btn-sm btn-warning m-1" onclick="editData('.$main->idx.');"><i class="fas fa-pen-alt"></i></button><button class="btn btn-sm btn-danger m-1" onclick="hapusData('.$main->idx.');"><i class="fas fa-trash"></i></button>';
            $row[] = $main->name_event;
            $row[] = $main->location;
            $row[] = $main->date_event;
            $row[] = $main->date_start;
            $row[] = $main->date_finish;
            $row[] = '<a href="'.base_url().'C_formulir/index/'.$main->idx.'">'.base_url().'C_formulir/index/'.$main->idx.'</a><br> 
            	<button class="btn btn-dark btn-sm copyed mt-2" data-clipboard-text="'.base_url().'C_formulir/index/'.$main->idx.'"><i class="far fa-clipboard"></i> Copy</button>
            	';
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->M_dinamis->count_all($this->tabel, $this->select),
                        "recordsFiltered" => $this->M_dinamis->count_filtered($this->tabel, $this->colom_order, $this->colom_search, $this->order, $this->select),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

}

/* End of file C_event.php */
/* Location: ./application/controllers/C_event.php */