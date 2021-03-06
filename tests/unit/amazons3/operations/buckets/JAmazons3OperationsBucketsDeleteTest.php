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
 * Test class for JAmazons3OperationsBucketsDelete.
 *
 * @since  1.0
 */
class JAmazons3OperationsBucketsDeleteTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var  Registry  Options for the Amazons3 object.
	 */
	protected $options;

	/**
	 * @var  JAmazons3OperationsBuckets  Object under test.
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
		$this->options->set('testBucket', 'testBucket');

		$this->client = $this->getMock('JAmazons3Http', array('delete', 'get', 'head', 'put'));

		$this->object = new JAmazons3OperationsBuckets($this->options, $this->client);
	}

	/**
	 * Common test operations for methods which use DELETE requests
	 *
	 * @param   string  $subresource  The subresource that is used for creating the DELETE request.
	 *
	 * @return  SimpleXMLElement
	 */
	protected function commonDeleteTestOperations($subresource)
	{
		$url = "https://" . $this->options->get("testBucket") . "." . $this->options->get("api.url") . "/" . $subresource;
		$headers = array(
			"Date" => date("D, d M Y H:i:s O"),
		);
		$authorization = $this->object->createAuthorization("DELETE", $url, $headers);
		$headers['Authorization'] = $authorization;

		$returnData = new JHttpResponse;
		$returnData->code = 200;
		$returnData->body = "<test>response</test>";
		$expectedResult = new SimpleXMLElement($returnData->body);

		$this->client->expects($this->once())
			->method('delete')
			->with($url, $headers)
			->will($this->returnValue($returnData));

		return $expectedResult;
	}

	/**
	 * Tests the deleteBucket method
	 */
	public function testDeleteBucket()
	{
		$expectedResult = $this->commonDeleteTestOperations("");
		$this->assertThat(
			$this->object->delete->deleteBucket($this->options->get("testBucket")),
			$this->equalTo($expectedResult)
		);
	}

	/**
	 * Tests the deleteBucketCors method
	 */
	public function testDeleteBucketCors()
	{
		$expectedResult = $this->commonDeleteTestOperations("?cors");
		$this->assertThat(
			$this->object->delete->deleteBucketCors($this->options->get("testBucket")),
			$this->equalTo($expectedResult)
		);
	}

	/**
	 * Tests the deleteBucketLifecycle method
	 */
	public function testDeleteBucketLifecycle()
	{
		$expectedResult = $this->commonDeleteTestOperations("?lifecycle");
		$this->assertThat(
			$this->object->delete->deleteBucketLifecycle($this->options->get("testBucket")),
			$this->equalTo($expectedResult)
		);
	}

	/**
	 * Tests the deleteBucketPolicy method
	 */
	public function testDeleteBucketPolicy()
	{
		$expectedResult = $this->commonDeleteTestOperations("?policy");
		$this->assertThat(
			$this->object->delete->deleteBucketPolicy($this->options->get("testBucket")),
			$this->equalTo($expectedResult)
		);
	}

	/**
	 * Tests the deleteBucketTagging method
	 */
	public function testDeleteBucketTagging()
	{
		$expectedResult = $this->commonDeleteTestOperations("?tagging");
		$this->assertThat(
			$this->object->delete->deleteBucketTagging($this->options->get("testBucket")),
			$this->equalTo($expectedResult)
		);
	}

	/**
	 * Tests the deleteBucketWebsite method
	 */
	public function testDeleteBucketWebsite()
	{
		$expectedResult = $this->commonDeleteTestOperations("?website");
		$this->assertThat(
			$this->object->delete->deleteBucketWebsite($this->options->get("testBucket")),
			$this->equalTo($expectedResult)
		);
	}
}
