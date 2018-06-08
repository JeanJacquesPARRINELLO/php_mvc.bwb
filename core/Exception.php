<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 08/06/18
 * Time: 10:42
 */

namespace Core;


class Exception extends Response
{
    protected $message;

    public function __construct($e)
    {
        parent::__construct("errorException.php");
        $this->title = "Erreur de l'application";
        $this->renderException($e->getMessage());
    }

    final public function renderException($message){
        ob_start();
        require_once $this->header;
        require_once $this->content;
        require_once $this->footer;
        ob_end_flush();
    }
}