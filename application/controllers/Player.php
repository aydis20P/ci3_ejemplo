<?php
class Player extends CI_Controller {

    public function __construct(){
            parent::__construct();
    }

    public function index(){
            //code here
    }

    public function view(){
        $page = $this->uri->segment(2);
        $user_name = $this->uri->segment(3);
        
        if ( ! file_exists(APPPATH.'views/player/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }

        $data['user_name'] = $user_name;

        $this->load->view('templates/header', $data);
        $this->load->view('player/'.$page, $data);
        $this->load->view('templates/footer');
    }
}