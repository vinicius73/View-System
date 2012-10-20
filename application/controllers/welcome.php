<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * @author Vinicius <luiz.vinicius73@gmail.com>
 */

class Welcome extends CI_Controller {
    
    /*
     * @var $sVAR array()
     * Super Váriavel, váriavel que possuirá todos
     *    os dados que estarão disponiveis na view
     */
    public $sVAR = array();

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