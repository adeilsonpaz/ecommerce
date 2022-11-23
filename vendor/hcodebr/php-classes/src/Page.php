<?php
namespace Hcode;
use Rain\Tpl;

class Page
{
    private $tpl;
    private $options = [];
    private $defaults = array(
        "data"=>[]
    );
    public function __construct($opts = array())
    {
        $this->options = array_merge($this->defaults,$opts);
        // config
        $config = array(
            "tpl_dir"       => $_SERVER["DOCUMENT_ROOT"]."/views/", //buscando onde essta o template
            "cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/", //precisa da pasta cache
            "debug"         => false, // set to false to improve the speed
        );

        Tpl::configure( $config );

        $this->tpl = new Tpl;
        $this->setData($this->options["data"]);
        //adicionando o topo da pagina
        $this->tpl->draw("header");

    }
    // funcao para receber dados
    private function setData($data = array())
    {        
        foreach($data as $key=>$value){
            $this->tpl->assign($key,$value);
        }
    }
        // funcao para adicionar o corpo ou conteudo da pagina
    public function setTpl($nome, $data=array(), $returnHTML = false)
    {
        $this->setData($data);
        return $this->tpl->draw($nome,$returnHTML);
    }

    public function __destruct()
    {
        //quando termina a função principal mostra o footer
        $this->tpl->draw("footer");
    }
}
?>