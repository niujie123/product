<div id="content-header">
    <div id="breadcrumb">
        <a href="/" title="返回首页" class="tip-bottom"><i class="icon-home"></i>首页</a> <a href="/project/" class="current">测试环境接口</a> <a href="/project/modifyPro" class="current">接口编辑</a>
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
<!--                <div class="modal-body">-->
                    <form method="post" action="<?php echo $this->createUrl('modifyPro');?>">
                        <div class="form-horizontal form-alert">

                            <div class="control-group">
                                <label class="control-label"><em class="red-star">*</em>地址 :</label>
                                <div class="controls">
                                    <?php echo CHtml::activeTextField($model,'url', array('placeholder'=>'地址', 'value'=>$model->getAttribute('name')));?>
                                    <?php echo CHtml::error($model, 'url');?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><em class="red-star">*</em>项目 :</label>
                                <div class="controls">
                                    <?php echo CHtml::activeTextField($model,'project', array('placeholder'=>'项目'))?>
                                    <?php echo CHtml::error($model, 'project');?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><em class="red-star">*</em>方法 :</label>
                                <div class="controls">
                                    <?php echo CHtml::activeTextField($model,'method', array('placeholder'=>'方法'))?>
                                    <?php echo CHtml::error($model, 'method');?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><em class="red-star">*</em>加密方式 :</label>
                                <div class="controls">
                                    <?php echo CHtml::activeDropDownList($model,'secret', $model->secretArr)?>
                                    <?php echo CHtml::error($model, 'secret');?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><em class="red-star">*</em><input type="button" id="AddMoreFileBox" class="btn btn-small btn-success" value="增加字段"> :</label>
                                <div id="InputsWrapper">
                                    <?php
                                    if ( isset ($model->field) && is_array(json_decode($model->field, true))) {
                                        $dv = '';
                                        foreach (json_decode($model->field, true) as $val) {
                                            $dv .= '<div class="controls">';
                                            $dv .= '<input type="text" name="Project[field][]" value="'.$val.'">';
                                            $dv .= '<a href="#" class="remove" style="margin-left: 10px;">×</a>';
                                            $dv .= '</div>';
                                        }
                                        echo $dv;
                                        $div = '<div class="controls">';
                                        $div .= CHtml::activeTextField($model,'field[]', array('placeholder'=>'字段'));
                                        $div .= '<a href="#" class="remove" style="margin-left: 10px;">×</a>';
                                        $div .= '</div>';
                                    } else {
                                        $div = '<div class="controls">';
                                        $div .= CHtml::activeTextField($model,'field[]', array('placeholder'=>'字段'));
                                        $div .= '<a href="#" class="remove" style="margin-left: 10px;">×</a>';
                                        $div .= '</div>';
                                        echo $div;
                                    }

                                    ?>
                                </div>

                            </div>
                            <div class="control-group">
                                <label class="control-label"><em class="red-star">*</em>header :</label>
                                <div class="controls">
                                    <?php echo CHtml::activeDropDownList($model,'header_type', array('0'=>'否', '1'=>'是'))?>
                                    <?php echo CHtml::error($model, 'header_type');?>
                                </div>
                            </div>
                            <div class="control-group" style="display: none;" id="header_content_div">
                                <label class="control-label"><input type="button" id="AddMoreFileBox2" class="btn btn-small btn-success" value="增加header"> :</label>
                                <div id="InputsWrapper2">
                                    <?php
                                    if ( isset ($model->header_content) && is_array(json_decode($model->header_content, true))) {
                                        $dv2 = '';
                                        foreach (json_decode($model->header_content, true) as $key => $val) {
                                            $dv2 .= '<div class="controls">';
                                            $dv2 .= '<input type="text" name="Project[header_content_k][]" value="'.$key.'" placeholder="header内容key" style="width:100px;">';
                                            $dv2 .= '：';
                                            $dv2 .= '<input type="text" name="Project[header_content_v][]" value="'.$val.'" placeholder="header内容val">';
                                            $dv2 .= '<a href="#" class="remove2" style="margin-left: 10px;">×</a>';
                                            $dv2 .= '</div>';
                                        }
                                        echo $dv2;
                                        $div2 = '<div class="controls">';
                                        $div2 .= '<input type="text" name="Project[header_content_k][]" placeholder="header内容key" style="width:100px;">';
                                        $div2 .= '：';
                                        $div2 .= '<input type="text" name="Project[header_content_v][]" placeholder="header内容val">';
                                        $div2 .= '<a href="#" class="remove2" style="margin-left: 10px;">×</a>';
                                        $div2 .= '</div>';
                                    } else {
                                        $div2 = '<div class="controls">';
                                        $div2 .= '<input type="text" name="Project[header_content_k][]" placeholder="header内容key" style="width:100px;">';
                                        $div2 .= '：';
                                        $div2 .= '<input type="text" name="Project[header_content_v][]" placeholder="header内容val">';
                                        $div2 .= '<a href="#" class="remove2" style="margin-left: 10px;">×</a>';
                                        $div2 .= '</div>';
                                        echo $div2;
                                    }

                                    ?>
                                </div>

                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <?php echo CHtml::activeHiddenField($model, 'id');?>
                                    <?php echo CHtml::submitButton('提交', array('class'=>'btn btn-primary'));?>
                                </div>
                            </div>
                        </div>
                    </form>
<!--                </div>-->
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        // 字段增加
        var InputsWrapper   = $("#InputsWrapper");
        var AddButton       = $("#AddMoreFileBox");
        var x = $("#InputsWrapper div").length;
        var FieldCount=1;
        var div = '<?php echo $div;?>';
        $(AddButton).click(function (e)
        {
            FieldCount++;
            $(InputsWrapper).append(div);
            x++;
        });
        $(".remove").live('click',function(){
            if( x > 1 ) {
                $(this).parent('div').remove();
                x--;
            }
            return false;
        });
        // header头部信息增加
        var InputsWrapper2   = $("#InputsWrapper2");
        var AddButton2       = $("#AddMoreFileBox2");
        var y = $("#InputsWrapper2 div").length;
        var headerCount=1;
        var div2 = '<?php echo $div2;?>';
        $(AddButton2).click(function (e)
        {
            headerCount++;
            $(InputsWrapper2).append(div2);
            y++;
        });

        $(".remove2").live('click',function(){
            if( y > 1 ) {
                $(this).parent('div').remove();
                y--;
            }
            return false;
        });

        var projectHeaderType = <?php echo $model->header_type==1 ? '1' : '0';?>;
        if (projectHeaderType == 1) {
            $('#header_content_div').css('display','block');
        }
        $("#Project_header_type").change(function(){
            var val = $(this).val();
            if (val == 0) {
                $('#header_content_div').css('display','none');
                $(InputsWrapper2).html(div2);
            } else if (val == 1) {
                $('#header_content_div').css('display','block');
            }
        });

    })
</script>


