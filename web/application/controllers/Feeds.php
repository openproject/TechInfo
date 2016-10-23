<?php
class Feeds extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('feeds_model');
        $this->load->helper('url_helper');
    }

    public function index()
    {
        $data['feeds'] = $this->feeds_model->get_feeds();

        $data['title'] = 'News archive';

        // $this->load->view('templates/header', $data);
        $this->load->view('feeds/index', $data);
        // $this->load->view('templates/footer');
    }

    // public function view($slug = NULL)
    // {
        // $data['news_item'] = $this->news_model->get_news($slug);
    // }
}
?>
