<?php
/**
 * Created by PhpStorm.
 * User: ceshi
 * Date: 2016/10/14
 * Time: 16:34
 */
class ProjectController extends Controller
{

    /**
     * 接口列表
     */
    public function actionIndex () {

        $data = array();
        $model = new Project();
        $data['model'] = $model;
        $data['searchProject'] = $searchProject = trim($this->request->getParam('search_project'));
        $data['searchMethod'] = $searchMethod = trim($this->request->getParam('search_method'));
        //分页参数
        $page = ($this->request->getParam('page') > 0) ? (int) $this->request->getParam('page') : 1;
        $page_size = ($this->request->getParam('size') > 0) ? (int) $this->request->getParam('size') : FConfig::item('config.pageSize');

        $condition_arr = array(
            'condition' => '1=1',
            'order' => 'id desc',
            'limit' => $page_size,
            'offset' => ($page - 1) * $page_size ,
        );
        !empty($searchProject) ? $condition_arr['condition'] .= ' AND project LIKE "%'.$searchProject.'%"' : '';
        !empty($searchMethod) ? $condition_arr['condition'] .= ' AND method LIKE "%'.$searchMethod.'%"' : '';
        //分页
        $data['count'] = $model-> count($condition_arr);
        $pages = new FPagination($data['count']);
        $pages->setPageSize($page_size);
        $pages->setCurrent($page);
        $pages->makePages();

        $projectList = $model->findAll($condition_arr);
        $data['projectList'] = $projectList;
        $data['page'] = $pages;

        $this->render('index', $data);
    }

    public function actionModifyPro () {
        $proArr = $this->request->getParam('Project');
        $id = $this->request->getParam('id', '0');
        $model = new Project();
        if ($id > 0) {
            $data = $model->findByPk($id)->getAttributes();
            $model ->setAttributes( $data );
            $model->id = $id;
        }

        if (!empty($proArr)) {
            $model->setScenario('save');
            $model->url = trim($proArr['url']);
            $model->project = trim($proArr['project']);
            $model->method = trim($proArr['method']);
            $model->secret = trim($proArr['secret']);
            $model->field = json_encode($proArr['field']);
            $model->header_type = $proArr['header_type'];
            if ($proArr['header_type']=='1' && is_array($proArr['header_content_k'])) {
                $headerContent = array();
                foreach ($proArr['header_content_k'] as $key=>$val) {
                    $headerContent[$val] = $proArr['header_content_v'][$key];
                }
                $model->header_content = str_replace('\\', '', json_encode($headerContent));
            }

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
            }
        }
        $this->render('modifyPro', array('model'=>$model));
    }

    public function actionInterface () {
        if (is_array($_POST) && !empty($_POST)) {
            $url = 'http://192.168.5.29:8000/test';
            if (isset($_POST['project'])) {
                $url .= "?project=".$_POST['project'];
                unset($_POST['project']);
            }
            if ( isset ($_POST['mtype']) ) {
                unset($_POST['method']);
            }
            foreach ($_POST as $k=>$v) {

                $url .= "&".$k."=".$v;
            }
//            $url = str_replace('&', "&amp;", $url);
            $url = str_replace(' ', "%20", $url);       // 去除空格



//$url = 'http://192.168.5.29:8000/test?project=noc&uid=test&cinemaLineId=1&cityId=500100&mtype=getCinemas&timestamp=4&mdkey5=key';
$url = 'http://115.29.48.246:18080/noc/cinema/getCinemas?cityId=500100&uid=test&cinemaLineId=1&timestamp=4&mtype=getCinemas&enc=2fe6bb89cb1b740c201def19d2a53072';
//            $url = 'http://192.168.5.29:8000/test?project=noc&uid=test&mtype=getCinemas&cinemaLineId=1&timestamp=4&cityId=500100&mdkey5=key';

$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT,10);
$dxycontent = curl_exec($ch);
            $data = json_decode($dxycontent,true);
            $staticDiv = '';
            if (is_array($data)) {
                foreach ($data as $k=>$v) {
                    if (is_array($v)) {
                        $staticDiv .= '<tr>';
                        $staticDiv .= $this->divShow($v);
                        $staticDiv .= '</tr>';
                    } else {
                        $staticDiv .= '<tr><td><div>'.$k.'：'.$v.'</div></td></tr>';
                    }

                }
            } else {
                $staticDiv .= !empty($data) ? $data : '没有符合条件记录';
            }
//            $data = file_get_contents('http://114.215.130.32:8140/xincheng_cias/server?uid=web&method=getCinemas&time_stamp=123&enc=0fcfcffc868960e79d471a8b034e2fd5');
            $this->render('interface', array('div' => $staticDiv));
        } else {
            echo '参数错误';
        }
    }
    private function divShow ($array) {
        $staticDiv = '';
        foreach ($array as $key=>$val) {
            if (is_array($val)) {
                $staticDiv .= $this->divShow($val);
            } else {
                $staticDiv .= '<td><div>'.$key.'：'.$val.'</div></td>';
            }
        }
        return $staticDiv;

    }
}