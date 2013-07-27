<?php
/**
 * 系统目录
 * @var string 
 */
define('WEB_ROOT', str_replace('\\', '/', dirname(__FILE__).'/'));
define('SYS_PATH', WEB_ROOT.'system/');

require SYS_PATH.'init.php';

/* EOF */