<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 03/06/18
 * Time: 18:38
 */

namespace views;


class DeleteUserConfirmation_class extends Padviou
{
    protected $callback = "callback";
    protected $title = "Suppression d'un profil utilisateur";
    protected $oUser;

    /**
     *      CALLBACK METHOD WHICH IS IMPLEMENTING IN EACH CHILD CLASS
     * @param $buffer
     * @return mixed
     */
    public function callback($buffer){
        vardump($this->title);
        return str_replace("{metaTitle}", $this->title, $buffer);
    }

    public function setUser($poUser){
        $this->oUser = $poUser;
    }

}