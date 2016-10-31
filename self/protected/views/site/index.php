<?php
/* @var $this JController */
$this->pageTitle = '首页';
?>
<div>
    <div id="content-header">
        <div id="breadcrumb">
            <a href="/" title="返回首页" class="tip-bottom"><i class="icon-home"></i>首页</a>
        </div>
    </div>
    <!--Action boxes-->
    <div class="container-fluid">

        <div class="quick-actions_homepage">
            <ul class="quick-actions">
                <?php
                $memu_admin = FConfig::item('admin.menu');
                if(!empty($memu_admin)){
                    $color = array('b','g','y','o','s','r');
                    foreach ($memu_admin as $a_k => $a_v) {
                        if(in_array($a_k,explode(',', $this->userGroup['menu']))){
                        $random_num = rand(0,count($color)-1);
                        ?>
                        <li class="bg_l<?php echo $color[$random_num]?> span2"> <a href="<?php echo $a_v['controller']?>"> <i class="icon-<?php echo $a_v['icon']?>"></i><?php echo $a_v['resource']?> </a> </li>
                        <?php
                        }
                    }
                }?>
            </ul>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-picture"></i> </span>
                        <h5>最新数据</h5>
                    </div>
                    <div class="widget-content">

                        <div class="list-group">
                            <?php
//                            include(Yii::app()->getRuntimePath().'/application.log');
                            $logArr = FHelper::tail(Yii::app()->getRuntimePath().'/application.log', 20);
                            $ht = '<a href="#" class="list-group-item active">';
		                    $ht .= '<h4 class="list-group-item-heading">';
		                    $ht .= '日志';
                            $ht .= '</h4></a>';

                            foreach ($logArr as $val) {
                                $ht .= '<a href="#" class="list-group-item active">';
//                                $ht .= '<h4 class="list-group-item-heading">';
//                                $ht .= '入门网站包';
//                                $ht .= '</h4>';
                                $ht .= '<p class="list-group-item-text">';
                                $ht .= $val;
                                $ht .= '</p>';
                                $ht .= '</a>';
                            }
                            echo $ht;
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End-Action boxes-->
<!--    <script type="text/javascript">-->
<!--        $(document).ready(function(){-->
<!--            // === jQeury Gritter, a growl-like notifications === //-->
<!--            $.gritter.add({-->
<!--                title:  'CIAS有你更精彩！',-->
<!--                text: '期待您de意见，反馈邮箱：<br><br><a href="mailto:niujie@kokozu.com">mailto:niujie@kokozu.com</a>',-->
<!--                image:  'upload/img/demo/envelope.png',-->
<!--                sticky: true-->
<!--            });-->
<!--        });-->
<!--    </script>-->
       