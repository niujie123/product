<?php
/**
 * Created by PhpStorm.
 * User: ceshi
 * Date: 2016/10/14
 * Time: 16:34
 */
class ArticleController extends Controller
{
    // 接口  获取文章列表数据；
    public function actionGetArticle () {
        $model = new Article();
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
        $list = $model->findAll($condition_arr);

        $ar = array();
        foreach ($list as $v) {
            $ar[] = $v->attributes;
        }
        echo json_encode($ar);exit;
    }
    /**
     * 用户列表
     */
    public function actionIndex () {
        $data = array();
        $model = new Article();
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

        $list = $model->findAll($condition_arr);
        $data['list'] = $list;
        $data['page'] = $pages;
        $data['typeArr'] = $model->getSection();
//print_r($list);exit;
        $this->render('index', $data);
    }

    /**
     * 编辑用户
     */
    public function actionEdit () {
        $proArr = $this->request->getParam('Article');
        $id = $this->request->getParam('id', '0');
        $model = new Article();
        if ($id > 0) {
            $data = $model->findByPk($id)->getAttributes();
            $model->setAttributes($data,false);
            $model->id = $id;
        }

        if (!empty($proArr)) {
            $model->setScenario('save');
            $model->title = trim($proArr['title']);
            $model->subject = trim($proArr['subject']);
            $model->type = trim($proArr['type']);
            $model->user = trim($proArr['user']);
            $model->push_time = trim($proArr['push_time']);
            $model->status = trim($proArr['status']);
            $model->content = $proArr['content'];

            if (isset($proArr['id']) && $proArr['id'] > 0) {
                $model->setIsNewRecord(false);
                $model->id = $proArr['id'];
            } else {
                $model->create_time = date('Y-m-d H:i:s');
            }
            if ($model->validate()) {
                if ($model->save()) {
                    $this->redirect('index');
                } else {
                    $this->redirect($this->request->urlReferrer);
                }
            } else {
//                print_r($model->getErrors());exit;
            }
        }
        $this->render('edit', array('model'=>$model));
    }

}