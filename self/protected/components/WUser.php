<?php
/**
 * Created by PhpStorm.
 * User: ceshi
 * Date: 2016/10/20
 * Time: 16:23
 */

class WUser extends CWebUser {
    public function setFlash($key, $value, $defaultValue = null) {
        if($value instanceof CModel){
            if($value->hasErrors()){
                foreach ($value->getErrors() as $k=>$error){
                    $key.='.'.$k;
                    if(is_array($error)){
                        foreach($error as $e){
                            parent::setFlash('error', $key.':'.$e, $defaultValue);
                        }
                    }else{
                        parent::setFlash('error', $key.':'.$error, $defaultValue);
                    }
                }
            }
        }else{
            parent::setFlash($key, $value, $defaultValue);
        }
    }
} 