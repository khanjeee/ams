<?php

/**
 * Created by PhpStorm.
 * User: Umair Ahmed
 * Date: 3/13/15
 * Time: 2:55 PM
 */

class Crons extends CI_Controller
{
    public $Cron;

    public function __construct()
    {
        parent::__construct();
        $this->controller  	= strtolower(__CLASS__);
        $this->Cron = new ApiCrons();
    }

    public function manage_cutoff()
    {
        $data['result']     = $this->Cron->SettleCuttOffBatches();
        $this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.__FUNCTION__,$data);
    }
}

