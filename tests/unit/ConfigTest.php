<?php namespace Webunion\Config;

use Webunion\Config\Config;

class ConfigTest extends \PHPUnit_Framework_TestCase
{
	public $fileXml = '../config/config.xml';
	public $filePhp = '../config/config.php';
	
	public function setUp()
    {
        if (!class_exists('Webunion\\ConfigTest')) {
            $this->markTestSkipped('ConfigTest was not installed.');
        }
    }

	public function testShouldReturnFooFromXML()
    {
		$config = new Config( $this->fileXml );
		$test = $config->get('app.test');

		$this->assertEquals( 'TEST', $test );
    }
	
	public function testShouldReturnFooFromPHP()
    {
		$config = new Config( $this->fileXml );
		$test = $config->get('app.test');

		$this->assertEquals( 'TEST', $test );
    }
}