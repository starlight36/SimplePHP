<?php
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

/**
 * 启动应用程序运行 
 */
lib\core\Application::getInstance()->run();

/* EOF */