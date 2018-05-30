<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 29/05/18
 * Time: 23:53
 */

namespace Controllers;


class UsersController
{
    public static function getAll()
    {
        echo "public static function getAll dans UsersController";
    }
    public static function getById()
    {
        echo "public static function getById dans UsersController";
    }

    public  static function create(){
        echo "public static function create dans UsersController";
    }

    public  static function delete(){
        echo "public static function delete dans UsersController";
    }

    public  static function update(){
        echo "public static function update dans UsersController";
    }

    public  static function deleteAll(){
        echo "public static function deleteAll dans UsersController";
    }

}