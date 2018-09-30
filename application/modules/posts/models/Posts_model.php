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

    function __get_posts($faculty, $cid, $notCid, $limit) {
    	$query = "";
    	if ($limit > 0) {
    		$query = " LIMIT " . $limit;
    	}

    	if ($cid)
			$sql = $this -> db -> query("SELECT a.*,b.cname,c.uname FROM posts_tab a LEFT JOIN categories_tab b ON a.pcid=b.cid LEFT JOIN users_tab c ON a.puid=c.uid WHERE a.pstatus=1 AND a.pfaculty=".$faculty." AND a.pcid=".$cid." ORDER BY a.pid DESC " . $query, FALSE);
		else
			$sql = $this -> db -> query("SELECT a.*,b.cname,c.uname FROM posts_tab a LEFT JOIN categories_tab b ON a.pcid=b.cid LEFT JOIN users_tab c ON a.puid=c.uid WHERE a.pstatus=1 AND a.pfaculty=".$faculty." AND a.pcid!=".$notCid." ORDER BY a.pid DESC " . $query, FALSE);
		return $sql -> result();
	}
}
