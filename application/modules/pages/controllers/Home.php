<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> model('Pages_model');
	}

	public function index() {
		
	}

	public function detail($faculty, $id)
	{
		$data['data'] = $this -> Pages_model -> __get_pages_detail($faculty, $id);
		$this->output
	        ->set_status_header(200)
	        ->set_content_type('application/json', 'utf-8')
	        ->set_output(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
	        ->_display();
	    exit;
	}

	public function menus($faculty)
	{
		$menus = $this -> Pages_model -> __get_menus($faculty, 0);
		$data = [];
	    foreach ($menus as $key => $v) {
	        $childs = $this -> Pages_model -> __get_menus($faculty, $v -> pid);
	        if (count($childs) > 0) {
	            $data[$key] = ['pid' => $v -> pid, 'ptitle' => $v -> ptitle, 'pparent' => $v -> pparent, 'childs' => []];
	            foreach ($childs as $k1 => $v1) {
	            	$data[$key]['childs'][] = ['pid' => $v1 -> pid, 'ptitle' => $v1 -> ptitle, 'pparent' => $v1 -> pparent];
	            }
	        }
	        else {
	            $data[$key] = ['pid' => $v -> pid, 'ptitle' => $v -> ptitle, 'pparent' => $v -> pparent];
	        }
	    }

		$this->output
	        ->set_status_header(200)
	        ->set_content_type('application/json', 'utf-8')
	        ->set_output(json_encode(['data' => $data], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
	        ->_display();
	    exit;
	}
}
