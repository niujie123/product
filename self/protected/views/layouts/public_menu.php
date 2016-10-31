  <div id="sidebar">
        <ul>
            <li <?php if($this->_controller == 'site'){ ?>class="active"<?php } ?>><a href="<?php echo FF_DOMAIN;?>"><i class="icon icon-home"></i> <span>首&nbsp;页</span></a> </li>
        	 <?php 
	            $memu_admin = FConfig::item('admin.menu');
				if(!empty($memu_admin)){
		            foreach ($memu_admin as $a_k => $a_v) {

                        $ruleArr = explode(',', $this->userGroup['menu']);
		                if( in_array($a_k, $ruleArr) ){
		        ?>
                    <li class="<?php 
                    	$controller_class = "";
                    	if(isset($a_v['son'])){
                    		$controller_class = "submenu";
                    		if($a_v['controller'] == $this->id){
                    			$controller_class .= " open";
                    		}
                    	}else{
                    		if($a_v['controller'] == $this->id){
                    			$controller_class = "active";
                    		}
                    	}
                    	echo $controller_class;
                     ?>">
                          <a href="<?php echo FF_DOMAIN.'/'.$a_v['controller'].'/'?>">
                          <i class="icon icon-<?php echo $a_v['icon']?>"></i>
                          <span><?php echo $a_v['resource']?></span>
                          <?php if(isset($a_v['son'])){?>
                          <span class="label label-important"><?php echo count($a_v['son'])?></span>
                          <?php }?>
                          </a>
                          <?php if(isset($a_v['son'])){?>
                          <ul>
                          <?php 
                          	$parm_flag = false;
                          	if(in_array($a_v['controller'], array('fragment','tag'))){
                          		$parm_flag = true;
                          	}
                          	foreach ($a_v['son'] as $s_k => $s_v) {
                          		$active_flag = false;
                          		$url = '/'.$a_v['controller'].'/'.$s_v['action'].'/';
                          		if($parm_flag){
                          			$url .= $s_k.'/';
                          		}
                          		if($parm_flag){
                          			$id = $this->request->getParam('id') ? $this->request->getParam('id') : 1;
                          			if($a_v['controller'].$s_v['action'] == $this->id.$this->action->id && $id == $s_k){
                          				$active_flag = true;
                          			}
                                //碎片特殊处理
                                if($this->_controller == 'fragment' && $this->_action =="edit" && $s_k == $this->request->getParam('type')){
                                  $active_flag = true;
                                }
                          		}else{
                          			if($a_v['controller'].$s_v['action'] == $this->id.$this->action->id){
                          				$active_flag = true;
                          			}
                          		}
                          	?>
					        <li class="<?php echo $active_flag?'active' : ' ' ?>">
					        <a href="<?php echo FF_DOMAIN.$url?>"><?php echo $s_v['resource']?></a>
					        </li>
					      <?php }?>  
<!--					      --><?php //}?>
					      </ul>
                          <?php }?>
                    </li>
		        <?php
	            }}
             }
	        ?>

            <li class="submenu">
                <a href="http://test.com/system/">
                    <i class="icon icon-cog"></i>
                    <span>系统</span>
                    <span class="label label-important">1</span>
                </a>
                <ul style="display: none;">
                    <li class=" ">
                        <a href="http://test.com/logout/">退出系统</a>
                    </li>
                </ul>
            </li>

        </ul>
</div>

<!--sidebar-menu-->
<script>
    
</script>