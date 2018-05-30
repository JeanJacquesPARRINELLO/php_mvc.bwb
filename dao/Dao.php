<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 29/05/18
 * Time: 11:31
 */

namespace Dao;

use Core\Connexion;

abstract class Dao implements CrudInterface, RepositoryInterface
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = Connexion::getInstance();
    }
}