<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> model('Testimonial_model');
	}

	public function index($faculty)
	{
		$limit = (int) $this -> input -> get('limit');
		$data['data'] = $this -> Testimonial_model -> __get_testimonial($faculty, $limit);
		$this->output
	        ->set_status_header(200)
	        ->set_content_type('application/json', 'utf-8')
	        ->set_output(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
	        ->_display();
	    exit;
	}
}
