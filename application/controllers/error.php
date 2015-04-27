<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends CI_Controller
{
	public function index()
	{
        # This is default 404 Page
        $this->load->view('includes/header');
		$this->load->view('error/page_not_found');
		$this->load->view('includes/footer');
	}
}