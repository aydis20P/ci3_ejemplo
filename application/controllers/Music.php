<?php
class Music extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('usuario_model');
                $this->load->model('cancion_model');
                $this->load->model('usuariocancion_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {
                //code here
        }

        public function get_usuario()
        {
                $id = $this->uri->segment(3);//obtenemos el id desde la URI (segmentos divididos por /)

                $usuario = $this->usuario_model->get_usuario_by_id($id);
                if(! empty($usuario)){
                        echo json_encode($usuario);
                }
                else{
                        echo 'No se encontró al usuario con id: ', $id;
                }
        }

        public function get_usuarios()
        {
                $usuarios = $this->usuario_model->get_usuarios();
                if(! empty($usuarios)){
                        echo json_encode($usuarios);
                }
                else{
                        echo 'No hay usuarios en la DB';
                }
        }

        public function get_cancion($id = NULL)
        {                
                $cancion = $this->cancion_model->get_cancion_by_id($id);
                if(! empty($cancion)){
                        echo json_encode($cancion); 
                }
                else{
                        echo 'No se encontró al cancion con id: ', $id;
                }
        }

        public function get_canciones()
        {
                $canciones = $this->cancion_model->get_canciones();
                if(! empty($canciones)){
                        echo json_encode($canciones);                         
                }
                else{
                        echo 'No hay canciones en la DB';
                }
        }

        public function get_usuario_cancion($id = NULL)
        {                
                $usuario_cancion = $this->usuariocancion_model->get_usuario_cancion_by_id($id);
                if(! empty($usuario_cancion)){
                        echo json_encode($usuario_cancion); 
                }
                else{
                        echo 'No se encontró al cancion con id: ', $id;
                }
        }

        public function get_usuarios_cancion()
        {
                $usuarios_cancion = $this->usuariocancion_model->get_usuarios_cancion();
                if(! empty($usuarios_cancion)){
                        echo json_encode($usuarios_cancion);                         
                }
                else{
                        echo 'No hay usuarios_cancion en la DB';
                }
        }

        public function get_playlist_usuario($usuario_id){
                $playlist = $this->usuariocancion_model->get_playlist_usuario($usuario_id);
                if(! empty($playlist)){
                        echo json_encode($playlist);                         
                }
                else{
                        echo 'No hay usuarios_cancion asociados al usuario con id: ', $usuario_id, 'en la DB';
                }
        }

        public function create_usuario_cancion(){
                $this->load->library('form_validation');

                if(!empty(file_get_contents('php://input'))){// "php://input" es un flujo de sólo lectura que permite leer datos del cuerpo solicitado
                        //Haciendo la petición en postman enviando un objeto json en el body
                        $json_obj = file_get_contents('php://input');
                        $obj = json_decode($json_obj);//parseamos el string que representa un objeto json a un objeto php
                        if (!empty($obj->usuario_id) && !empty($obj->cancion_id)){//validación de campos requeridos
                                return $this->usuariocancion_model->create_usuario_cancion($obj->usuario_id, $obj->cancion_id);
                        }
                        else{
                                echo 'usuario_id y cancion_id requeridos';
                        }
                }            
                else{
                        $this->form_validation->set_rules('usuario_id', 'usuario_id', 'required');
                        $this->form_validation->set_rules('cancion_id', 'cancion_id', 'required');
                        if ($this->form_validation->run() === FALSE){//validación de campos requeridos
                                echo 'usuario_id y cancion_id requeridos';
                        }
                        else{
                                //haciendo la petición mediante el uso del fomulario
                                $usuario_id = $this->input->post('usuario_id');
                                $cancion_id = $this->input->post('cancion_id');
                                return $this->usuariocancion_model->create_usuario_cancion($usuario_id, $cancion_id);
                        }
                }
        }
}
