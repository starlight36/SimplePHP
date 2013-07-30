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

namespace lib\view\phtml;

use lib\core\Application;
use lib\view\ViewAdapter;

/**
 * 用于PHtml的视图适配器
 * @author starlight36
 * @version 1.0
 * @created 05-四月-2012 14:08:19
 */
class PHtmlAdapter extends ViewAdapter {

	/**
	 * PHtml对象
	 * @var PHtml
	 */
	private $phtml;
	
	/**
	 * Application对象
	 * @var Application
	 */
	private $applicationContext = NULL;
	
	/**
	 * 初始化方法
	 */
	public function init() {
		if($this->phtml instanceof PHtml) {
			return;
		}
		
		// 初始化视图类
		$this->phtml = new PHtml();
		$this->phtml->setTemplatePath($this->config['tpl_path']);
		
		// 系统内置对象
		$this->applicationContext = Application::getInstance();
		$this->phtml->bind('APP', $this->applicationContext);
		$this->phtml->bind('REQUEST', $this->applicationContext->getRequest());
		$this->phtml->bind('RESPONSE', $this->applicationContext->getResponse());
		$this->phtml->bind('SESSION', $this->applicationContext->getSession());
		$this->phtml->bind('CONFIG', $this->applicationContext->getConfig());
		$this->phtml->bind('LOG', $this->applicationContext->getLog());
		
		// 系统内置变量
		$this->phtml->assign('contextPath'
				, $this->applicationContext->getRequest()->getContextPath());
	}
	
	/**
	 * 渲染视图
	 * @param string $data 视图名称
	 */
	public function render($data = NULL) {
		$this->phtml->assign($this->view->getValueStack());
		$this->phtml->render($data);
	}
}
/* EOF */