<?php
class Gallery_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function __get_gallery($faculty, $category) {
		$sql = $this -> db -> query("SELECT * FROM gallery_tab WHERE gstatus=1 AND gfaculty=".$faculty." AND gcid=".$category." ORDER BY gid DESC", FALSE);
		return $sql -> result();
	}

    function __get_category_gallery($faculty) {
		$sql = $this -> db -> query("SELECT * FROM categories_tab WHERE cstatus=1 AND cfaculty=".$faculty." AND ctype=2 ORDER BY cid DESC", FALSE);
		return $sql -> result();
	}
}
