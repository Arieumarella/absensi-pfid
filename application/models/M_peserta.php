<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_peserta extends CI_Model {

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
        if($this->input->post('event'))
        {
            $this->db->where('slug_event', $this->input->post('event'));
        }
        if($this->input->post('bidang'))
        {
            $this->db->where('tb_peserta.slug_bidang', $this->input->post('bidang'));
        }
        if($this->input->post('tanggAkhir'))
        {
            $tanggalAwal = $this->input->post('tanggalAwal');
            $tanggAkhir = $this->input->post('tanggAkhir');
            $field = 'tb_peserta.created_at';
            $this->db->where("$field BETWEEN '$tanggalAwal' AND '$tanggAkhir'");
        }
        $this->db->select($select);
        $this->db->from($tabel);
         $this->db->join('tb_event', 'tb_peserta.slug_event = tb_event.idx', 'INNER');
        $this->db->join('tb_bidang', 'tb_peserta.slug_bidang = tb_bidang.id_slug', 'INNER');
        $this->db->join('tb_provinsi', 'tb_peserta.slug_provinsi = tb_provinsi.id_slug', 'INNER');
        $this->db->join('tb_daerah', 'tb_peserta.slug_daerah  = tb_daerah.idx and tb_peserta.slug_provinsi=tb_daerah.id_provinsi', 'INNER');
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

/* End of file M_peserta.php */
/* Location: ./application/models/M_peserta.php */