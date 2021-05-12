<?php
class News_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
                //inicializamos la base de datos
                $query = $this->inicializa();
                var_dump($query);
        }

        public function inicializa(){
                $query_str = 'CREATE TABLE IF NOT EXISTS news (
                        id serial PRIMARY KEY,
                        title varchar(128) NOT NULL,
                        slug varchar(128) NOT NULL,
                        text text NOT NULL
                );';
                return $this->db->query($query_str);

        }

        public function get_news($slug = FALSE)
        {
                if ($slug === FALSE)
                {
                        $query = $this->db->get('news');
                        return $query->result_array();
                }

                $query = $this->db->get_where('news', array('slug' => $slug));
                return $query->row_array();
        }
}
