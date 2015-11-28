<?php namespace Webunion\Config;

require_once( dirname(__DIR__) . DIRECTORY_SEPARATOR .'src'. DIRECTORY_SEPARATOR . 'Config.php');

use Webunion\Config\Config;

class ConfigTest extends \PHPUnit_Framework_TestCase
{
	public $fileXml;
	public $filePhp;
	
	public function setUp()
    {
		$this->fileXml = __DIR__ . DIRECTORY_SEPARATOR . 'config'. DIRECTORY_SEPARATOR .'config.xml';
		$this->filePhp = __DIR__ . DIRECTORY_SEPARATOR . 'config'. DIRECTORY_SEPARATOR .'config.php';
	
        if (!class_exists('Webunion\\Config\\ConfigTest')) {
            $this->markTestSkipped('ConfigTest was not installed.');
        }
    }

	public function testShouldReturnFooFromXML()
    {
		$config = new Config( $this->fileXml );
		$test = $config->get('app.test');

		$this->assertEquals( 'TEST', $test );
    }
	
	public function testShouldReturnArrayKeyTestFromXML()
    {
		$config = new Config( $this->fileXml );
		$test = $config->get('app');

		$this->assertArrayHasKey( 'test', $test );
    }
	
	public function testShouldReturnFooFromPHP()
    {
		$config = new Config( $this->filePhp );
		$test = $config->get('app');

		$this->assertArrayHasKey( 'test', $test );
		$this->assertEquals( 'TEST', $test['test'] );
    }
}