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

/**
 * PHtml视图引擎
 * @author starlight36
 * @version 1.0
 * @created 05-四月-2012 14:08:19
 */
class PHtml {
	
	/**
	 * Application对象
	 * @var Application 
	 */
	private $applicationContext = NULL;

	/**
	 * 模板目录
	 * @var string 
	 */
	private $templatePath = NULL;
	
	/**
	 * 模板变量数组
	 * @var array 
	 */
	private $templateVars = array();
	
	/**
	 * 模板引用数组
	 * @var array 
	 */
	private $templateRefVars = array();
	
	/**
	 * 页面样式数组
	 * @var array 
	 */
	private $pageStyles = array();
	
	/**
	 * 页面脚本数组
	 * @var type 
	 */
	private $pageScripts = array();
	
	/**
	 * 页面附加头区域
	 * @var array 
	 */
	private $pageHead = array();
	
	/**
	 * 构造方法 
	 */
	public function __construct() {
		$this->applicationContext = Application::getInstance();
		require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'PHtmlUtil.php';
	}
	
	/**
	 * 设置模板路径
	 * @param string $path 
	 */
	public function setTemplatePath($path) {
		$this->templatePath[] = $path;
	}
	
	/**
	 * 渲染一个视图变量
	 * @param mixed $key
	 * @param mixed $val 
	 */
	public function assign($key, $val = NULL) {
		if(is_array($key)) {
			foreach($key as $item_key => $item_val) {
				$this->assign($item_key, $item_val);
			}
		} else {
			$this->templateVars[$key] = $val;
		}
	}

	/**
	 * 绑定一个变量到视图中
	 * @param mixed $key
	 * @param mixed $val 
	 */
	public function bind($name, $val = NULL) {
		$this->templateRefVars[$name] = &$val;
	}

	/**
	 * 取得一个模板文件路径
	 * @param string $tpl 
	 */
	public function getTemplate($tpl) {
		foreach ($this->templatePath as $path) {
			$tpl = rtrim($path, '/').'/'.ltrim($tpl);
			if(is_file($tpl)) {
				return $tpl;
			}
		}
		throw new NoPHtmlException('Template '.$tpl.'does not exist.');
	}
	
	/**
	 * 添加一个样式表引用
	 * @param string $src
	 * @param string $id
	 */
	public function addStyle($src, $id = NULL) {
		if(empty($src)) {
			return;
		}
		if(strtolower(substr($src, 0, 7)) != 'http://'
				&& strtolower(substr($src, 0, 8)) != 'https://') {
			$src = rtrim($this->applicationContext->getRequest()->getContextPath(), '/').'/'.ltrim($src, '/');
		}
		if(empty($id)) {
			$this->pageStyles[] = $src;
		} else {
			$this->pageStyles[$id] = $src;
		}
	}
	
	/**
	 * 添加一个浏览器脚本引用
	 * @param string $src
	 * @param id $id
	 */
	public function addScript($src, $id = NULL) {
		if(empty($src)) {
			return;
		}
		if(strtolower(substr($src, 0, 7)) != 'http://'
				&& strtolower(substr($src, 0, 8)) != 'https://') {
			$src = rtrim($this->applicationContext->getRequest()->getContextPath(), '/').'/'.ltrim($src, '/');
		}
		if(empty($id)) {
			$this->pageScripts[] = $src;
		} else {
			$this->pageScripts[$id] = $src;
		}
	}
	
	/**
	 * 设置一个头区域 
	 */
	public function headBegin() {
		$this->applicationContext->getResponse()->capture();
	}
	
	/**
	 * 添加头区域 
	 */
	public function headEnd() {
		$this->pageHead[] = $this->applicationContext->getResponse()->getCaptured();
	}
	
	/**
	 * 取得一个页面部件
	 * @param string $widget 
	 */
	public function getWidget($widget) {
		$widget = '\\widget\\'.$widget;
		return new $widget();
	}

	/**
	 * 渲染一个视图
	 * @param string $tpl 
	 */
	public function render($tpl) {
		// 渲染常规视图变量
		if(!empty($this->templateVars)) {
			foreach($this->templateVars as $key => $value) {
				eval('$'.$key.'=$value;');
			}
		}
		
		// 渲染引用变量
		if(!empty($this->templateRefVars)) {
			foreach($this->templateRefVars as $key => &$value) {
				eval('$'.$key.'=&$value;');
			}
		}
		
		// 加载视图
		include $this->getTemplate($tpl);
	}
}
/* EOF */