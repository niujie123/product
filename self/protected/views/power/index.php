<div id="content-header">
    <div id="breadcrumb">
        <a href="/" title="返回首页" class="tip-bottom"><i class="icon-home"></i>首页</a> <a href="/power/" class="current">权限管理</a> <a href="/power/index" class="current">用户表</a>
    </div>
</div>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div style="float: right;margin-right: 20px"><?php echo CHtml::link('添加',$this->createUrl('modifyUser'),array('class'=>'btn btn-primary'));?></div>
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
                        <th class="tl"><div>用户名</div></th>
                        <th class="tl"><div>角色分组</div></th>
                        <th class="tl"><div>状态</div></th>
                        <th class="tl"><div>最后登录IP</div></th>
                        <th class="tl"><div>最后登录时间</div></th>
                        <th class="tl"><div>创建时间</div></th>
                        <th class="tl"><div>操作</div></th>
                    </tr>
                    </thead>
                    <tbody  class="tbodays">
                    <?php if($count == 0){?>
                        <tr><td colspan="7">没有符合条件记录</td></tr>
                    <?php }else {  foreach ($list as $k => $row){?>
                        <tr >
                            <td><div><?php echo $row->id;?></div></td>
                            <td><div><?php echo $row->name;?></div></td>
                            <td><div><?php echo $row->group->name;?></div></td>
                            <td><div><?php echo FConfig::item('config.status.'.$row->status);?></div></td>
                            <td><div><?php echo $row->last_login_ip;?></div></td>
                            <td><div><?php echo $row->last_login_time;?></div></td>
                            <td><div><?php echo $row->create_time;?></div></td>
                            <td><div><?php echo CHtml::link('修改', $this->createUrl('modifyUser', array('id'=>$row->id)),array('title'=>'修改', 'class'=>'btn btn-small')); ?></div></td>
                        </tr>
                    <?php }}?>
                    </tbody>
                </table>

                <?php $this->renderPartial('//page/index',array('page'=>$page)); ?>
            </div>
        </div>
    </div>
</div>


