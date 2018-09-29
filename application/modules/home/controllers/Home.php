<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->output
	        ->set_status_header(200)
	        ->set_header('Content-Type: application/json; charset=utf-8')
	        ->set_content_type('application/json', 'utf-8')
	        ->set_output(json_encode(array('status' => 404, 'message' => 'Not found.'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
	        ->_display();
	    exit;
	}
}
