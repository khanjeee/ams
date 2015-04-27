<?php

class State_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

  

    public function getStatesDropDown()
    {
        $this->db->select('state_code,state');
        $query = $this->db->get('states');
        return $query->result_array();
        
    }    
    
  
    
//    public function deletePackagById($sPackageId = array())
//    {
//        $data = array('is_deleted' => '1');
//        $this->db->where('package_id', $sPackageId);
//        $this->db->update('packages', $data);
//        return $this->db->affected_rows();
//    }
}
