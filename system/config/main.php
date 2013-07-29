<?php
/**
 * 系统主配置文件
 */

return array(

	// 日志配置
	'log' => array(
		'dev_mode' => TRUE,
		'level'    => 'DEBUG',
		'format'   => '[%level%] %time% - %output%',
		'path'     => SYS_PATH.'runtime/logs/app_%Y-%m-%d.log',
	),

	// Session设置
	'session' => array(
		// 当前使用的Session处理器
		'handler' => 'default',
		'save_path' => SYS_PATH.'runtime/session/',

		// 基于文件的Session处理器
		'file_handler' => array(
			'class' => '\\lib\\core\\session\\FileSessionHandler',
			'config' => array(
				'save_path' => SYS_PATH.'temp/session/',
			),
		),
	),
	
	// 视图设置
	'view' => array(
		'engine' => array(
			'phtml' => array(
				'class' => '\\lib\\view\\phtml\\PHtmlAdapter',
				'config' => array(
					'tpl_path' => SYS_PATH.'view/',
				)
			),
			'json' => array(
				'class' => '\\lib\\view\\json\\JSONAdapter',
				'config' => array(),
			),
		),
	),
	
);

/* EOF */