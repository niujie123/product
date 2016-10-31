<div id="content-header">
    <div id="breadcrumb">
        <a href="/" title="返回首页" class="tip-bottom"><i class="icon-home"></i>首页</a> <a href="/project/" class="current">测试环境接口</a> <a href="/project/index" class="current">接口</a>
    </div>
</div>
<div class="container-fluid">
    <div class="accordion-heading">
        <div class="widget-title"> <a data-parent="#collapse-group" href="#collapseGTwo" data-toggle="collapse" class="collapsed"> <span class="icon"><i class="icon-circle-arrow-right"></i></span>
                <h5>高级搜索</h5>
            </a> </div>
    </div>
    <div class="accordion-body collapse" id="collapseGTwo" style="height: 0px;">
        <form name="search-form" class="search-form" action="<?php echo $this->createUrl('/project/index');?>">
            <div class="search-message">
                项目 ：<input type="text" value="<?php echo $searchProject;?>" name="search_project" /><br />
                方法 ：<input type="text" value="<?php echo $searchMethod;?>" name="search_method" /><br />
                <input type="submit" class="search-mobile btn btn-primary" value="查找" />
            </div>
        </form>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <div style="float: right;margin-right: 20px"><?php echo CHtml::link('添加',$this->createUrl('modifyPro'),array('class'=>'btn btn-primary'));?></div>
        </div>
        <div class="span12">
            <div class="widget-box" style="margin-right: 20px;">
                <div class="dataTables_length">
                    <span class="badge badge-warning pull-right"><?php echo $count; ?></span>
                </div>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="tl"><div>ID</div></th>
                        <th class="tl"><div>地址</div></th>
                        <th class="tl"><div>项目</div></th>
                        <th class="tl"><div>方法</div></th>
                        <th class="tl"><div>加密方式</div></th>
                        <th class="tl"><div>字段</div></th>
                        <th class="tl"><div>创建时间</div></th>
                        <th class="tl"><div>操作</div></th>
                    </tr>
                    </thead>
                    <tbody  class="tbodays">
                    <?php if($count == 0){?>
                        <tr><td colspan="7">没有符合条件记录</td></tr>
                    <?php }else {  foreach ($projectList as $k => $row){?>
                        <tr >
                            <td><div><?php echo $row->id;?></div></td>
                            <td><div><?php echo $row->url;?></div></td>
                            <td><div><?php echo $row->project;?></div></td>
                            <td><div><?php echo $row->method;?></div></td>
                            <td><div><?php echo $model->secretArr[$row->secret];?></div></td>
                            <td><div><?php echo implode('，', json_decode($row->field));?></div></td>
                            <td><div><?php echo $row->create_time;?></div></td>
                            <td>
                                <div>
                                    <?php echo CHtml::link('修改', $this->createUrl('modifyPro', array('id'=>$row->id)),array('title'=>'修改', 'class'=>'btn btn-small')); ?>
                                    <?php echo CHtml::button('展开字段', array('title'=>'展开字段', 'class'=>'open-field btn btn-small', 'data-field'=>$row->field, 'data-pro'=>$row->project, 'data-met'=>$row->method)); ?>
                                </div>
                            </td>
                        </tr>
                    <?php }}?>
                    </tbody>
                </table>

                <?php $this->renderPartial('//page/index',array('page'=>$page)); ?>
            </div>
        </div>
    </div>
</div>

<!--修改--START---->
<div class="modal hide" id="modal-edit-event">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>字段展开</h3>
    </div>
    <form id="field_form" action="<?php echo $this->createUrl('/project/interface');?>" method="post">
        <div class="form-horizontal form-alert" id="openDiv">
        </div>
        <div class="modal-body">
            <div class="modal-footer modal_operate">
                <button type="submit" class="btn_edit btn btn-primary">提交请求</button>
                <a href="#" class="btn" data-dismiss="modal">取消</a>
            </div>
        </div>
    </form>
</div>
<!--修改--END---->

<script>
$(function(){
    $('.open-field').click(function(){
        $('#field_form')[0].reset();
        $('#modal-edit-event').modal({show:true});
        var fieldArr = eval('('+$(this).attr('data-field')+')');
        if ($.isArray(fieldArr)) {
            var html = '';
            html += '<input type="hidden" name="project" value="'+$(this).attr('data-pro')+'" >';
            html += '<input type="hidden" name="method" value="'+$(this).attr('data-met')+'" >';
            $.each(fieldArr, function(k,v){
                html += '<div class="control-group"><label class="control-label"><em class="red-star">*</em>';
                html += v;
                html += ' :</label><div class="controls"><input type="text" name="'+v+'" placeholder="'+v+'"><br /></div></div>';
            });

            $('#openDiv').html(html);

        } else {
            alert('展开失败');
        }

    });
});
</script>

