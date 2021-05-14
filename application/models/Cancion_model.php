<?php
class Cancion_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
                $this->load->helper('queries');
        }

        public function get_cancion_by_id($slug = FALSE)
        {
                return get_by($this->db, 'cancion', 'id', $slug);
        }

        public function get_canciones()
        {
                return get_by($this->db, 'cancion');
        }
}