<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
//	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();


    /**
     * @var CHttpRequest
     */
    public $request;
    public $pageTitle;
    /**
     * @var string
     */
    public $pagekeywords;
    /**
     * @var string;
     */
    public $pageDescription;

    /**
     * @var string;
     */
    protected $_controller;
    /**
     * @var string;
     */
    protected $_action;

    public $user_menu_list = array();
    /**
     * @var string
     */
    public $returnurl;

    public $user;
    public $userInfo;
    private $access = array('login','getLogin','setcookie','error','logout');
    public function __construct($id,$module=null)
    {
        parent::__construct($id,$module);

        $this -> request = Yii::app()->getRequest();
    }

    /*
    *判断当前用户是否登录
    */
    public function is_login(){

        return isset($this->userInfo['id']) && $this->userInfo['id'] ? true : false ;
    }
    protected function beforeAction($action) {
        $this -> user = Yii::app()-> user ->loadUser();

        if (!$this -> user && !in_array( $this->action->id, $this -> access))
        {
            Yii::app()->getRequest() ->redirect(FF_DOMAIN."/login");
        }

        if ($this -> user && $this -> user['status']!=1) {
            FCookie::set('auth', '', -3600);
            Yii::app()->getRequest() ->redirect(FF_DOMAIN."/login");
        }

        $userGroup = $this->getUserGroup();
        $operation = new Operation();
        $groupRule = explode(',', $userGroup['action']);
        $action = $operation->findAllByPk($groupRule);
        $ac = array();
        $co = array();
        if (is_array($action)) {
            foreach ($action as $v) {
                $ac[] = $v->action;
                $co[] = FConfig::item('admin.menu.'.$v->pid)['controller'];
            }
        }
        if ($this->user) {
            if (!in_array(strtolower($this->getId()), array_unique(array_merge(array('site', 'login'), $co))) || !in_array( strtolower($this->action->id), array_merge($ac, $this->access))) {
                Yii::app()->wuser->setFlash('error', '您还没有权限做此操作');
                Yii::app()->getRequest()->redirect( FF_DOMAIN );
            }
        }


        return true;
    }
    protected function getUserGroup() {
        if (!$uid = $this->user['type']) {
            return false;
        }
        $model = new AuthGroup();
        $attr = array(
            'condition'=>"id=:id",
            'params' => array(':id'=>$uid,),
        );
        $user = $model->find($attr);
        $account = $user->getAttributes();

        return $account;
    }

    /**
     * @return mixed
     * 获取当前用户IP
     */
    public function getCurrentIp () {
        if($_SERVER['HTTP_CLIENT_IP']){
            $onlineip=$_SERVER['HTTP_CLIENT_IP'];
        }elseif($_SERVER['HTTP_X_FORWARDED_FOR']){
            $onlineip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $onlineip=$_SERVER['REMOTE_ADDR'];
        }
        return $onlineip;
    }

    /**
     * 清除左右空格
     * @param $params
     */
    public function trimParams(&$params){
        if(is_array($params)){
            foreach ($params as &$g){
                if(is_array($g)){
                    $this->trimParams($g);
                }else{
                    $g=  trim($g);
                }
            }
        }
    }
}