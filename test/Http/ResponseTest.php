<?php

namespace ASCII\Test\Http;

use ASCII\Http\Response;

class ResponseTest extends \PHPUnit\Framework\TestCase
{
	
	public function getResponse ()
	{
		return $this
		->getMockBuilder(Response::class)
		->getMock();
	}
	
	public function constructProvider()
	{
		return[
			["body", ""],
			["header", []],
			["status", 200],
			["reason", "OK"],
		];
	}
	
	/**
	 * @dataProvider constructProvider
	 */
	public function testConstruct ($propName, $value)
	{
		$class = new \ReflectionClass(Response::class);
		$prop = $class->getProperty($propName);
		$prop->setAccessible (true);
		$response = $class->newInstanceArgs([]);
		$this->assertTrue(
			$value === $prop->getValue($response)	
		);
		

	}
	
	public function statusProvider() {
		return [
			[null, null],
			[[], []],
			["hello", "world"],
				
				
				
		];
	}
	
	/**
	 * @dataProvider statusProvider
	 * @expectedException \TypeError
	 */
	public function testsetstatus($statut, $reason)
	{
		$this->getResponse()->setStatus($statut, $reason);	
	}

	
}