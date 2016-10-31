<div id="content-header">
    <div id="breadcrumb">
        <a href="/" title="返回首页" class="tip-bottom"><i class="icon-home"></i>首页</a> <a href="/project/" class="current">测试环境接口</a> <a href="#" class="current">接口数据</a>
    </div>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
<!--            <div style="float: right;margin-right: 20px">--><?php //echo CHtml::link('添加',$this->createUrl('modifyPro'),array('class'=>'btn btn-primary'));?><!--</div>-->
        </div>
        <div class="span12" style="width: 99%;overflow: scroll;">
            <div class="widget-box" style="margin-right: 20px;">
                <div class="dataTables_length">
<!--                    <span class="badge badge-warning pull-right">--><?php //echo $count; ?><!--</span>-->
                </div>
                <table class="table table-bordered table-striped table-hover"">
                    <thead>
                    <tr>
                        <th colspan="50"><div>返回数据</div></th>
                    </tr>
                    </thead>
                    <tbody  class="tbodays">
                    <?php
                        echo $div;
                    ?>
                    </tbody>
                </table>

<!--                --><?php //$this->renderPartial('//page/index',array('page'=>$page)); ?>
            </div>
        </div>
    </div>
</div>


