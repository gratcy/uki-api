<?php
class Events_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

	function __get_events($faculty) {
		$sql = $this -> db -> query("SELECT a.*,b.uname FROM events_tab a LEFT JOIN users_tab b ON a.euid=b.uid WHERE a.estatus=1 AND a.efaculty=".$faculty." ORDER BY eid DESC", FALSE);
		return $sql -> result();
	}

    function __get_events_detail($faculty, $id) {
		$sql = $this -> db -> query("SELECT * FROM events_tab WHERE estatus=1 AND efaculty=".$faculty." AND eid=".$id, FALSE);
		return $sql -> result();
	}
}
