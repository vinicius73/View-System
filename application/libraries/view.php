<?php

/**
 * @author luiz.vinicius73@gmail.com
 */
class View {
    #Variavel das views

    protected $sVAR = array();
    #Views a serem carregadas
    protected $setView = array('HEADER' => 'comum/head', 'FOOTER' => 'comum/footer', 'PAGE' => NULL);
    #Template do Site
    private $TEMPLATE = NULL;
    # @var CodeIgiter
    private $CI;

    public function __construct() {
        #Instancia Objeto
        $this->CI = &get_instance();
        #sVAR
        $this->sVAR = &$this->CI->sVAR;
    }

}