<?php
class Pages_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function __get_pages_detail($faculty, $id) {
		$sql = $this -> db -> query("SELECT * FROM pages_tab WHERE pstatus=1 AND pfaculty=".$faculty." AND pid=".$id, FALSE);
		return $sql -> result();
	}

    function __get_menus($faculty, $parent) {
		$sql = $this -> db -> query("SELECT pid,ptitle,pparent FROM pages_tab WHERE pstatus=1 AND pfaculty=".$faculty." AND pparent=".$parent." ORDER BY pid ASC", FALSE);
		return $sql -> result();
	}
}
