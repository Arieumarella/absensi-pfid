<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dinamis extends CI_Model {

public function add_all($tabel, $select, $order, $urut)
{
    $this->db->from($tabel);
    $this->db->select($select);
    $this->db->order_by($order, $urut);
    return $this->db->get()->result();
}

public function add_in($tabel, $select, $order, $urut, $where)
{
    $this->db->from($tabel);
    $this->db->select($select);
     $this->db->where_in('id_slug', $where);
    $this->db->order_by($order, $urut);
    return $this->db->get()->result();
}

public function update($tabel, $dataUbah, $where){
    $this->db->where($where);
   return $this->db->update($tabel, $dataUbah);
}

public function slug_id($tabel, $select, $order, $urut)
{
    $this->db->from($tabel);
    $this->db->select($select);
    $this->db->order_by($order, $urut);
    return $this->db->get()->result_array();
}

public function max_value($tabel, $select)
{
    $this->db->select_max($select);
    $this->db->from($tabel);
    return $this->db->get()->row();
}

public function save($tabel, $data){
    return $this->db->insert($tabel, $data);
}

public function countDataById($tabel, $data)
{
    return $this->db->get_where($tabel, $data)->num_rows();
}

public function getResult($tabel, $data)
{
    return $this->db->get_where($tabel, $data)->result();
}

public function getResult2($tabel, $data)
{
    return $this->db->get_where($tabel, $data)->result_array();
}

public function getById($tabel, $data)
{
    return $this->db->get_where($tabel, $data)->row();
}

public function delete($tabel, $data){
    $this->db->where($data);
    return $this->db->delete($tabel);
}

private function _get_datatables_query($tabel, $colom_order, $colom_search, $order, $select)
    {
         
        //add custom filter here
        // if($this->input->post('daerah'))
        // {
        //     $this->db->where('daerah', $this->input->post('daerah'));
        // }
        // if($this->input->post('bidang'))
        // {
        //     $this->db->where('id_bidang', $this->input->post('bidang'));
        // }
        // if($this->input->post('nama_pegawai'))
        // {
        //     $this->db->like('nama', $this->input->post('nama_pegawai'));
        // }
        // if($this->input->post('tahun'))
        // {
        //     $this->db->where('tahun', $this->input->post('tahun'));
        // }
        $this->db->select($select);
        $this->db->from($tabel);
        $i = 0;
     
        foreach ($colom_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($colom_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            
           $this->db->order_by($colom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($order))
        {
            $order = $order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    public function get_datatables($tabel, $colom_order, $colom_search, $order, $select)
    {
        
        $this->_get_datatables_query($tabel, $colom_order, $colom_search, $order, $select);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    public function count_filtered($tabel, $colom_order, $colom_search, $order, $select)
    {
        
        $this->_get_datatables_query($tabel, $colom_order, $colom_search, $order, $select);
        return $this->db->count_all_results();
    }
 
    public function count_all($tabel)
    {
        $this->db->from($tabel);
        return $this->db->count_all_results();
    }

	
}

/* End of file M_dinamis.php */
/* Location: ./application/models/M_dinamis.php */