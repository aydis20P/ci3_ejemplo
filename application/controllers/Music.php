<?php
class Music extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('music_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {
                //code here
        }
        public function playlist($slug = null)
        {
                echo 'estamos en playlist';
                //code here
        }
}
