<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 29/05/18
 * Time: 12:06
 */

namespace Models;


class Users
{
    private $id;
    private $pseudo;

    public function __construct($id, $pseudo)
    {
        $this->id = $id;
        $this->pseudo = $pseudo;
    }

    public function getId(){
        return $this->id;
    }

}