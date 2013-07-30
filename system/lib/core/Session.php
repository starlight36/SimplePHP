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

use lib\core\session\SessionHandler;

/**
 * 请求会话封装类
 * @author starlight36
 * @version 1.0
 * @updated 05-四月-2012 15:45:23
 */
class Session {

	/**
	 * Session配置数组
	 * @var array
	 */
	private $config = NULL;

	/**
	 * session处理器对象
	 * @var SessionHandler
	 */
	private $sessionHandler;

	/**
	 * 构造函数
	 * @param Application $appContext 
	 */
	public function __construct($appContext) {
		$this->config = $appContext->getConfig()->get('session');
		if(!empty($this->config['save_path'])) {
			session_save_path($this->config['save_path']);
		}
		if(!empty($this->config['handler']) && $this->config['handler'] != 'default') {
			$handler_class = $this->config[$this->config['handler']]['class'];
			$this->sessionHandler = new $handler_class($this, $this->config);
			session_set_save_handler(
				array($this->sessionHandler, 'open') , array($this->sessionHandler, 'close')
				, array($this->sessionHandler, 'read'), array($this->sessionHandler, 'write')
				, array($this->sessionHandler, 'destory'), array($this->sessionHandler, 'gc')
			);
		}
		if($this->config['auto_start']) {
			$this->start();
		}
	}
	
	/**
	 * 启动Session
	 * Session类会在初始化时，根据配置文件中的设置决定是否自动
	 * 启动Session，默认使用Cookie传递SessionID。若想自定义SessionID
	 * 的处理，请先在配置文件中禁用auto_start。然后利用过滤器机制实现自定义
	 * SessionID处理。注意，在Session启动前，无法使用Session值
	 * @param string $sessionId 指定的SessionID
	 */
	public function start($sessionId = NULL) {
		session_id($sessionId);
		session_start();
	}
	
	/**
	 * 返回当前会话的SessionId
	 * @return string
	 */
	public function getSessionId() {
		return session_id();
	}

	/**
	 * 取得一个会话值
	 * 
	 * @param string $name 会话名称
	 * @param mixed $default 默认值
	 */
	public function get($name, $default = NULL) {
		if($_SESSION && array_key_exists($name, $_SESSION)) {
			if($_SESSION[$name]['t'] > 0 
					&& $_SESSION[$name]['t'] < time()) {
				$this->remove($name);
				return $default;
			} else {
				return $_SESSION[$name]['v'];
			}
		} else {
			return $default;
		}
	}

	/**
	 * 设置一个会话值
	 * @param string $name 会话值名称
	 * @param mixed $value 会话值
	 * @param int $expire  有效期, 单位秒
	 */
	public function put($name, $value, $expire = 0) {
		$_SESSION[$name] = array(
			't' => ($expire > 0) ? time() + $expire : 0,
			'v' => $value
		);
	}

	/**
	 * 删除一个会话值
	 * 
	 * @param string $name 会话名称
	 */
	public function remove($name) {
		unset($_SESSION[$name]);
	}

	/**
	 * 清空所有会话值
	 */
	public function clear() {
		$_SESSION = NULL;
	}

}

/* EOF */