<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 28/05/18
 * Time: 11:29
 */

namespace Core;


abstract class Controller
{

    /**
     * @var array
     */
    private $get;
    /**
     * @var array
     */
    private $post;
    /**
     * @var array
     */
    private $uri;

    public function __construct(array $get = null, array $post = null, string $uri = null)
    {
        $this->get = $get;
        $this->post = $post;
        $this->uri = $uri;
    }

    protected function getParamFromUri(){
        $uri = explode("/", rtrim($this->uri, "/"));

        $aParams = [];
        foreach ($uri as $value){
            if((int)$value > 0){
                $aParam[strtolower($key)] = $value;
            }else{
                $key = $value;
            }
        }
        return $aParam;
    }
}