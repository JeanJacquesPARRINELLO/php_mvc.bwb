<?php

namespace Models;

//use Dao\DaoUsers;

abstract class EntityModel implements Persistable 
{
    protected $dao;
    
    public function __construct() {
        $childClass = explode("\\", get_class($this));
        $childClass = end($childClass);
        $daoToLoad = "Dao\Dao".ucfirst($childClass);
        $this->dao = new $daoToLoad();
    }


    public function load() {
        $result = $this->dao->retrieve($this);
        $this->hydrate($result);
        return $this;
    }
    
    public function update() {
        if($this->getId() == null){
            $this->dao->create($_POST);
        }else{
            $this->dao->update($_POST);
        }
    }
    
    public function remove() {
        $this->dao->delete($this->getId());
    }
    
    public function getAll(){
        return $this->dao->getAll($this);
    }
    
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }
}