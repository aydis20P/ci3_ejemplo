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
            // Verificamos que exitan el usuario y la cancion
            $query_usuario = $this->db->get_where('usuario', array('id'=>$usuario_id));
            $query_cancion = $this->db->get_where('usuario', array('id'=>$cancion_id));
            if(empty($query_usuario->result_array())||empty($query_cancion->result_array())){
                echo 'no exite el usuario o la canción...';
                return;
            }
            // Verificamos que el usuario tenga o no la canción en su playlist
            $query = $this->db->get_where('usuario_cancion', $data);
            if(!empty($query->result_array())){
                echo '¡El usuario ', $data['usuario_id'], ' ya tiene la cancion con id: ', $data['cancion_id'], ' en su playlist!';
            }
            // Si no la tiene, la agregamos
            else{
                echo $this->db->insert('usuario_cancion', $data);
            }
        }

        /**
         * Método para elimina el registro con id = $id de la tabla
         * usuario_cancion.
         */
        public function delete_usuario_cancion($id){
            $query = $this->db->get_where('usuario_cancion', array('id' => $id));
            if(empty($query->result_array())){
                echo 'el registro con id: ', $id, ' en usuario_cancion no exíste';
            }
            else{
                echo $this->db->delete('usuario_cancion', array('id' => $id));
            }
        }
}
