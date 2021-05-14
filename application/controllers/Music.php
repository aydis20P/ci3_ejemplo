<?php
class Music extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('usuario_model');
                $this->load->model('cancion_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {
                //code here
        }

        public function get_usuario()
        {
                echo 'estamos en Music<br>';
                $id = $this->uri->segment(3);//obtenemos el id desde la URI (segmentos divididos por /)

                $usuario = $this->usuario_model->get_usuario_by_id($id);
                if(! empty($usuario)){
                        foreach($usuario as $col => $val){
                                echo 'col: ', $col, ', val: ', $val, '<br>';
                        }
                }
                else{
                        echo 'No se encontró al usuario con id: ', $id;
                }
        }

        public function get_usuarios()
        {
                echo 'estamos en Music<br>';

                $usuarios = $this->usuario_model->get_usuarios();
                if(! empty($usuarios)){
                        foreach($usuarios as $col => $val){
                                foreach ($val as $field => $data) {
                                        echo 'col: ', $field, ', val: ', $data, '<br>';
                                } 
                        }
                }
                else{
                        echo 'No hay usuarios en la DB';
                }
        }

        public function get_cancion($id = NULL)
        {
                echo 'estamos en Music<br>';
                
                $cancion = $this->cancion_model->get_cancion_by_id($id);
                if(! empty($cancion)){
                        foreach($cancion as $col => $val){
                                echo 'col: ', $col, ', val: ', $val, '<br>';
                        }
                }
                else{
                        echo 'No se encontró al cancion con id: ', $id;
                }
        }

        public function get_canciones()
        {
                $canciones = $this->cancion_model->get_canciones();
                if(! empty($canciones)){
                        $encoded_canciones = json_encode($canciones);
                        echo $encoded_canciones;
                        $canciones = json_decode($encoded_canciones);
                        foreach($canciones as $col => $val){
                                foreach ($val as $field => $data) {
                                        echo 'col: ', $field, ', val: ', $data, '<br>';
                                }                                
                        }
                }
                else{
                        echo 'No hay canciones en la DB';
                }
        }
}
