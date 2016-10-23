<?php
class Feeds_model extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }

    public function get_feeds()
    {
        $query = $this->db->get('feed', 10, 20);
        return $query->result_array();
    }
}
?>
