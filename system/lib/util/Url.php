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

namespace lib\util;

use lib\core\Application;

/**
 * @author starlight36
 * @version 1.0
 * @created 05-四月-2012 14:08:19
 */
class Url {

	/**
	 * 创建一个完整形式的URL
	 * 
	 * @param action    要创建的Action路径, 或者带协议名的外部地址.
	 * @param method    方法名称, 为NULL使用默认方法
	 * @param query    查询变量
	 */
	public static function get($action, $method = NULL, $query = NULL) {
		if(strtolower(substr($action, 0, 7)) == 'http://' 
				|| strtolower(substr($action, 0, 8)) == 'https://') {
			return $action;
		}
		if(is_array($query)) {
			$query_pieces = array();
			foreach ($query as $key => $value) {
				$query_pieces[] = urlencode($key) .'='.urlencode($value);
			}
			$query = implode('&', $query_pieces);
		}
		$route_config = Application::getInstance()->getConfig()->get('route');
		$context_path = Application::getInstance()->getRequest()->getContextPath();
		$url = rtrim($context_path, '/').'/';
		if($route_config['mode'] == 'query') {
			$url .= 'index.php?p='.$action;
			if($method) {
				$url .= '/'.$method;
			}
			if($query) {
				$url .= '&'.$query;
			}
		}elseif($route_config['mode'] == 'pathinfo') {
			$url .= 'index.php/'.$action;
			if($method) {
				$url .= '/'.$method;
			}
			if($query) {
				$url .= '?'.$query;
			}
		} else {
			$url .= $action;
			if($method) {
				$url .= '/'.$method;
			}
			if($query) {
				$url .= '?'.$query;
			}
		}
		return $url;
	}

}

/* EOF */