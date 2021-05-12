<?php
class News extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('news_model');
                $this->load->helper('url_helper');
        }

        public function index()
{
        $data['news'] = $this->news_model->get_news();
        $data['title'] = 'News archive';

        var_dump($data);
        //$this->load->view('news/index', $data);
}

        public function view($slug = NULL)
{
        $data['news_item'] = $this->news_model->get_news($slug);

        if (empty($data['news_item']))
        {
                echo "nada que ver (Sí consulté la db)";
        }

        $data['title'] = $data['news_item']['title'];

        $this->load->view('news/view', $data);
}
}
