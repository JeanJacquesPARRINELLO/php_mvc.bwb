<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 01/06/18
 * Time: 19:02
 */

namespace Core;


define("DEFAULT_HEADER" , "defaultHeader.php");
define("DEFAULT_FOOTER" , "defaultFooter.php");

class Response
{

    use Utilities;

    /**
     * @param string $content
     */
    public $content;
    public $header;
    public $footer;
    protected $title;
    /**
     * @var array
     */
    private $aoDatas;

    public function __construct(string $content, array $aoDatas = null, string $header = null, string $footer = null)
    {
        //  INIT PROPERTIES FOR DIFFERENTS DOCUMENT'S PARTS

        //  HEADER
        if($header === null){
            $this->header = $this->lycos(DEFAULT_HEADER, ROOT . "views/");
        }else{
            $this->header = $this->lycos($header,ROOT . "views/");
        }

        //  CONTENT
        $this->content = $this->lycos($content,ROOT . "views/");

        //  FOOTER
        if($footer === null){
            $this->footer = $this->lycos(DEFAULT_FOOTER, ROOT . "views/");
        }else{
            $this->footer = $this->lycos($footer, ROOT . "views/");
        }

        //  DATAS FROM DAO
        $this->aoDatas = $aoDatas;
    }

    /**
     *
     */
    final public function Render(){

        //  DATAS TO DISPLAY
        if($this->aoDatas !== null)
            foreach ($this->aoDatas as $entity => $obj){
               $$entity = $obj;
            }

        ob_start();
        //  renderHeader
        require_once $this->header;
        //  renderContent
        require_once $this->content;
        //  renderFooter
        require_once $this->footer;
        ob_end_flush();
    }

    public function setTitle($pTitle){
        $this->title = $pTitle;
    }
}