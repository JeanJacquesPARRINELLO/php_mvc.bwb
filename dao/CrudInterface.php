<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 29/05/18
 * Time: 11:36
 */

namespace Dao;


interface CrudInterface
{
    public function retrieve();
    public function update();
    public function delete();
    public function create();
}