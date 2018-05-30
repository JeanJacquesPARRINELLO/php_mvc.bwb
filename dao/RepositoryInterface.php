<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 29/05/18
 * Time: 11:36
 */

namespace Dao;


interface RepositoryInterface
{
    public function getAll();
    public function getAllBy(array $pArray);
}