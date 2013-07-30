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

namespace lib\db;

use lib\core\Application;

/**
 * 数据连接工厂
 * @author starlight36
 */
class DbFactory {
	
	/**
	 * 本类实例
	 * @var DbFactory 
	 */
	private static $instance = NULL;
	
	/**
	 * 配置数组
	 * @var array 
	 */
	private $config = NULL;
	
	/**
	 * 连接池
	 * @var array 
	 */
	private $pool = array();
	
	/**
	 * 构造方法 
	 */
	private function __construct() {
		$this->config = Application::getInstance()->getConfig()->get('db');
	}
	
	/**
	 * 取得本类单例对象
	 * @return DbFactory
	 */
	public static function getInstance() {
		if(self::$instance instanceof self) {
			return self::$instance;
		}
		return self::$instance = new self();
	}
	
	/**
	 * 取得一个数据库连接对象
	 * @param int $id  数据库标识
	 * @return Connection
	 */
	public function getConnection($id = NULL) {
		if($this->pool[$id] instanceof Connection) {
			return $this->pool[$id];
		}
		$config = $this->config['pool'][($id === NULL) ? $this->config['default'] : $id];
		if(empty($config)) {
			throw new DbException('Selected DB connection does not exist.');
		}
		if(array_key_exists('uri', $config) && !empty($config['uri'])) {
			$config = $config['uri'];
		}
		return $this->pool[$id] = new Connection($config);
	}
	
}

/* EOF */