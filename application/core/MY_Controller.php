<?php
class MY_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function render($view, $data)
    {

        $data['pengaturan'] = getPengaturanWebsite();

        $this->load->view('inc/backend/head', $data);
        $this->load->view('inc/backend/side');
        $this->load->view('inc/backend/topbar');
        $this->load->view($view);
        $this->load->view('inc/backend/footer');
    }

    function view($view, $data, $inject_html = false)
    {
        $data['pengaturan'] = getPengaturanWebsite();

        $this->load->view('inc/frontend/header', $data);

        $this->load->view($view);
        $this->load->view('inc/frontend/footer');
    }
}
