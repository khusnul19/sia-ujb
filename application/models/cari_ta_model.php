<?php
class Cari_ta_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function search($keyword)
    {
        $this->db->like('nim', $keyword);
        $this->db->or_like('nama', $keyword);
        $this->db->or_like('departemen', $keyword);
        $this->db->or_like('program_studi', $keyword);
        $this->db->or_like('judul_ta', $keyword);
        $query  =   $this->db->query("SELECT pendataan_ta.id, pendataan_ta.nama, pendataan_ta.nim, pendataan_ta.departemen, pendataan_ta.program_studi, pendataan_ta.judul_ta, pendataan_ta.nama_dosbing1, pendataan_ta.nama_dosbing2, pendataan_ta.ket_ta, pendataan_ta.status_prodi, pendataan_ta.id_prodi  FROM pendataan_ta
        WHERE 
     pendataan_ta.status_prodi = '3'");
        return $query->result();
    }
}
