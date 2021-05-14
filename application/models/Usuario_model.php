<?php
class Usuario_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
                $this->load->helper('queries');
        }

        /**
         * Método que regresa el registro de usuario 
         * con id = $slug
         */
        public function get_usuario_by_id($slug = FALSE)
        {
                return get_by($this->db, 'usuario', 'id', $slug);
        }

        /**
         * Método que regresa todos los registros de usuario
         */
        public function get_usuarios()
        {
                return get_by($this->db, 'usuario');
        }
}
