<?php
/**
 * @package     Joomla.UnitTest
 * @subpackage  Amazons3
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

use Joomla\Registry\Registry;

/**
 * Test class for JAmazons3OperationsServiceGet.
 *
 * @since  1.0
 */
class JAmazons3OperationsServiceGetTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var  Registry  Options for the Amazons3 object.
	 */
	protected $options;

	/**
	 * @var  JAmazons3OperationsService  Object under test.
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @return  void
	 */
	protected function setUp()
	{
		parent::setUp();

		$this->options = new Registry;
		$this->options->set('api.accessKeyId', 'testAccessKeyId');
		$this->options->set('api.secretAccessKey', 'testSecretAccessKey');
		$this->options->set('api.url', 's3.amazonaws.com');

		$this->client = $this->getMock('JAmazons3Http', array('get'));

		$this->object = new JAmazons3OperationsService($this->options, $this->client);
	}

	/**
	 * Tests the getService method
	 */
	public function testGetService()
	{
		$url = "https://" . $this->options->get("api.url") . "/";
		$headers = array(
			"Date" => date("D, d M Y H:i:s O"),
		);
		$authorization = $this->object->createAuthorization("GET", $url, $headers);
		$headers['Authorization'] = $authorization;

		$returnData = new JHttpResponse;
		$returnData->code = 200;
		$returnData->body = "<test>response</test>";
		$expectedResult = new SimpleXMLElement($returnData->body);

		$this->client->expects($this->once())
			->method('get')
			->with($url, $headers)
			->will($this->returnValue($returnData));

		$this->assertThat(
			$this->object->get->getService(),
			$this->equalTo($expectedResult)
		);
	}
}
