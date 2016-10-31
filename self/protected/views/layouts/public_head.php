<!--Header-part-->
<div id="header">
  <img id="logo" style="width: 220px;height: 76px;" src="<?php echo FF_STATIC_BASE_URL; ?>/images/device/logo2.jpg" />
</div>
<!--close-Header-part--> 
<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li class=""><a><i class="icon icon-user"></i><span class="text">&nbsp;<?php echo $this->user['name']; ?>，你好</span></a></li>
    <li class=""><a href=""><i class="icon icon-time"></i>&nbsp;<span class="text" id="Timer"></span></a>
    </li>
  </ul>
</div>
<!--close-top-Header-menu-->
<!--start-top-serch-->
<div id="search" class="navbar navbar-inverse">
	<ul class="nav">
     <a title="" href="<?php echo FF_DOMAIN.'/login/logout';?>"><i class="icon icon-share-alt"></i> <span class="text">[退出系统]</span></a>
    </ul>
</div>
<!--close-top-serch-->
<script type="text/javascript">
$('#logo').addClass('animated fadeInRight ');
$('#logo').dblclick(function(){
    window.location.href = '/site/log';
});
</script>





