<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * @author Vinicius <luiz.vinicius73@gmail.com>
 */

class MY_Controller extends CI_Controller {
    
    /*
     * @var $sVAR array()
     * Super Váriavel, váriavel que possuirá todos
     *    os dados que estarão disponiveis na view
     */
    public $sVAR = array();

    public function __construct() {
        parent::__construct();
    }

}