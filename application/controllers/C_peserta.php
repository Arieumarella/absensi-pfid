<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_peserta extends CI_Controller {

	protected $tabel = 'tb_peserta';
	protected $idx = 'tb_peserta.idx';
	protected $select = 'tb_peserta.*, tb_provinsi.name AS nama_provinsi, tb_daerah.city_name, tb_event.name_event, tb_bidang.nama_bidang';
	protected $colom_search = array('tb_peserta.idx','tb_peserta.name_peserta','tb_peserta.jabatan','tb_peserta.slug_bidang','tb_peserta.slug_provinsi ','tb_peserta.slug_daerah','tb_peserta.instansi','tb_peserta.email','tb_peserta.slug_event', 'tb_provinsi.name ', 'tb_daerah.city_name', 'tb_event.name_event', 'tb_bidang.nama_bidang');
	protected $colom_order = array('tb_peserta.idx','tb_peserta.name_peserta','tb_peserta.jabatan','tb_peserta.slug_bidang','tb_peserta.slug_provinsi ','tb_peserta.slug_daerah','tb_peserta.instansi','tb_peserta.email','tb_peserta.slug_event', 'tb_provinsi.name ', 'tb_daerah.city_name', 'tb_event.name_event', 'tb_bidang.nama_bidang');
	protected $order = array('tb_peserta.idx' => 'asc');
	protected $where,$data;

	// M_dinamis
	protected $select2 = 'tb_peserta.*, tb_provinsi.name AS nama_provinsi, tb_daerah.city_name, tb_event.name_event, tb_bidang.nama_bidang';
	protected $order2 = 'tb_peserta.idx';
	protected $urut = 'asc';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_dinamis');
		$this->load->model('M_peserta');
		if($this->session->userdata('logged') != TRUE){
			redirect(base_url("C_login"));
		}
	}

	public function index( $offset = 0 )
	{
		$tmp['tittle'] = 'Data Peserta';
		$tmp['content'] = 'content/c_peserta.php';
		$tmp['dataBidang'] = $this->M_dinamis->add_all('tb_bidang', 'id_slug,nama_bidang', 'id_slug,nama_bidang', 'asc');
		$tmp['dataEvent'] = $this->M_dinamis->add_all('tb_event', 'idx,name_event', 'idx,name_event', 'asc');
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
		$data = $this->M_dinamis->add_all('tb_peserta', 'tb_peserta.id_slug, tb_peserta.nama_bidang', 'tb_peserta.id_slug', 'asc');
		echo json_encode($data);
	}

	public function save()
	{
		$namaBidang = $this->input->post('namaBidang');
 		$id_slug = $this->M_dinamis->max_value('tb_peserta', 'id_slug');
 		var_dump($id_slug->id_slug);
		$data = array(
			'nama_bidang' => $namaBidang,
			'id_slug' => $id_slug->id_slug+1,
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
        $list = $this->M_peserta->get_datatables($this->tabel, $this->colom_order, $this->colom_search, $this->order, $this->select);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $main) {
            $no++;
            $row = array();
            $row[] = $main->name_peserta;
            $row[] = $main->jabatan;
            $row[] = $main->nama_bidang;
            $row[] = $main->nama_provinsi;
            $row[] = $main->city_name;
            $row[] = $main->instansi;
            $row[] = $main->email;
			$row[] = $main->tlp;
            $row[] = $main->name_event;
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->M_peserta->count_all($this->tabel, $this->select),
                        "recordsFiltered" => $this->M_peserta->count_filtered($this->tabel, $this->colom_order, $this->colom_search, $this->order, $this->select),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

}

/* End of file C_event.php */
/* Location: ./application/controllers/C_event.php */