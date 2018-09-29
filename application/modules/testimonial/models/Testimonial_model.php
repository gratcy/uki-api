<?php
class Testimonial_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

	function __get_testimonial($faculty, $limit) {
		$sql = $this -> db -> query("SELECT * FROM testimonial_tab WHERE tstatus=1 AND tfaculty=".$faculty." ORDER BY tid DESC LIMIT " . $limit, FALSE);
		return $sql -> result();
	}
}
