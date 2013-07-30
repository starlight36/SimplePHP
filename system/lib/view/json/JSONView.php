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

use lib\core\Application;
use \lib\core\Response;

/**
 * JSON应答的视图引擎
 * @author starlight36
 * @version 1.0
 * @created 05-四月-2012 14:08:19
 */
class JSONView {
	
	/**
	 * 应答对象
	 * @var Response 
	 */
	private $response = NULL;
	
	/**
	 * 构造方法 
	 */
	public function __construct() {
		$this->response = Application::getInstance()->getResponse();
	}

	/**
	 * 渲染一个视图
	 * @param string $tpl 
	 */
	public function render($data) {
		$this->response->header('Content-Type', 'application/json');
		echo json_encode($data);
	}
}
/* EOF */