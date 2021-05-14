<?php
class Startdb_model extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    public function inicializa(){
        $query_str = 'CREATE TABLE IF NOT EXISTS usuario (
                id serial PRIMARY KEY,
                user_name varchar(128) NOT NULL UNIQUE
        );';
        $this->db->query($query_str);

        $usuarios = $this->db->get('usuario');
        if (empty($usuarios->result_array())){
                for ($i=1; $i <= 3; $i++) { 
                        $data = array(
                                'user_name' => 'Usuario'.$i,
                        );
                        echo 'traceback: entré a creación de usuario row'.$i.' rows affected: ', $this->db->insert('usuario', $data), '<br>';//insert regresa el número de rows afected
                }                        
        }
        else{
                foreach ($usuarios->result_array() as $row){
                        foreach ($row as $key => $value) {
                                echo $value, '&nbsp';                        
                        }
                        echo '<br>';
                }
        }


        $query_str = 'CREATE TABLE IF NOT EXISTS cancion (
                id serial PRIMARY KEY,
                src varchar(128) NOT NULL UNIQUE,
                nombre varchar(128) NOT NULL UNIQUE,
                artista varchar(128) NOT NULL UNIQUE
        );';
        $this->db->query($query_str);

        $canciones = $this->db->get('cancion');
        if (empty($canciones->result_array())){
                $data = array(
                        'src' => 'http://ccmixter.org/content/airtone/airtone_-_blackSnow.mp3',
                        'nombre' => 'black snow',
                        'artista' => 'airtone'
                );
                echo 'Creación de cancnión test, ', ' rows affected: ', 
                        $this->db->insert('cancion', $data), 
                        '<br>';                     
        }
        else{
                foreach ($canciones->result_array() as $row){
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

            $query_str = 'DROP TABLE IF EXISTS cancion;';
            $this->db->query($query_str);
    }
    
    public function reinicia(){
            $this->destruye();
            $this->inicializa();
    }
}