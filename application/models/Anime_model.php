<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Anime_model extends CI_Model {

    public $title;
    public $view;

    public function get_animes($searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('tbl_animes');
        if(!empty($searchText)) {
            $likeCriteria = "title  LIKE '%".$searchText."%'";
            $this->db->where($likeCriteria);
        }
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_animes_count($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('tbl_animes');
        if(!empty($searchText)) {
            $likeCriteria = "title  LIKE '%".$searchText."%'";
            $this->db->where($likeCriteria);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_anime_info($animeid)
    {
        $this->db->select('*');
        $this->db->from('tbl_animes');
        $this->db->where('animeid', $animeid);
        $query = $this->db->get();
        
        return $query->result();
    }

    function edit_anime($animeinfo, $animeid)
    {
        $this->db->where('animeid', $animeid);
        $this->db->update('tbl_animes', $animeinfo);
        
        return TRUE;
    }

    public function insert_entry()
    {
        $this->title    = $_POST['title']; // please read the below note
        $this->content  = $_POST['content'];

        $this->db->insert('entries', $this);
    }

    public function update_entry()
    {
        $this->title    = $_POST['title'];
        $this->content  = $_POST['content'];

        $this->db->update('entries', $this, array('id' => $_POST['id']));
    }

}