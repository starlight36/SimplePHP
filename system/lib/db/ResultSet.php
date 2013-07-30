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

use \PDOStatement;
use \Iterator;

/**
 * 结果集类
 *
 * @author starlight36
 */
class ResultSet implements Iterator {

	/**
	 * PDOStatement对象
	 * @var PDOStatement 
	 */
	private $statement = NULL;
	
	/**
	 * 记录集
	 * @var array 
	 */
	private $rows = array();
	
	/**
	 * 迭代器标识 - 当前操作是否有效
	 * @var bool 
	 */
	private $valid = FALSE;
	
	/**
	 * 构造方法
	 * @param PDOStatement $statement 
	 */
	public function __construct($statement) {
		$this->statement = $statement;
		$this->fetchRows();
	}
	
	/**
	 * 将记录由PDO加载到结果集中 
	 */
	private function fetchRows() {
		while($row = $this->statement->fetchObject()) {
			$this->rows[] = $row;
		}
	}
	
	/**
	 * 析构方法 
	 */
	public function __destruct() {
		$this->statement->closeCursor();
	}


	/**
	 * 查询影响记录条数
	 * @return int 
	 */
	public function size() {
		$count = count($this->rows);
		if(!$count) {
			return $this->statement->rowCount();
		}
		return $count;
	}
	
	/**
	 * 将结果集转换为一个二维数组
	 * @return array
	 */
	public function toArray() {
		$result = array();
		foreach($this->rows as $row) {
			$result[] = (array)$row;
		}
		return $result;
	}
	
	/**
	 * 取得所有记录
	 * @return array 
	 */
	public function getAll() {
		return $this->rows;
	}
	
	/**
	 * 返回第一行记录
	 * @return \stdClass
	 */
	public function getFirst() {
		return $this->rows[0];
	}
	
	/**
	 * 取得第一行第一列记录
	 * @return mixed 
	 */
	public function getValue() {
		$first_row = (array)$this->rows[0];
		return array_shift($first_row);
	}

	/**
	 * 迭代器方法 - 取得当前
	 * @return \stdClass 
	 */
	public function current() {
		return current($this->rows);
	}

	/**
	 * 迭代器方法 - 当前键名
	 * @return type 
	 */
	public function key() {
		return key($this->rows);
	}

	/**
	 * 迭代器方法 - 游标下移
	 * @return bool 
	 */
	public function next() {
		$this->valid = (next($this->rows)  === FALSE) ? FALSE : TRUE; 
	}

	/**
	 * 迭代器方法 - 游标归零 
	 */
	public function rewind() {
		$this->valid = (reset($this->rows)  === FALSE) ? FALSE : TRUE; 
	}

	/**
	 * 迭代器方法 - 操作有效性标识
	 * @return bool 
	 */
	public function valid() {
		return $this->valid;
	}

}
/* EOF */