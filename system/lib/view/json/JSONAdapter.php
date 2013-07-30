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

namespace lib\view\json;

use lib\view\ViewAdapter;

/**
 * 用于PHtml的视图适配器
 * @author starlight36
 * @version 1.0
 * @created 05-四月-2012 14:08:19
 */
class JSONAdapter extends ViewAdapter {

	/**
	 * JSONView对象
	 * @var JSONView
	 */
	private $jsonView = NULL;
	
	/**
	 * 初始化方法
	 */
	public function init() {
		$this->jsonView = new JSONView();
	}
	
	/**
	 * 渲染视图
	 * @param string $data 视图名称
	 */
	public function render($data = NULL) {
		if(NULL != $data && is_array($data)) {
			$data = array_merge($this->view->getValueStack(), $data);
		} else {
			$data = $this->view->getValueStack();
		}
		$this->jsonView->render($data);
	}
}
/* EOF */