<div id="content-header">
    <div id="breadcrumb">
        <a href="/" title="返回首页" class="tip-bottom"><i class="icon-home"></i>首页</a> <a href="/article/" class="current">文章管理</a> <a href="/article/index" class="current">文章列表</a>
    </div>
</div>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div style="float: right;margin-right: 20px"><?php echo CHtml::link('添加',$this->createUrl('edit'),array('class'=>'btn btn-primary'));?></div>
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
                        <th class="tl"><div>版块</div></th>
                        <th class="tl"><div>标题</div></th>
                        <th class="tl"><div>简介</div></th>
                        <th class="tl"><div>发布人</div></th>
                        <th class="tl"><div>发布时间</div></th>
                        <th class="tl"><div>创建时间</div></th>
                        <th class="tl"><div>状态</div></th>
                        <th class="tl"><div>操作</div></th>
                    </tr>
                    </thead>
                    <tbody  class="tbodays">
                    <?php if($count == 0){?>
                        <tr><td colspan="7">没有符合条件记录</td></tr>
                    <?php }else {  foreach ($list as $k => $row){?>
                        <tr >
                            <td><div><?php echo $row->id;?></div></td>
                            <td><div><?php echo $typeArr[$row->type];?></div></td>
                            <td><div><?php echo $row->title;?></div></td>
                            <td><div><?php echo $row->subject;?></div></td>
                            <td><div><?php echo $row->user;?></div></td>
                            <td><div><?php echo $row->push_time;?></div></td>
                            <td><div><?php echo $row->create_time;?></div></td>
                            <td><div><?php echo $row->status=='1'?'开启':'关闭';?></div></td>
                            <td><div>
                                    <?php echo CHtml::link('修改', $this->createUrl('edit', array('id'=>$row->id)),array('title'=>'修改', 'class'=>'btn btn-small')); ?>
                                </div></td>
                        </tr>
                    <?php }}?>
                    </tbody>
                </table>

                <?php $this->renderPartial('//page/index',array('page'=>$page)); ?>
            </div>
        </div>
    </div>
</div>



