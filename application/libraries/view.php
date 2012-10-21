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
    #Bases Assets
    /*
     * assets/
     * assets/css/
     * assets/js/
     * assets/img/
     */
    public $Assets = array('BASE' => 'assets/', 'CSS' => 'assets/css/', 'JS' => 'assets/js/', 'IMG' => 'assets/img/');
    #HeadAdd
    #AddFooter
    protected $AddHead = array(), $AddFooter = array();
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
        $this->_preLoad();

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
    
    private function _preLoad(){
        $this->sVAR['HeadTags'] = implode(PHP_EOL, $this->AddHead);
        $this->sVAR['FooterTags'] = implode(PHP_EOL, $this->AddHead);
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

    /*
     * metatags, css, favicon e javascript
     * head e footer
     */

    #AddCSS

    public function AddCSS($Item = NULL, $Local = 'head') {
        #Verifica tipo de váriavel/$Item
        if (is_string($Item)) {
            $this->AddToAssets($Item, 'css', $Local);
        } else if (is_array($Item)) {
            foreach ($Item as $Valor) {
                $this->AddToAssets($Valor, 'css', $Local);
            }
        }
    }

    #AddJS

    public function AddJS($Item = NULL, $Local = 'footer') {
        #Verifica tipo de váriavel/$Item
        if (is_string($Item)) {
            $this->AddToAssets($Item, 'js', $Local);
        } else if (is_array($Item)) {
            foreach ($Item as $Valor) {
                $this->AddToAssets($Valor, 'js', $Local);
            }
        }
    }

    #AddMeta

    public function AddMeta($Item = NULL, $Local = 'footer') {
        #Verifica tipo de váriavel/$Item
        if (is_array($Item)) {
            $this->AddToAssets($Item, 'js', $Local);
        }
    }

    private function AddToAssets($Item, $Tipo, $Local) {
        #Verifica tipo de elemento
        switch ($Tipo) {
            #Link CSS link_tag('favicon.ico', 'shortcut icon', 'image/ico');
            case 'css':
                $Elemento = link_tag($this->Assets['CSS']. $Item);
                break;
            #Javascript
            case 'js':
                $Elemento = script_tag($this->Assets['js']. $Item);
                break;
            #metatag
            case 'meta':
                $Elemento = meta($Item);
                break;
            case 'favicon':
                $Elemento = link_tag($Item, 'shortcut icon', 'image/ico');
                break;
            default:
                $Elemento = NULL;
                break;
        }
        #Local do elemento
        if (!empty($Elemento)) {
            if ($Local == 'head') {
                $this->AddHead[] = $Elemento;
            } else if ($Local == 'footer') {
                $this->AddFooter[] = $Elemento;
            }
        }
    }

}