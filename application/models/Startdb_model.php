<?php
class Startdb_model extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    /**
     * Método para inicializar una base de datos de pruebas
     */
    public function inicializa(){
        // Creamos la tabla usuario y 3 registros en ella
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

        // Creamos la tabla cancion y 3 registros en ella
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
                echo 'Creación de canción test, ', ' rows affected: ', 
                        $this->db->insert('cancion', $data), 
                        '<br>';

                $data = array(
                        'src' => 'http://ccmixter.org/content/djlang59/djlang59_-_Peace_and_Blessings.mp3',
                        'nombre' => 'peace and blessings',
                        'artista' => 'djlang59'
                );
                echo 'Creación de canción test, ', ' rows affected: ', 
                        $this->db->insert('cancion', $data), 
                        '<br>';

                $data = array(
                        'src' => 'http://ccmixter.org/content/acrylicbathhouse/acrylicbathhouse_-_Resonance.mp3',
                        'nombre' => 'resonance',
                        'artista' => 'acrylicbathhouse'
                );
                echo 'Creación de canción test, ', ' rows affected: ', 
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

        // Creamos la tabla usuario_cancion y 3 registros en ella
        $query_str = 'CREATE TABLE IF NOT EXISTS usuario_cancion (
                id serial PRIMARY KEY,
                usuario_id int NOT NULL,
                cancion_id int NOT NULL,
                FOREIGN KEY (usuario_id) REFERENCES usuario(id),
                FOREIGN KEY (cancion_id) REFERENCES cancion(id)
              );';
        $this->db->query($query_str);

        $usuarios_cancion = $this->db->get('usuario_cancion');
        if (empty($usuarios_cancion->result_array())){
                $data = array(
                        'usuario_id' => 1,
                        'cancion_id' => 1
                );
                echo 'traceback: entré a creación de usuario_cancion row: ', 1, ' rows affected: ', 
                        $this->db->insert('usuario_cancion', $data), 
                        '<br>';
                $data = array(
                        'usuario_id' => 1,
                        'cancion_id' => 2
                );
                echo 'traceback: entré a creación de usuario_cancion row: ', 1, ' rows affected: ', 
                        $this->db->insert('usuario_cancion', $data), 
                        '<br>';
                $data = array(
                        'usuario_id' => 3,
                        'cancion_id' => 1
                );
                echo 'traceback: entré a creación de usuario_cancion row: ', 1, ' rows affected: ', 
                        $this->db->insert('usuario_cancion', $data), 
                        '<br>';
        }
        else{
                foreach ($usuarios_cancion->result_array() as $row){
                        foreach ($row as $key => $value) {
                                echo $value, '&nbsp';                        
                        }
                        echo '<br>';
                }
        }
    }

    /**
     * Método para destruir las tablas de la base de datos de prueba
     */
    public function destruye(){
        $query_str = 'DROP TABLE IF EXISTS usuario_cancion;';
        $this->db->query($query_str);

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