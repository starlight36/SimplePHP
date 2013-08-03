<?php

namespace lib\core;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-08-03 at 11:53:37.
 */
class ApplicationTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var Application
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 * @covers lib\core\Application::__construct
	 */
	protected function setUp() {
		$this->object = Application::getInstance(TRUE);
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		
	}

	/**
	 * Create instance for Application
	 * @covers lib\core\Application::getInstance
	 */
	public function testGetInstance() {
		$obj = Application::getInstance(TRUE);
		$this->assertInstanceOf('lib\\core\\Application', $obj);
	}

	/**
	 * Test setAttribute
	 * @covers lib\core\Application::setAttribute
	 */
	public function testSetAttribute() {
		$expactValue = 'this is a value';
		$this->assertEmpty($this->object->getAttribute());
		$this->assertEmpty($this->object->getAttribute('test_key'));
		
		$this->object->setAttribute('test_key', $expactValue);
		$actualValue = $this->object->getAttribute('test_key');
		$this->assertEquals($expactValue, $actualValue);
		
		$actualAllValue = $this->object->getAttribute();
		$this->assertEquals(array('test_key' => $expactValue), $actualAllValue);
	}

	/**
	 * Test for get value
	 * @covers lib\core\Application::getAttribute
	 * @depends testSetAttribute
	 */
	public function testGetAttribute() {
		$expactValue = 'this is a value';
		
		$this->object->setAttribute('test_key', $expactValue);
		$actualValue = $this->object->getAttribute('test_key');
		$this->assertEquals($expactValue, $actualValue);
		
		$actualAllValue = $this->object->getAttribute();
		$this->assertEquals(array('test_key' => $expactValue), $actualAllValue);
		
		$actualNullValue = $this->object->getAttribute('no_such_key');
		$this->assertNull($actualNullValue);
	}

	/**
	 * Test webroot value
	 * @covers lib\core\Application::getWebRoot
	 */
	public function testGetWebRoot() {
		$this->assertEquals(WEB_ROOT, $this->object->getWebRoot());
	}

	/**
	 * Test system root value
	 * @covers lib\core\Application::getSystemRoot
	 */
	public function testGetSystemRoot() {
		$this->assertEquals(SYS_PATH, $this->object->getSystemRoot());
	}

	/**
	 * Test for getting Config object
	 * @covers lib\core\Application::getConfig
	 */
	public function testGetConfig() {
		$this->assertInstanceOf('lib\\core\\Config', 
				$this->object->getConfig());
	}

	/**
	 * Test for getting Log object
	 * @covers lib\core\Application::getLog
	 */
	public function testGetLog() {
		$this->assertInstanceOf('lib\\core\\Log', 
				$this->object->getLog());
	}

	/**
	 * Test for getting View Object
	 * @covers lib\core\Application::getView
	 */
	public function testGetView() {
		$this->assertInstanceOf('lib\\core\\View', 
				$this->object->getView());
	}

	/**
	 * Test for getting Reuqest Object
	 * @covers lib\core\Application::getRequest
	 */
	public function testGetRequest() {
		$this->assertInstanceOf('lib\\core\\Request', 
				$this->object->getRequest());
	}

	/**
	 * Test for getting Response Object
	 * @covers lib\core\Application::getResponse
	 */
	public function testGetResponse() {
		$this->assertInstanceOf('lib\\core\\Response', 
				$this->object->getResponse());
	}

	/**
	 * Test for getting Session Object
	 * @covers lib\core\Application::getSession
	 */
	public function testGetSession() {
		$this->assertInstanceOf('lib\\core\\Session', 
				$this->object->getSession());
	}
	
	/**
	 * Test run system.
	 * @covers lib\core\Application::run
	 */
	public function testRun() {
		ob_start();
		$this->object->run();
		ob_clean();
	}

	/**
	 * Test for getting Action
	 * @covers lib\core\Application::getAction
	 * @depends testRun
	 */
	public function testGetAction() {
		$this->assertNull($this->object->getAction());
	}
}
/* EOF */