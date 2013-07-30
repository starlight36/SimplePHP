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

namespace lib\view;

/**
 * 视图引擎的抽象类
 * @author starlight36
 * @version 1.0
 * @updated 05-四月-2012 15:45:24
 */
abstract class ViewAdapter {

	/**
	 * 视图对象
	 * @var \lib\core\View
	 */
	protected $view = NULL;
	
	/**
	 * 视图配置数组
	 * @var array
	 */
	protected $config = NULL;

	/**
	 * 构造方法
	 * @param \lib\core\View $view 视图对象
	 * @param array $config  视图配置数组
	 */
	public function __construct($view, $config) {
		$this->view = $view;
		$this->config = $config;
		$this->init();
	}

	/**
	 * 初始化方法
	 */
	public function init() { }

	/**
	 * 渲染视图
	 * 
	 * @param name    视图名称
	 */
	abstract public function render($data = NULL);

}

/* EOF */