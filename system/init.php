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
 * 系统启动器 
 */

/*
 * 设置默认包含文件夹为系统目录
 */
ini_set('include_path', SYS_PATH.PATH_SEPARATOR.ini_get('include_path'));

/**
 * 注册自动类加载器
 */
spl_autoload_register(function($class) {
	$class_path = str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
	if(is_file(SYS_PATH.$class_path)) {
		require $class_path;
	} else {
		$dir_name = dirname($class_path);
		$script_name = basename($class_path);
		$dir_array = scandir(SYS_PATH.$dir_name);
		if($dir_array) {
			foreach ($dir_array as $file) {
				if($file == '.' || $file == '..') {
					continue;
				}
				if(strcasecmp($script_name, $file) == 0) {
					require $dir_name.DIRECTORY_SEPARATOR.$file;
					return;
				}
			}
		}
	}
});

/* EOF */