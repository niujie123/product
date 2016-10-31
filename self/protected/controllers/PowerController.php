<?php
/**
 * Created by PhpStorm.
 * User: ceshi
 * Date: 2016/10/14
 * Time: 16:34
 */
class PowerController extends Controller
{
    /**
     * 用户列表
     */
    public function actionIndex () {
        $data = array();
        $model = new User();
        //分页参数
        $page = ($this->request->getParam('page') > 0) ? (int) $this->request->getParam('page') : 1;
        $page_size = ($this->request->getParam('size') > 0) ? (int) $this->request->getParam('size') : FConfig::item('config.pageSize');

        $condition_arr = array(
            'order' => 't.id desc',
            'limit' => $page_size,
            'offset' => ($page - 1) * $page_size ,
        );
        //分页
        $data['count'] = $model-> count($condition_arr);
        $pages = new FPagination($data['count']);
        $pages->setPageSize($page_size);
        $pages->setCurrent($page);
        $pages->makePages();

        $list = $model->with('group')->findAll($condition_arr);
        $data['list'] = $list;
        $data['page'] = $pages;
//print_r($list);exit;
        $this->render('index', $data);
    }

    /**
     * 编辑用户
     */
    public function actionModifyUser () {
        $data = array();
        $userArr = $this->request->getParam('User');
        $this->trimParams($userArr);
        $id = $this->request->getParam('id', '0');
        $model = new User();
        if ($id > 0) {
            $data = $model->findByPk($id)->getAttributes();
            $model->setAttributes($data);
            $model->password = '';
        }

        if (isset($userArr)) {
            $pMatch = '/^[A-Za-z0-9\.\@\_\#]{6,}$/';
            $model->setScenario('save');
            $model->attributes = $userArr;
            $model->last_login_ip = $this->getCurrentIp();
            if (isset($userArr['id']) && $userArr['id'] > 0) {
                $model->setIsNewRecord(false);
                $model->id = $userArr['id'];
//                var_dump($userArr);
                if (isset($userArr['password']) && !empty($userArr['password'])) {
//                    var_dump('aaa');exit;
                    if (FHelper::FilterRegex($userArr['password'], $pMatch)) {
                        $model->password = md5($userArr['password']);
                    } else {
                        $model->addError('password', '密码格式为字母或数字或包含.@_#最少6位');
                    }

                } else {
                    $attr = $model->findByPk($userArr['id'])->getAttributes();
//                    var_dump($attr);exit;
                    $model->password = $attr['password'];
                }

//                $model->name = $attr['name'];
            } else {
                $model->create_time = date('Y-m-d H:i:s');
//                var_dump($userArr['password']);exit;
//                $model->password = md5($userArr['password']);
                if (FHelper::FilterRegex($userArr['password'], $pMatch)) {
                    $model->password = md5($userArr['password']);
                } else {
                    $model->addError('password', '密码格式为字母或数字或包含.@_#最少6位');
                }
            }
//            print_r($model->errors);
//            exit;
            if (empty($model->errors)) {
//                var_dump($model->validate());exit;
                if ($model->validate() && $model->save()) {
                    Yii::app()->wuser->setFlash('success', '保存成功');
                    $this->redirect('index');
                } else {
                    Yii::app()->wuser->setFlash('error', '操作失败，请换一个用户名后重试');
                    $this->redirect($this->request->urlReferrer);
                }
            } else {
                Yii::app()->wuser->setFlash('error', '操作失败');
                $model->password = '';
            }
        }
//print_r($model);exit;
        $data['model'] = $model;
        $data['groupList'] = $model->getGroup();
        $this->render('modifyUser', $data);
    }

    public function actionGroup () {
        $data = array();
        $model = new AuthGroup();
        //分页参数
        $page = ($this->request->getParam('page') > 0) ? (int) $this->request->getParam('page') : 1;
        $page_size = ($this->request->getParam('size') > 0) ? (int) $this->request->getParam('size') : FConfig::item('config.pageSize');

        $condition_arr = array(
            'order' => 'id desc',
            'limit' => $page_size,
            'offset' => ($page - 1) * $page_size ,
        );
        //分页
        $data['count'] = $model-> count($condition_arr);
        $pages = new FPagination($data['count']);
        $pages->setPageSize($page_size);
        $pages->setCurrent($page);
        $pages->makePages();

        $list = $model->findAll($condition_arr);
        $data['list'] = $list;
        $data['page'] = $pages;

        $this->render('group', $data);
    }

    public function actionModifyGroup () {
        $data = array();
        $groupArr = $this->request->getParam('AuthGroup');
        $id = $this->request->getParam('id', '0');

        // 操作列表
        $operationList = Operation::model()->findAll();
        $oList = array();
        foreach ($operationList as $key=>$val) {
            $oList[$val->pid][$key] = $val->getAttributes();
        }
        $data['operationList'] = $oList;

        // menu列表
        $menu = FConfig::item('admin.menu');
        $menuArr = array();
        foreach ($menu as $key => $val) {
            $menuArr[$key] = $val['resource'];
        }
        $data['menu'] = $menu;

        $model = new AuthGroup();
        if ($id > 0) {
            $record = $model->findByPk($id);
            $model = $record;
        }
        $data['model'] = $model;

        if (isset($groupArr)) {
            $model->setScenario('save');
            $model->attributes = $groupArr;
            isset ($groupArr['action']) ? $model->action = implode(',', $groupArr['action']) : '';
            isset ($groupArr['menu']) ? $model->menu = implode(',', $groupArr['menu']) : '';
            if (isset($groupArr['id']) && $groupArr['id'] > 0) {
                $model->setIsNewRecord(false);
                $model->id = $groupArr['id'];
            }
            if ($model->validate()) {
                if ($model->save()) {
                    $this->redirect('group');
                } else {
                    $this->redirect($this->request->urlReferrer);
                }
            }
        }
        $this->render('modifyGroup', $data);
    }
}