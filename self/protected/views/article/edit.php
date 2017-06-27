<div id="content-header">
    <div id="breadcrumb">
        <a href="/" title="返回首页" class="tip-bottom"><i class="icon-home"></i>首页</a> <a href="/article/" class="current">文章管理</a> <a href="<?php echo Yii::app()->request->url?>" class="current">编辑文章</a>
    </div>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="">
                    <form method="post" action="<?php echo $this->createUrl('edit');?>">
                        <div class="form-horizontal form-alert">
                            <div class="control-group">
                                <label class="control-label"><em class="red-star">*</em>标题 :</label>
                                <div class="controls">
                                    <?php echo CHtml::activeTextField($model,'title', array('placeholder'=>'标题'));?>
                                    <?php echo CHtml::error($model, 'title');?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">简介 :</label>
                                <div class="controls">
                                    <?php echo CHtml::activeTextField($model,'subject', array('placeholder'=>'简介'))?>
                                    <?php echo CHtml::error($model, 'subject', array('style'=>'color: red;'));?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">版块 :</label>
                                <div class="controls">
                                    <?php echo CHtml::activeDropDownList($model,'type', $model->getSection())?>
                                    <?php echo CHtml::error($model, 'type', array('style'=>'color: red;'));?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">发布人 :</label>
                                <div class="controls">
                                    <?php echo CHtml::activeTextField($model,'user', array('placeholder'=>'发布人'))?>
                                    <?php echo CHtml::error($model, 'user', array('style'=>'color: red;'));?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><em class="red-star">*</em>发布时间 :</label>
                                <div class="controls">
                                    <?php echo CHtml::activeTextField($model,'push_time', array('placeholder'=>'发布时间','onFocus'=>"WdatePicker({lang:'zh-cn',skin:'twoer',dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'%y-%M-%d %H:%m:%s',})"))?>
                                    <?php echo CHtml::error($model, 'push_time', array('style'=>'color: red;'));?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><em class="red-star">*</em>状态 :</label>
                                <div class="controls">
                                    <?php echo CHtml::activeDropDownList($model,'status', array('1'=>'开启','2'=>'关闭'))?>
                                </div>
                            </div>
                            <?php $this->widget('ext.kindeditor.KindEditorWidget',      // oss上传图片  上传到alioss服务器
                                array(
                                    'id'=>"Article_content",
                                    'language'=>'zh_CN',
                                    'items' => array(
                                        'width'=>'700px',
                                        'height'=>'300px',
                                        'themeType'=>'simple',
                                        'allowImageUpload'=>true,
                                        'allowFileManager'=>true,
                                        'items'=>array(
                                            'source','fontname', 'fontsize','code', '|', 'forecolor', 'hilitecolor', 'bold', 'italic',
                                            'underline', 'removeformat', '|', 'justifyleft', 'justifycenter',
                                            'justifyright', 'insertorderedlist','insertunorderedlist', '|',
                                            'emoticons', 'image', 'link','fullscreen'
                                        ),
                                    )
                                )
                            );?>
                            <div class="control-group">
                                <label class="control-label"><em class="red-star">*</em>内容 :</label>
                                <div class="controls">
                                    <?php echo CHtml::activeTextArea($model,'content', array('placeholder'=>'内容'))?>
<!--                                    <span style="color: red;">（修改时，如果想保持原密码，请留空）</span>-->
                                    <?php echo CHtml::error($model, 'content', array('style'=>'color: red;'));?>
                                </div>
                            </div>


                            <div class="control-group">
                                <div class="controls">
                                    <?php echo CHtml::activeHiddenField($model, 'id');?>
                                    <?php echo CHtml::submitButton('提交', array('class'=>'btn btn-primary'));?>
                                    <?php echo CHtml::link('返回', $this->createUrl('/article/index'), array('class'=>'btn btn-primary'));?>
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
//        $('.pushTime').datepicker({
//            numberOfMonths:1,//显示几个月
//            showButtonPanel:true,//是否显示按钮面板
//            dateFormat: 'yy-mm-dd',//日期格式
//            clearText:"清除",//清除日期的按钮名称
//            closeText:"关闭",//关闭选择框的按钮名称
//            yearSuffix: '年', //年的后缀
//            showMonthAfterYear:true,//是否把月放在年的后面
//            defaultDate:'2011-03-10',//默认日期
//            minDate:'2011-03-05',//最小日期
//            maxDate:'2011-03-20',//最大日期
//            monthNames: ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
//            dayNames: ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],
//            dayNamesShort: ['周日','周一','周二','周三','周四','周五','周六'],
//            dayNamesMin: ['日','一','二','三','四','五','六'],
//            onSelect: function(selectedDate) {//选择日期后执行的操作
//                alert(selectedDate);
//            }
//        });
    })
</script>


