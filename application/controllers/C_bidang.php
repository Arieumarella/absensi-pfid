<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_bidang extends CI_Controller {

	protected $tabel = 'tb_bidang';
	protected $idx = 'tb_bidang.idx';
	protected $select = 'tb_bidang.idx, tb_bidang.id_slug, tb_bidang.nama_bidang';
	protected $colom_search = array('tb_bidang.idx', 'tb_bidang.id_slug', 'tb_bidang.nama_bidang');
	protected $colom_order = array('tb_bidang.idx', 'tb_bidang.id_slug', 'tb_bidang.nama_bidang');
	protected $order = array('tb_bidang.idx' => 'asc');
	protected $where,$data;

	// M_dinamis
	protected $select2 = 'tb_bidang.idx, tb_bidang.id_slug, tb_bidang.nama_bidang';
	protected $order2 = 'tb_bidang.idx';
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
		$tmp['tittle'] = 'Data Bidang';
		$tmp['content'] = 'content/c_bidang.php';
		$this->load->view('tamplate.php', $tmp);
	}

	public function getById(){
		$slug_id = $this->input->post('slug_id');

		$lemparData = array(
			'id_slug' => $slug_id
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
		$namaBidang = $this->input->post('namaBidang');
 		$id_slug = $this->M_dinamis->max_value('tb_bidang', 'id_slug');
 		var_dump($id_slug->id_slug);
		$data = array(
			'nama_bidang' => $namaBidang,
			'id_slug' => $id_slug->id_slug+1,
			'created_at' => date('Y-m-d h:i')
		);


		$save = $this->M_dinamis->save('tb_bidang', $data);

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
		$namaBidang = $this->input->post('namaBidang');
		$id_slug = $this->input->post('id_slug');
		
		var_dump($namaBidang);
		$data = array(
			'nama_bidang' => $namaBidang,
			'updated_at' => date('Y-m-d h:i')
		);

		$where = array(
			'id_slug' => $id_slug
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
				'id_slug' => $idx
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
            $row[] = '<button class="btn btn-sm btn-warning m-1" onclick="editData('.$main->id_slug.');"><i class="fas fa-pen-alt"></i></button><button class="btn btn-sm btn-danger m-1" onclick="hapusData('.$main->id_slug.');"><i class="fas fa-trash"></i></button>';
            $row[] = $main->nama_bidang;
            $row[] = $main->id_slug;
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