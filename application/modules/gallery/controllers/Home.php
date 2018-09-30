<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> model('Gallery_model');
	}

	public function index($faculty)
	{
		$category = $this -> Gallery_model -> __get_category_gallery($faculty);
		$response = array();
		foreach ($category as $k => $v) :
			$response[$v -> cid] = array('cid' => $v -> cid, 'cname' => $v -> cname);
			$data = $this -> Gallery_model -> __get_gallery($faculty, $v -> cid);
			foreach($data as $k1 => $v1) :
				$response[$v -> cid]['gallery'][] = array('gtitle' => $v1 -> gtitle, 'gfile' => $v1 -> gfile, 'gcontent' => $v1 -> gcontent);
			endforeach;
		endforeach;

		$res = array();
		foreach ($response as $key => $value) {
			$res[] = $value;
		}

		$data = array('data' => $res);

		$this->output
	        ->set_status_header(200)
	        ->set_content_type('application/json', 'utf-8')
	        ->set_output(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
	        ->_display();
	    exit;
	}
}
