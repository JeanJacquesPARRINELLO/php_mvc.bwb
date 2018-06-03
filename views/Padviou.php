<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 01/06/18
 * Time: 19:02
 */

namespace views;

define("DEFAULT_HEADER" , "defaultHeader.php");
define("DEFAULT_FOOTER" , "defaultFooter.php");

class Padviou
{

    protected $callback = "callback";
    /**
     * @param string $content
     */
    public $content;
    public $header;
    public $footer;
    protected $title;

    public function __construct(string $content, string $header = null, string $footer = null)
    {
        //  INIT PROPERTIES FOR DIFFERENTS DOCUMENT'S PARTS

        //  HEADER
        if($header === null){
            $this->header = $this->lycos(DEFAULT_HEADER);
        }else{
            $this->header = $this->lycos($header);
        }

        //  CONTENT
        $this->content = $this->lycos($content);

        //  FOOTER
        if($footer === null){
            $this->footer = $this->lycos(DEFAULT_FOOTER);
        }else{
            $this->footer = $this->lycos($footer);
        }
    }

    /**
     * @param null $callbackFunction Pour mettre à jour la vue avant envoi si nécessaire
     */
    public function Render(){

//        vardump($this->header);
//        vardump($this->content);
//        vardump($this->footer);

        ob_start(array($this, $this->callback));

        //  renderHeader
        echo file_get_contents($this->header);
//        require_once $this->header;

        //  renderContent
//        echo file_get_contents($this->content);
        require_once $this->content;

        //  renderFooter
        echo file_get_contents($this->footer);
//        require_once $this->footer;

        ob_end_flush();
    }

    /**
     *      CALLBACK METHOD WHICH IS GOING TO BE SURCHARGED IN CHILDS CLASS
     */
    public function callback($buffer){
        return str_replace("{metaTitle}", $this->title, $buffer);
    }

    public function setTitle($pTitle){
        $this->title = $pTitle;
    }

    /*
     *      PRIVATES METHODS
     */

    /**
     *      THIS IS THE DEFAULT CALLBACK METHOD DOING NOTHING
     */
    private function cmdn($buffer){
        return $buffer;
    }


    /**
     *      SEARCHING FOR VIEWS FILES IN VIEWS'S SUBFOLDERS
     * @param $pFileName VIEW.FILE TO FIND
     * @return string
     */
    private function lycos($pFileName){
        $rootViews = ROOT . "views/";
        $paths = $this->recursiveFindPaths($rootViews);
        $file = "";
        foreach ($paths as $pos => $folder){
            if(is_dir($rootViews . $paths[$pos]) || $folder !== "." || $folder !== ".."){
                if(file_exists( $paths[$pos] . $pFileName) && is_readable($paths[$pos] . $pFileName)){
                    $file = $paths[$pos] . $pFileName;
//                    vardump($file . " on line => " . __LINE__);
                }
            }
        }
        return($file);
    }

    /**
     * @param $pRoot    FOLDER TO SEARCH PATHS IN
     * @return array    LINEAR ARRAY WITH ALL PATHS IN ROOT/VIEWS
     */
    private function recursiveFindPaths($pRoot){
        $aPaths = [];
        $aFolders = scandir($pRoot);

        //  ARRAY OF PATHS' ARRAY
        foreach ($aFolders as $pos => $folder){

            if(is_dir($pRoot . $aFolders[$pos]) && $folder != "." && $folder != ".."){
                if(!empty($pRoot . $aFolders[$pos])){
                    $aPaths[] = $pRoot . $aFolders[$pos] . "/";
                }
                $aPaths[] = $this->recursiveFindPaths($pRoot . $aFolders[$pos] . "/");
            }
        }

        //  ARRAY OF ARRAYS TO LINEAR ARRAY
        //  TEMP LINEAR ARRAY INIT
        $laPath = [];
        foreach ($aPaths as $paths){
            if(is_array($paths)){
                foreach ($paths as $path){
                    $laPath[] = $path;
                }
            }else{
                $laPath[] = $paths;
            }
        }
        return($laPath);
    }
}