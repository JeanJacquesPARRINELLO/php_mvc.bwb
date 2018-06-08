<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 06/06/18
 * Time: 21:20
 */

namespace Core;

trait Utilities
{

    /**
     *      SEARCHING FOR VIEWS FILES IN VIEWS'S SUBFOLDERS
     * @param $pFileName VIEW.FILE TO FIND
     * @return string
     */
    private function lycos($pFileName, $pRoot){
//        vardump($pFileName);
        $paths = $this->rFindPaths($pRoot);
        $file = "";
        foreach ($paths as $pos => $folder){
            if(is_dir($pRoot . $paths[$pos]) || $folder !== "." || $folder !== ".."){
                if(file_exists( $paths[$pos] . $pFileName) && is_readable($paths[$pos] . $pFileName)){
//        vardump($paths[$pos] . $pFileName);
                    $file = $paths[$pos] . $pFileName;
//                    vardump($file . " on line => " . __LINE__);
                }
            }
        }
        return($file);
    }

    /**
     * @param $pRoot    FOLDER TO SEARCH PATHS IN
     * @return array    LINEAR ARRAY WITH ALL PATHS IN ROOT/VIEWS
     */
    private function rFindPaths($pRoot){
        $pRoot = rtrim($pRoot, "/") . "/";

        $aPaths = [];
        $aFolders = scandir($pRoot);

        //  ARRAY OF PATHS' ARRAY
        foreach ($aFolders as $pos => $folder){

            if(is_dir($pRoot . $aFolders[$pos]) && $folder != "." && $folder != ".."){
                if(!empty($pRoot . $aFolders[$pos])){
                    $aPaths[] = $pRoot . $aFolders[$pos] . "/";
                }
                $aPaths[] = $this->rFindPaths($pRoot . $aFolders[$pos] . "/");
            }
        }
        //  ARRAY OF ARRAYS TO LINEAR ARRAY
        //  TEMP LINEAR ARRAY INIT
        $laPath = [];
        foreach ($aPaths as $paths){
            if(is_array($paths)){
                foreach ($paths as $path){
                    $laPath[] = $path;
                }
            }else{
                $laPath[] = $paths;
            }
        }
        return($laPath);
    }

}