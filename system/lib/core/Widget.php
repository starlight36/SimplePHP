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
 * 部件基类
 * @author starlight36
 * @version 1.0
 * @updated 05-四月-2012 15:45:22
 */
abstract class Widget {

	/**
	 * 应用程序上下文对象
	 * @var Application
	 */
	protected $applicationContext = NULL;
	
	/**
	 * 配置对象
	 * @var Config 
	 */
	protected $config = NULL;

	/**
	 * 日志对象
	 * @var Log 
	 */
	protected $log = NULL;
	
	/**
	 * 请求对象
	 * @var Request 
	 */
	protected $request = NULL;
	
	/**
	 * 应答对象
	 * @var Response 
	 */
	protected $response = NULL;
	
	/**
	 * 视图对象
	 * @var View 
	 */
	protected $view = NULL;
	
	/**
	 * 会话对象
	 * @var Session 
	 */
	protected $session = NULL;

	/**
	 * 构造方法
	 */
	public function __construct() {
		$this->applicationContext = Application::getInstance();
		$this->config = $this->applicationContext->getConfig();
		$this->log = $this->applicationContext->getLog();
		$this->request = $this->applicationContext->getRequest();
		$this->response = $this->applicationContext->getResponse();
		$this->view = $this->applicationContext->getView();
		$this->session = $this->applicationContext->getSession();
		$this->init();
	}
	
	/**
	 * 部件初始化方法 
	 */
	public function init() {}
	
}

/* EOF */