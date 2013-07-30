<?php
/*---------------------------------------------------------------------------
 * SimplePHP - A Simple PHP Framework for PHP 5.3+
 *---------------------------------------------------------------------------
 * Copyright 2013, starlight36 <me@starlight36.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *    http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *-------------------------------------------------------------------------*/

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
		// 是否自动开启Session
		'auto_start' => TRUE,
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