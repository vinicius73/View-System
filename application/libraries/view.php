<?php

/**
 *
 * @author luiz.vinicius73@gmail.com
 */
class View {

    protected $sVAR = array();
    private $CI;

    public function __construct() {
        $this->CI = &get_instance();
        $this->sVAR = &$this->CI->sVAR;
    }
    
    public function teste(){
        print_r($this->sVAR);
    }

}

?>
