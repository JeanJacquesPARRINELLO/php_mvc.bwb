<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 29/05/18
 * Time: 11:31
 */

namespace Dao;

use Core\DatabaseConnect;
use Models\EntityModel;

abstract class Dao implements CrudInterface, RepositoryInterface
{
    protected $pdo;
    protected $table;
    protected $modelObj;

    /**
     * Dao constructor.
     */
    public function __construct()
    {
        $this->pdo = DatabaseConnect::getInstance();
    }

    /*
     *      MÉTHODES PUBLIQUES
     */

    /**
     * @param array $aPropVal
     */
    public function create(array $aPropVal){
        $requete = $this->insert().$this->keys($aPropVal).$this->values($aPropVal);
        $req = $this->pdo->prepare($requete);
        $req->execute($aPropVal);

    }

    /**
     * @param EntityModel $oModelEntity
     * @return mixed
     */
    public function retrieve(EntityModel $oModelEntity){
        $this->modelObj = $oModelEntity;
        return $this->getById($this->modelObj->getId());

    }

    /**
     * @param array $aPropVal
     * @return bool
     */
    public function update(array $aPropVal){
//        vardump($aPropVal);
        $requete = $this->updateMysql().$this->set($aPropVal).$this->whereId();
//        vardump($requete);
        $req = $this->pdo->prepare($requete);

        return $req->execute($aPropVal);
    }

    /**
     * @param int $pId
     * @return bool
     */
    public function delete(int $pId){
        $requete = "DELETE FROM `" . $this->table . "` WHERE `id`=:id";
        $req = $this->pdo->prepare($requete);
        $req->bindValue(":id", $pId, \PDO::PARAM_INT);
        return $req->execute();
    }

    /**
     * @param EntityModel $oModelEntity
     * @return array
     */
    public function getAll(EntityModel $oModelEntity){
        $this->modelObj = $oModelEntity;
        $list = [];
        $req = $this->pdo->query("SELECT * FROM " . $this->table);
        $req->execute();

        foreach($req->fetchAll() as $data){
            $newEntity = clone $this->modelObj;
            $newEntity->hydrate($data);
            $list[] = $newEntity;
        }

        return $list;
    }

    /**
     * @param $pId
     * @return mixed
     */
    public function getById($pId){
        $requete = "SELECT * FROM " . $this->table . " WHERE id= :id" ;
        $req = $this->pdo->prepare($requete);
        $req->bindParam(':id', $pId, \PDO::PARAM_INT);
        $req->execute();
        return($req->fetch());
    }

    /*
     *      MÉTHODES PRIVÉES
     */

    /**
     * @return string
     */
    private function insert(){
        return "INSERT INTO " . $this->table;
    }

    /**
     * @param $pArray Tableau associant Clef => Valeur
     * @return bool|string
     */
    private function keys($pArray){
        $req = " (";
        foreach($pArray as $key => $value){
            $req.= $key . ", ";
        }
        $req =substr ( $req ,  0 , -2 );
        $req.= ") ";
        return $req;
    }

    /**
     * @param $pArray Tableau associant Clef => Valeur
     * @return bool|string
     */
    private function values($pArray){
        $req = " VALUES (";
        foreach($pArray as $key => $value){
            $req.= ":" . $key . ", ";
        }
        $req =substr ( $req ,  0 , -2 );
        $req.= ") ";
        return $req;
    }

    /**
     * @return string
     */
    private function updateMysql(){
        return "UPDATE " . $this->table;
    }

    /**
     * @param $pArray
     * @return string
     */
    private function set($pArray){
        $req = " SET ";

        foreach ($pArray as $key => $value){
            $req.= $key . "= :" . $key . ", ";
        }

        $req = rtrim($req, ", ");

        $req.= " ";

        return $req;
    }

    /**
     * @return string
     */
    private function whereId(){
        return " WHERE id=:id";
    }
}