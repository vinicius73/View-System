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

    #Adiciona View Extra

    public function AddView($View = NULL, $Nome = NULL) {
        $this->SetView($View, $Nome, TRUE);
    }

    #Define Header

    public function SetHeader($View = NULL) {
        $this->SetView($View, 'HEADER');
    }

    #Define Footer

    public function SetFooter($View = NULL) {
        $this->SetView($View, 'FOOTER');
    }

    #Define Pagina Principal

    public function SetMain($View = NULL) {
        $this->SetView($View, 'PAGE');
    }

    #Define View

    private function SetView($View, $Nome, $Extra = FALSE) {
        if (is_string($View) && is_string($Nome)) {
            if ($Extra) {
                $this->setView['Extra'][$Nome] = $View;
            } else {
                $this->setView[$Nome] = $View;
            }
        }
    }

}