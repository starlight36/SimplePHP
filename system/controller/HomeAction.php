<?php

namespace controller;

use lib\core\Action;

/**
 * 主页面控制器类
 * @author starlight36
 * @version 1.0
 * @created 06-四月-2012 10:53:59
 */
class HomeAction extends Action {

	/**
	 * 默认执行方法
	 */
	public function execute() {
		$this->render('phtml', 'index.phtml');
	}
	
}

/* EOF */