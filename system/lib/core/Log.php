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

namespace lib\core;

use Exception;

/**
 * 日志类
 * @author starlight36
 * @version 1.0
 * @updated 05-四月-2012 15:45:24
 */
class Log {
	
	/*
	 * 日志级别 - 调试
	 */
	const DEBUG = 0;
	
	/**
	 * 日志级别 - 信息
	 */
	const INFO = 1;
	
	/**
	 * 日志信息 - 警告
	 */
	const WARN = 2;
	
	/**
	 * 日志信息 - 错误
	 */
	const ERROR = 3;

	/**
	 * 应用程序上下文对象
	 * @var Application
	 */
	private $applicationContext = NULL;

	/**
	 * 日志缓冲区
	 * @var array
	 */
	private $logBuffer = array();
	
	/**
	 * 是否开启开发模式
	 * 启用开发模式，将会在错误信息页面打印完全的错误
	 * 堆栈信息，请在main.php配置文件中设置。
	 * @var boolean
	 */
	private $enableDevelopMode = FALSE;
	
	/**
	 * 日志记录级别
	 * @var int 
	 */
	private $logLevel = 'DEBUG';
	
	/**
	 * 日志路径
	 * @var string 
	 */
	private $logPath = NULL;
	
	/**
	 * 日志格式
	 * @var string 
	 */
	private $logFormat = NULL;
	
	/**
	 * 日志级别名称
	 * @var array 
	 */
	private static $levelTags = array('DEBUG', 'INFO', 'WARN', 'ERROR');

	/**
	 * PHP错误映射到日志级别
	 * @var array
	 */
	private static $phpErrorMap = array(
		E_PARSE => 'ERROR', 
		E_ERROR => 'ERROR', 
		E_USER_ERROR => 'ERROR', 
		E_CORE_ERROR => 'ERROR',
		E_COMPILE_ERROR => 'ERROR',

		E_STRICT => 'WARN',
		E_WARNING => 'WARN',
		E_DEPRECATED => 'WARN', 
		E_USER_WARNING => 'WARN', 
		E_COMPILE_WARNING => 'WARN',

		E_NOTICE => 'INFO',
		E_USER_NOTICE => 'INFO');

	/**
	 * 构造方法 
	 */
	public function __construct($appContext) {
		$this->applicationContext = $appContext;
		$config = $appContext->getConfig();
		$this->enableDevelopMode = ($config->get('log.dev_mode')) ? TRUE : FALSE;
		$this->logLevel = $config->get('log.level');
		$this->logPath = $config->get('log.path');
		$this->logFormat = $config->get('log.format');
		// 托管PHP错误消息到本类处理器
		set_error_handler(array($this, 'phpErrorHander'), E_ALL);
		// 托管未处理的异常到本类处理器
		set_exception_handler(array($this, 'unhandledExceptionHandler'));
	}
	
	/**
	 * 析构方法
	 * 当日志对象销毁时，记录日志缓冲区内容到日志文件。
	 */
	public function __destruct() {
		if(!empty($this->logBuffer)) {
			error_log(implode("\n", $this->logBuffer)."\n", 3,
				strftime($this->logPath));
		}
	}
	
	/**
	 * PHP错误处理器
	 * @param int $errno
	 * @param string $errstr
	 * @param string $errfile
	 * @param int $errline
	 */
	public function phpErrorHander($errno, $errstr, $errfile, $errline) {
		$errorLevel = self::$phpErrorMap[$errno];
		$logMessage = "$errorLevel, $errno. $errstr in file $errfile,"
					 ." line $errline";
		$this->record($errorLevel, $logMessage);
		if($this->enableDevelopMode) {
			if(!defined('IN_PHPUNIT')) include 'lib/misc/debug.phtml';
			if(array_search($errorLevel, self::$levelTags) > self::INFO) {
				if(!defined('IN_PHPUNIT')) die();
			}
		} else {
			if(!defined('IN_PHPUNIT')){
				include 'lib/misc/error.phtml';
				die();
			}
		}
		return TRUE;
	}
	
	/**
	 * 未处理异常处理器
	 * @param Exception $exc
	 */
	public function unhandledExceptionHandler($exc) {
		$logMessage = "Unhandled Exception ".get_class($exc)
			.": {$exc->getMessage()} in file {$exc->getFile()}, "
			."line {$exc->getLine()}\nTrace stack:\n".$exc->getTraceAsString();
		$this->record(self::ERROR, $logMessage);
		if($this->enableDevelopMode) {
			include 'lib/misc/debug.phtml';
		} else {
			include 'lib/misc/error.phtml';
		}
		if(!defined('IN_PHPUNIT')) die();
	}

	/**
	 * 记录日志的方法
	 * 
	 * @param mixed $level 日志级别,
	 * 允许传入整数等级，或者对应等级的字符串
	 * @param string $output 输出内容,
	 * 要打印到日志的内荣
	 */
	public function record($level, $output) {
		if(is_string($level)) {
			$level = array_search($level, self::$levelTags);
			if($level === FALSE) {
				$level = self::WARN;
			}
		}
		if($level < $this->logLevel) {
			return;
		}
		$log_msg = str_replace('%level%', self::$levelTags[$level], $this->logFormat);
		$log_msg = str_replace('%time%', date('Y-m-d H:i:s'), $log_msg);
		$log_msg = str_replace('%output%', $output, $log_msg);
		$this->logBuffer[] = $log_msg;
	}

	/**
	 * 记录调试级别日志
	 * 
	 * @param string $output 输出内容
	 */
	public function debug($output) {
		$this->record(self::DEBUG, $output);
	}

	/**
	 * 记录信息级别日志
	 * 
	 * @param string $output 输出内容
	 */
	public function info($output) {
		$this->record(self::INFO, $output);
	}

	/**
	 * 记录警告级别日志
	 * 
	 * @param string $output 输出内容
	 */
	public function warn($output) {
		$this->record(self::WARN, $output);
	}

	/**
	 * 记录错误级别日志
	 * @param string $output 输出内容
	 */
	public function error($output) {
		$this->record(self::ERROR, $output);
	}

}

/* EOF */