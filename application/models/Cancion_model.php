<?php
class Cancion_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
                $this->load->helper('queries');
        }

        /**
         * Método que regresa el registro de cancion 
         * con id = $slug
         */
        public function get_cancion_by_id($slug = FALSE)
        {
                return get_by($this->db, 'cancion', 'id', $slug);
        }

        /**
         * Método que regresa todos los registros de cancion
         */
        public function get_canciones()
        {
                return get_by($this->db, 'cancion');
        }
}