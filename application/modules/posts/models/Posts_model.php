<?php
class Posts_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function __get_posts_detail($faculty, $id) {
		$sql = $this -> db -> query("SELECT a.*,b.cname,c.uname FROM posts_tab a LEFT JOIN categories_tab b ON a.pcid=b.cid LEFT JOIN users_tab c ON a.puid=c.uid WHERE a.pstatus=1 AND a.pfaculty=".$faculty." AND a.pid=".$id, FALSE);
		return $sql -> result();
	}

    function __get_posts_categories($faculty, $cid, $notCid) {
    	if ($cid)
			$sql = $this -> db -> query("SELECT a.*,b.cname,c.uname FROM posts_tab a LEFT JOIN categories_tab b ON a.pcid=b.cid LEFT JOIN users_tab c ON a.puid=c.uid WHERE a.pstatus=1 AND a.pfaculty=".$faculty." AND a.pcid=".$cid, FALSE);
		else
			$sql = $this -> db -> query("SELECT a.*,b.cname,c.uname FROM posts_tab a LEFT JOIN categories_tab b ON a.pcid=b.cid LEFT JOIN users_tab c ON a.puid=c.uid WHERE a.pstatus=1 AND a.pfaculty=".$faculty." AND a.pcid!=".$notCid, FALSE);
		return $sql -> result();
	}
	
	function __get_last_category($faculty, $cid, $limit) {
		$sql = $this -> db -> query("SELECT * FROM posts_tab WHERE pstatus=1 AND pfaculty=".$faculty." AND pcid=".$cid." ORDER BY pid DESC LIMIT " . $limit, FALSE);
		return $sql -> result();
	}
}
