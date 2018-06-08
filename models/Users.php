<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 29/05/18
 * Time: 12:06
 */

namespace Models;

use Models\EntityModel;

class Users extends EntityModel
{
    public $id;
    public $pseudo = "";
    public $password = "";
    public $role_id;
    public $email = "";

    /**
     * Users constructor.
     * @param $id
     * @param $pseudo
     */

//    public function __construct()
//    {
//        parent::__construct(());
//    }

    public function __clone()
    {
    }

    /*
     *      GETTERS
     */

    /**
     * @return int
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPseudo(): string{
        return $this->pseudo;
    }

    /*
     *      SETTERS
     */

    /**
     * @param int $pId
     * @return void
     */
    public function setId($pId){

        // $pId est casté vers un type entier et s'il est plus grand que zéro, il est valide
        if (($pId = (int)$pId) > 0)
        {
            $this->id = $pId;
        }
    }

    public function setPseudo($pPseudo){
        if(is_string($pPseudo)){
            $this->pseudo = $pPseudo;
        }
    }

    public function setPassword($pPassword){
        if(is_string($pPassword)){
            $this->password = $pPassword;
        }
    }

    public function setRole_id($pRoleId){
        if (($pId = (int)$pRoleId) > 0)
        {
            $this->role_id = $pRoleId;
        }
    }

    public function setEmail($pEmail){
        if(is_string($pEmail)){
            $this->email = $pEmail;
        }
    }

    private function getAttList(): array {
        $aAttList = [];
        foreach ($this as $att => $value) {
            $aAttList[] = $att;
        }
        return $aAttList;
    }
}