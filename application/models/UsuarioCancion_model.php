<?php
class Usuariocancion_model extends CI_Model {

        public function __construct()
        {
            $this->load->database();
            $this->load->helper('queries');
        }

        /**
         * Método que regresa el registro de usuario_cancion 
         * con id = $slug
         */
        public function get_usuario_cancion_by_id($slug = FALSE)
        {
            return get_by($this->db, 'usuario_cancion', 'id', $slug);
        }

        /**
         * Método que regresa todos los registros de usuario_cancion
         */
        public function get_usuarios_cancion()
        {
            return get_by($this->db, 'usuario_cancion');
        }

        /**
         * Método que regresa los registros de usuario_cancion
         * asociados al usuario correspondiente
         */
        public function get_playlist_usuario($usuario_id){
            return get_by($this->db, 'usuario_cancion', 'usuario_id', $usuario_id);
        }

        /**
         * Método que crea un registro de usuario_cancion
         * asociado al usuario y cancion correspondientes
         */
        public function create_usuario_cancion($usuario_id, $cancion_id){
            $data = array(
                'usuario_id' => $usuario_id,
                'cancion_id' => $cancion_id 
            );
            return $this->db->insert('usuario_cancion', $data);
        }
}