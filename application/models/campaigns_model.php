<?php

/**
 * Created by PhpStorm.
 * User: Umair Ahmed
 * Date: 2/6/15
 * Time: 3:30 PM
 */
class Campaigns_Model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getPackageDetails($iPackageId = 0)
    {
        $this->db->select('role_id,title');
        $query = $this->db->get('roles');
        return $query->result_array();
    }


}