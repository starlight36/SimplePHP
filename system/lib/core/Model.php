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

/**
 * 模型类基类
 * @author starlight36
 * @version 1.0
 * @updated 05-四月-2012 15:45:24
 */
abstract class Model {

	/**
	 * 日志类对象
	 * @return Log
	 */
	private $log = NULL;

	/**
	 * 构造方法 
	 */
	public function __construct() {
		$appContext = Application::getInstance();
		$this->log = $appContext->getLog();
		$this->init();
	}
	
	/**
	 * 用于初始化的方法 
	 */
	public abstract function init();

	/**
	 * 取得日志对象
	 * @return Log
	 */
	protected function getLog() {
		return $this->log;
	}

}

/* EOF */