<?php
class Slideshow_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function __get_slideshow($faculty, $limit) {
		$sql = $this -> db -> query("SELECT * FROM slideshow_tab WHERE sstatus=1 AND sfaculty=".$faculty." ORDER BY sid DESC LIMIT " . $limit, FALSE);
		return $sql -> result();
	}
}
