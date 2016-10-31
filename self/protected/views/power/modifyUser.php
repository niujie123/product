<div id="content-header">
    <div id="breadcrumb">
        <a href="/" title="返回首页" class="tip-bottom"><i class="icon-home"></i>首页</a> <a href="/power/" class="current">权限管理</a> <a href="/power/index" class="current">用户表</a>
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
                <div class="modal-body">
                    <form method="post" action="<?php echo $this->createUrl('modifyUser');?>">
                        <div class="form-horizontal form-alert">
                            <div class="control-group">
                                <label class="control-label"><em class="red-star">*</em>用户名 :</label>
                                <div class="controls">
                                    <?php $disableName=$model->id>0?'"readonly"':''; echo CHtml::activeTextField($model,'name', array('placeholder'=>'用户名'));?>
                                    <?php echo CHtml::error($model, 'name');?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><em class="red-star">*</em>密码 :</label>
                                <div class="controls">
                                    <?php echo CHtml::activeTextField($model,'password', array('placeholder'=>'密码'))?>
                                    <span style="color: red;">（修改时，如果想保持原密码，请留空）</span>
                                    <?php echo CHtml::error($model, 'password', array('style'=>'color: red;'));?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><em class="red-star">*</em>所属分组 :</label>
                                <div class="controls">
                                    <?php echo CHtml::activeDropDownList($model,'type', $groupList, array('placeholder'=>'所属分组'))?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><em class="red-star">*</em>状态 :</label>
                                <div class="controls">
                                    <?php
                                    $startStatusChecked = $cloneStatusChecked = '';
                                    isset($model->status) && $model->status==1 ? $startStatusChecked='checked' : $cloneStatusChecked='checked';
                                    ?>
                                    <label class="checkbox-inline">
                                        <input type="radio" value="1" name="User[status]" class="user_status" <?php echo $startStatusChecked; ?>> 开启
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="radio" value="0" name="User[status]" class="user_status" <?php echo $cloneStatusChecked; ?>> 关闭
                                    </label>

                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <?php echo CHtml::activeHiddenField($model, 'id');?>
                                    <?php echo CHtml::submitButton('提交', array('class'=>'btn btn-primary'));?>
                                    <?php echo CHtml::link('返回', $this->createUrl('/power/index'), array('class'=>'btn btn-primary'));?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('.user_status')
    })
</script>


