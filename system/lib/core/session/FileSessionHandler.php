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

use lib\core\session\SessionHandler;

namespace lib\core\session;

/**
 * 使用文件的SESSION处理器
 * @author starlight36
 * @version 1.0
 * @created 05-四月-2012 14:08:18
 */
class FileSessionHandler extends SessionHandler {

	public function open($save_path, $session_name) {
		
	}

	public function read($sess_id) {
		
	}

	public function write($sess_id, $sess_data) {
		
	}

	public function close() {
		
	}

	public function destroy($sess_id) {
		
	}

	public function gc($maxlifetime) {
		
	}	

}

/* EOF */