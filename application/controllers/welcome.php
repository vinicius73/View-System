<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->view->SetTemplate('default');
        $this->view->SetFooter('comum/footer');
        $this->view->SetHeader('comum/head');
    }

    public function index() {
        $this->view->SetTitle('$PageTitle', 'Simple View');
        $this->view->Load('page');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */