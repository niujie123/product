<div id="content-header">
    <div id="breadcrumb">
        <a href="/" title="返回首页" class="tip-bottom"><i class="icon-home"></i>首页</a> <a href="/power/" class="current">权限管理</a> <a href="/power/group" class="current">分组列表</a>
    </div>
</div>
<style>
    .errorMessage {
        color: red;
    }
</style>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <form method="post" action="<?php echo $this->createUrl('modifyGroup');?>">
                    <div class="form-horizontal form-alert">
                        <div class="control-group">
                            <label class="control-label"><em class="red-star">*</em>分组名 :</label>
                            <div class="controls">
                                <?php echo CHtml::activeTextField($model,'name', array('placeholder'=>'分组名'));?>
                                <?php echo CHtml::error($model, 'name');?>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label"><em class="red-star">*</em>描述 :</label>
                            <div class="controls">
                                <?php echo CHtml::activeTextArea($model,'describe', array('placeholder'=>'描述', 'style'=>'height: 200px;'))?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em class="red-star">*</em>规则 :</label>
                            <div class="controls">
                                <?php
                                    $html = '';
                                    foreach ($menu as $key => $val) {
                                        $mAction = explode(',', $model->action);
                                        $mMenu = explode(',', $model->menu);
                                        $mCheck = in_array($key, $mMenu) ? 'checked' : '';
                                        $html .= '<input type="checkbox" value="'.$key.'" name="AuthGroup[menu]['.$key.']" '.$mCheck.'> '.$val['resource'].'<br><br>';
                                        $html .= '  |  ';
                                        if (isset($operationList[$key]) && is_array($operationList[$key])) {
                                            foreach ($operationList[$key] as $k=>$v) {
                                                $aCheck = in_array($v['id'], $mAction) ? 'checked' : '';
                                                $html .= '<input type="checkbox" value="'.$v['id'].'" name="AuthGroup[action]['.$k.']" '.$aCheck.'> '.$v['name'];
                                            }
                                        }


                                        $html .= '<br><br>';
                                    }
                                    echo $html;
                                ?>
                                <?php echo CHtml::error($model, 'rule');?>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <?php echo CHtml::activeHiddenField($model, 'id');?>
                                <?php echo CHtml::submitButton('提交', array('class'=>'btn btn-primary'));?>
                                <?php echo CHtml::link('返回', $this->createUrl('/power/group'), array('class'=>'btn btn-primary'));?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('.user_status')
    })
</script>


