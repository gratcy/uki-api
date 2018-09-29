<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> model('Posts_model');
	}

	public function index($faculty) {
		if (!$id) redirect(base_url());
		$category = (int) $this -> input -> get('category');
		$notCategory = (int) $this -> input -> get('notCategory');
		$data['data'] = $this -> Posts_model -> __get_posts_categories($faculty, $category, $notCategory);
		$this->output
	        ->set_status_header(200)
	        ->set_content_type('application/json', 'utf-8')
	        ->set_output(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
	        ->_display();
	    exit;
	}

	public function detail($faculty, $id)
	{
		if (!$id) redirect(base_url());
		$data['data'] = $this -> Posts_model -> __get_posts_detail($faculty, $id);
		$this->output
	        ->set_status_header(200)
	        ->set_content_type('application/json', 'utf-8')
	        ->set_output(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
	        ->_display();
	    exit;
	}

	public public function posts($faculty)
	{
		$category = (int) $this -> input -> get('category');
		$limit = (int) $this -> input -> get('limit');
		$data['data'] = $this -> Posts_model -> __get_last_category($faculty, $category, $limit);
		$this->output
	        ->set_status_header(200)
	        ->set_content_type('application/json', 'utf-8')
	        ->set_output(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
	        ->_display();
	    exit;
	}
}
