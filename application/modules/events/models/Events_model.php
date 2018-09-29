<?php
class Events_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

	function __get_events($faculty, $limit) {
		$sql = $this -> db -> query("SELECT * FROM events_tab WHERE estatus=1 AND efaculty=".$faculty." ORDER BY eid DESC LIMIT " . $limit, FALSE);
		return $sql -> result();
	}
}
