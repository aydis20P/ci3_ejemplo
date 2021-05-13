<?php
class Music_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
                //inicializamos la base de datos
                $this->inicializa();
                //$this->destruye();
                //$this->reinicia();
        }

        public function inicializa(){
                $query_str = 'CREATE TABLE IF NOT EXISTS usuario (
                        id serial PRIMARY KEY,
                        user_name varchar(128) NOT NULL UNIQUE
                );';
                $this->db->query($query_str);

                $news = $this->db->get('usuario');
                if (empty($news->result_array())){
                        for ($i=1; $i <= 3; $i++) { 
                                $data = array(
                                        'user_name' => 'Usuario'.$i,
                                );
                                echo 'traceback: entré a creación de usuario row'.$i.' rows affected: ', $this->db->insert('usuario', $data), '<br>';//insert regresa el número de rows afected
                        }                        
                }
                else{
                        foreach ($news->result_array() as $row){
                                foreach ($row as $key => $value) {
                                        echo $value, '&nbsp';                        
                                }
                                echo '<br>';
                        }
                }
        }

        public function destruye(){
                $query_str = 'DROP TABLE IF EXISTS usuario;';
                $this->db->query($query_str);
        }

        public function reinicia(){
                $this->destruye();
                $this->inicializa();
        }

        public function get_usuarios($slug = FALSE)
        {
                if ($slug === FALSE)
                {
                        $query = $this->db->get('usuario');
                        return $query->result_array();
                }

                $query = $this->db->get_where('usuario', array('user_name' => $slug));
                return $query->row_array();
        }
}
