<?php
class Start extends CI_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('startdb_model');
        }

        public function index()
        {
            $this->startdb_model->inicializa();
        }

        public function destruye(){
            $this->startdb_model->destruye();
        }

        public function reinicia(){
            $this->startdb_model->reinicia();
        }
}