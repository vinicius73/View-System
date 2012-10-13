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

    #Define Template

    public function SetTemplate($Template = NULL) {
        if (is_string($Template)) {
            $this->TEMPLATE = $Template . '/';
            $this->sVAR['TEMPLATE'] = $this->TEMPLATE;
        }
    }

    #Define View

    private function SetView($View, $Nome, $Extra = FALSE) {
        if (is_string($View) && is_string($Nome)) {
            if ($Extra) {
                $this->setView['Add'][$Nome] = $View;
            } else {
                $this->setView[$Nome] = $View;
            }
        }
    }

}