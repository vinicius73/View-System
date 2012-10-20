<?php

/**
 * @author luiz.vinicius73@gmail.com
 */
class View {

    //Variavel das views
    protected $sVAR = array();
    #Metatags
    protected $MetaTags = array();
    #Titulo da Pagina
    protected $PageTitle = array('title' => 'TITULO DA SUA PÁGINA AQUI $PageTitle', 'desc' => NULL);
    #Views a serem carregadas
    protected $theView = array('HEADER' => 'comum/head', 'FOOTER' => 'comum/footer', 'PAGE' => NULL);
    #Template do Site
    private $TEMPLATE = NULL;
    # @var CodeIgiter
    private $CI;

    public function __construct() {
        #Instancia Objeto
        $this->CI = &get_instance();
        #sVAR
        $this->sVAR = &$this->CI->sVAR;
        $this->sVAR['PageTitle'] = $this->PageTitle['title'];
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
                $this->theView['Extra'][$Nome] = $View;
            } else {
                $this->theView[$Nome] = $View;
            }
        }
    }

    #Carrega a View

    public function Load($setPAGE = NULL) {
        //Define Pagina Principal
        $PAGE = (is_string($setPAGE)) ? $setPAGE : $this->theView['PAGE'];

        #Metodo Final
        if (method_exists($this->CI, '_Finaliza')) {
            $this->CI->_Finaliza();
        }

        #Se Pagina estiver Definida
        if (!empty($PAGE)) {
            $sVAR = $this->sVAR;
            $sVAR['HEADER'] = $this->CI->load->view($this->TEMPLATE . $this->theView['HEADER'], $this->sVAR, TRUE);
            $sVAR['FOOTER'] = $this->CI->load->view($this->TEMPLATE . $this->theView['FOOTER'], $this->sVAR, TRUE);
            #Views Adicionais
            if (isset($this->theView['Extra'])) {
                foreach ($this->theView['Extra'] as $Nome => $Valor) {
                    $sVAR[$Nome] = $this->CI->load->view($this->TEMPLATE . $Valor, $this->sVAR, TRUE);
                }
            }
            unset($this->sVAR, $this->theView);
            $this->CI->load->view($this->TEMPLATE . $PAGE, $sVAR);
        } else {
            show_404();
        }
    }

    public function SetTitle($Titulo = NULL, $Descricao = NULL) {
        #Titulo
        if (is_string($Titulo)) {
            $this->PageTitle['title'] = $Titulo;
        }

        #Descrição
        if (is_string($Descricao)) {
            $this->PageTitle['desc'] = $Descricao;
        }

        #Titulo da Página
        if (is_string($this->PageTitle['desc'])) {
            $this->sVAR['PageTitle'] = $this->PageTitle['title'] . ' &bull; ' . $this->PageTitle['desc'];
        } else {
            $this->sVAR['PageTitle'] = $this->PageTitle['title'];
        }
    }

}