<?php
/**
 * Created by PhpStorm.
 * User: zoy
 * Date: 04/12/16
 * Time: 18:21
 */

namespace Zoy\Accessuser\Bases;


use Illuminate\Filesystem\Filesystem;

class Config
{


    /**
     * @param $app
     * @return mixed
     */
    public static function getConfigs($app){
        $fileSystem = new Filesystem;
        return $fileSystem->getRequire($app->configPath()."/accessuser.php");
    }

    /**
     * @param $key
     * @param $app
     * @return bool|mixed|string
     */
    public static function getConfig($key,$app,$default=null){
        $conf='';
        $configs = self::getConfigs($app);
        if(!is_array($configs)){
            return false;
        }
        $arrayKes = explode(".",$key);
        if(count($arrayKes) == 1){
            if(isset($arrayKes[0]) && isset($configs[$arrayKes[0]])){
                $conf =  $configs[$arrayKes[0]];
            }
        }
        if(count($arrayKes) == 2){
            if(isset($arrayKes[0]) &&  isset($arrayKes[1]) && isset($configs[$arrayKes[0]][$arrayKes[1]]) ){
                $conf =  $configs[$arrayKes[0]][$arrayKes[1]];
            }
        }
        if(count($arrayKes) == 3){
            if(isset($arrayKes[0]) &&  isset($arrayKes[1])  &&  isset($arrayKes[2]) && isset($configs[$arrayKes[0]][$arrayKes[1]][$arrayKes[2]]) ){
                $conf =  $configs[$arrayKes[0]][$arrayKes[1]][$arrayKes[2]];
            }
        }
        if(empty($conf) && !empty($default)){
            return $default;
        }
        return $conf;
    }



}