<?php
return array(
	'menu'  => array(
		// 后台菜单
		'1' => array(
			'controller' => 'power',
			'resource'   => '权限管理',
			'icon'		 =>	'user',
            'son'        => array(
                '1'	=> array(
                    'action' 	=> 'index',
                    'resource'	=> '用户列表',
                ),
                '2' =>  array(
                    'action'    =>  'group',
                    'resource'  =>  '分组管理',
                ),
            ),
		),
		'2' => array(
			'controller' => 'project',
			'resource'   => '接口管理',
			'icon'		 =>	'move',
            'son'        => array(
                '1'	=> array(
                    'action' 	=> 'index',
                    'resource'	=> '接口列表',
                ),
            ),
		),
		'3' => array(
			'controller' => 'article',
			'resource'   => '文章管理',
			'icon'		 =>	'move',
            'son'        => array(
                '1'	=> array(
                    'action' 	=> 'index',
                    'resource'	=> '文章列表',
                ),
            ),
		),

	),
	
);