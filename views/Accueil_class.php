<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 03/06/18
 * Time: 18:38
 */

namespace Views;

use Core\Response;


class Accueil_class extends Response
{
    protected $callback = "callback";
    protected $title = "Accueil du site";

    /**
     *      CALLBACK METHOD WHICH IS IMPLEMENTING IN EACH CHILD CLASS
     * @param $buffer
     * @return mixed
     */
    public function callback($buffer){
        vardump($this->title);
        return str_replace("{metaTitle}", $this->title . " et autre", $buffer);
    }

}