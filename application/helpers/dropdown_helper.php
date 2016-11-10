<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

function listData($sql) {
    $items = array();
    $CI =& get_instance();
    $query = $CI->db->query ($sql);
    return $query;


}

