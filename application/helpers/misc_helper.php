<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function __get_livechat_url($type) {
    $CI =& get_instance();
    return $type === 1 ? $CI -> config -> config['livechat']['host'] : str_ireplace('/', '\/', $CI -> config -> config['livechat']['host']);
}

function __get_date($str, $type=1) {
	$str = strtotime($str);
	if ($type == 1) return date('d/m/Y', $str);
	elseif ($type == 2) return date('d ',$str).__get_month(date('m',$str)).date(' Y', $str);
	elseif ($type == 3) return date('d/m/Y H:i', $str);
	elseif ($type == 4) return date('d/m/Y H:i:s', $str);
    elseif ($type == 5) return date('d ',$str).__get_month(date('m',$str)).date(' Y H:i',$str);
    else return __get_day(date('Y-m-d', $str)) . ', ' . date('d/m/Y', $str);
}

function __get_upload_file($file, $type=1) {
    $CI =& get_instance();
    if (!$file) return '';
    if ($type == 1)
		return $CI -> config -> config['upload']['host'] . $CI -> config -> config['upload']['media']['path'] . $file;
	elseif ($type == 2)
		return $CI -> config -> config['upload']['host'] . $CI -> config -> config['upload']['gallery']['path'] . $file;
    elseif ($type == 3)
		return $CI -> config -> config['upload']['host'] . $CI -> config -> config['upload']['slideshow']['path'] . $file;
    elseif ($type == 4)
        return $CI -> config -> config['upload']['host'] . $CI -> config -> config['upload']['testimonial']['path'] . $file;
    else
        return $CI -> config -> config['upload']['host'] . $CI -> config -> config['upload']['events']['path'] . $file;
}

function __get_month($date) {
    $date = (int) date('m', strtotime($date));
    $arr = array('Januari', 'Febuari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
    return $arr[$date];
}

function __get_day($date) {
    $date = (int) date('w', strtotime($date));
    $arr = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
    return $arr[$date];
}

function __get_menus() {
    $CI =& get_instance();
    $CI -> load -> model('home/Home_model');
    $menus = $CI -> Home_model -> __get_menus($CI -> config -> config['faculty'], 0);
    $res = '';
    foreach ($menus as $key => $v) {
        $res .= '<li class="dropdown">';
        $childs = $CI -> Home_model -> __get_menus($CI -> config -> config['faculty'], $v -> pid);
        if (count($childs) > 0) {
            $res .= '<a href="#">'.strtoupper($v -> ptitle).'<span></span></a>';
            $res .= '<ul class="dropdown-menu dropdown-menu-left">';
            foreach ($childs as $k1 => $v1) {
                $res .= '<li>';
                $res .= '<a href="'.base_url('page/' . $v1 -> pid).'">'.$v1 -> ptitle.'</a>';
                $res .= '</li>';
            }
            $res .= '</ul>';
        }
        else {
            $res .= '<a href="'.base_url('page/' . $v -> pid).'">'.strtoupper($v -> ptitle).'<span></span></a>';
        }
        $res .= '</li>';
    }
    return $res;
}

function __get_last_posts() {
    $CI =& get_instance();
    $CI -> load -> model('home/Home_model');
    $posts = $CI -> Home_model -> __get_last_posts($CI -> config -> config['faculty'], $CI -> config -> config['category']['announcement'], 2);
    return $posts;
}

function __grep_image_url($html) {
    preg_match_all("/src=[\"\']?([^\"\']?.*(png|jpg|gif))[\"\']?/i",$html, $result);
    if (!empty($result[1][0])) return $result[1][0];
}

function __limit_word($text, $limit) {
    $text = strip_tags($text);
    $strings = $text;
    if (strlen($text) > $limit) {
        $words = str_word_count($text, 2);
        $pos = array_keys($words);
        if(sizeof($pos) > $limit) {
            $text = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }
    return $text;
}

function __get_image_url($text) {
    preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $text, $result);
    return isset($result[1]) ? $result[1] : '';
}