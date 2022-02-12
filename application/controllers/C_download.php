<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_download extends CI_Controller {

	protected $tabel = 'tb_download';
	protected $idx = 'tb_download.idx';
	protected $select = 'tb_download.idx, tb_download.nama, tb_download.nama_asli, tb_download.slug, tb_download.created_at';
	protected $colom_search = array('tb_download.idx', 'tb_download.nama', 'tb_download.nama_asli', 'tb_download.slug', 'tb_download.created_at');
	protected $colom_order = array('tb_download.idx', 'tb_download.nama', 'tb_download.nama_asli', 'tb_download.slug', 'tb_download.created_at');
	protected $order = array('tb_download.idx' => 'asc');
	protected $where,$data;

	// M_dinamis
	protected $select2 = 'tb_download.idx, tb_download.nama, tb_download.nama_asli, tb_download.slug, tb_download.created_at';
	protected $order2 = 'tb_download.idx';
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
		$tmp['tittle'] = 'Data Download';
		$tmp['content'] = 'content/c_download.php';
		$this->load->view('tamplate.php', $tmp);
	}

	public function do_upload()
	{
        $config['upload_path']="./assets/downloadFile";
        $config['allowed_types']='*';
		$asal = $_FILES['fileUpload']['name'];
		$config['file_name'] = substr(mt_rand(), 0, 3).$asal;
         
        $this->load->library('upload',$config);
        if($this->upload->do_upload("fileUpload")){
 
			$data = array('upload_data' => $this->upload->data());
            $file = $data['upload_data']['file_name'];
			$filename = $_FILES['fileUpload']['name'];
			$x = preg_replace("/[^a-zA-Z]/", " ", $filename);
			$x = str_replace(" ", "-", $x);

			$dataArray = array(
				"nama" => $file,
				"nama_asli" => $filename,
				"slug" => $x,
				"created_at" => date('Y-m-d h:i:s')
			);

			$this->M_dinamis->save('tb_download', $dataArray);

			$res = array(
				'code' => 200,
				'status' => 'true',
				'massage' => 'Data Berhasil Disimpan.!'
			);

            echo json_encode($res);
        }else{

			$res = array(
				'code' => 401,
				'status' => 'false',
				'massage' => 'Data Gagal Disimpan'
			);

            echo json_encode($res);

		}
 
    }

	public function download($slug = NULL)
	{
		if($slug != null){
			$this->load->helper('download');
			
			$lemparData = array(
				'slug' => $slug
			);
	
			$data = $this->M_dinamis->getById($this->tabel, $lemparData);
			force_download('assets/downloadFile/'.$data->nama,NULL);			
			return;
		}

		echo '<h1>401 Unautorize</h1>';

	}

	public function delete()
	{
		
		$slug = $this->input->post('slug');
		$where = array(
				'idx' => $slug
			);

		
		$data = $this->M_dinamis->getById($this->tabel, $where);
        unlink('assets/downloadFile/'.$data->nama);
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
            $row[] = '<button class="btn btn-sm btn-danger m-1" onclick="hapusData('.$main->idx.');"><i class="fas fa-trash"></i></button>';
            $row[] = '<p class="fontSize">'.$main->nama_asli.'</p>';
            $row[] = '<a class="fontSize" href="'.base_url().'C_download/download/'.$main->slug.'">'.base_url().'C_download/download/'.$main->slug.' 
					  </a>
					  <br> <button class="btn btn-dark btn-sm copyed mt-2" data-clipboard-text="'.base_url().'C_download/download/'.$main->slug.'"><i class="far fa-clipboard"></i> Copy</button> 
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