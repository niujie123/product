<?php
/**
 * 用户身份认证
 *  
 */

class FUser
{
	private $_user ; 
	
	public function init(){

	}
	// Load user model.
	public function loadUser()
 	{
        $token = FCookie::get("auth");
        $salt = FConfig::item('config.salt');
        list($uid) = explode("\t", FHelper::auth_code($token, 'DECODE', $salt));
        if($uid){
            $userModel = new User();
            $attr = array(
              'condition'=>"id=:id",
              'params' => array(':id'=>$uid),
            );
            $user = $userModel->find($attr);
            $this ->_user = $user->getAttributes();
            if(!$this ->_user){
                Yii::app()->getRequest() ->redirect('/login/error');
            }
        }
        return $this ->_user;
    }

}
