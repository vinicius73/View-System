<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller {
    
    public function index() {
        //$this->load->view('welcome_message');
        $this->sVAR['teste'] = 'xxxx';
        $this->view->teste();
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */