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

use lib\core\Log;

/**
 * @author starlight36
 * @version 1.0
 * @created 05-四月-2012 14:08:18
 */
abstract class Filter {

	/**
	 * 应用程序上下文对象
	 * @var Application
	 */
	private $applicationContext;
	
	/**
	 * 日志对象
	 * @var Log 
	 */
	protected $log = NULL;

	/**
	 * 构造方法
	 * @param Application $appContext 应用程序上下文对象
	 */
	public function __construct($appContext) {
		$this->applicationContext = $appContext;
		$this->log = $appContext->getLog();
	}
	
	/**
	 * 取得应用程序上下文
	 * @return Application
	 */
	public function getContext() {
		return $this->applicationContext;
	}

	/**
	 * 执行过滤器
	 * 
	 * @param FilterChain $filterChain 过滤器链对象
	 */
	abstract public function doFilter($filterChain);

}

/* EOF */