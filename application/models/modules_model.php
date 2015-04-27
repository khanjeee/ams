<?php

class Modules_Model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function getAllModules()
    {
        $result    =    array();

                        $this->db->select('module_id,title');
        $query      =   $this->db->get('modules');
        $result     =   $query->result_array();

        return $result;
    }
}
