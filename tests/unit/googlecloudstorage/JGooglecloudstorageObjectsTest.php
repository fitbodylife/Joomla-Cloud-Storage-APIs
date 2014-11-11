<?php
/**
 * @package     Joomla.UnitTest
 * @subpackage  Googlecloudstorage
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

require_once JPATH_PLATFORM . '/joomla/googlecloudstorage/objects.php';

/**
 * Test class for JGooglecloudstorageObjects.
 *
 * @package     Joomla.UnitTest
 * @subpackage  Googlecloudstorage
 *
 * @since       ??.?
 */
class JGooglecloudstorageObjectsTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var    JRegistry  Options for the Googlecloudstorage object.
	 * @since  ??.?
	 */
	protected $options;

	/**
	 * @var    JGooglecloudstorage  Object under test.
	 * @since  ??.?
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @access protected
	 *
	 * @return void
	 */
	protected function setUp()
	{
		parent::setUp();

		$this->options = new JRegistry;
		$this->object = new JGooglecloudstorage($this->options);
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 *
	 * @access protected
	 *
	 * @return void
	 */
	protected function tearDown()
	{
	}

	/**
	 * Tests the magic __get method - get
	 *
	 * @since  ??.?
	 *
	 * @return void
	 */
	public function test__GetGet()
	{
		$this->assertThat(
			$this->object->objects->get,
			$this->isInstanceOf('JGooglecloudstorageObjectsGet')
		);
	}

	/**
	 * Tests the magic __get method - put
	 *
	 * @since  ??.?
	 *
	 * @return void
	 */
	public function test__GetPut()
	{
		$this->assertThat(
			$this->object->objects->put,
			$this->isInstanceOf('JGooglecloudstorageObjectsPut')
		);
	}

	/**
	 * Tests the magic __get method - delete
	 *
	 * @since  ??.?
	 *
	 * @return void
	 */
	public function test__GetDelete()
	{
		$this->assertThat(
			$this->object->objects->delete,
			$this->isInstanceOf('JGooglecloudstorageObjectsDelete')
		);
	}

	/**
	 * Tests the magic __get method - head
	 *
	 * @since  ??.?
	 *
	 * @return void
	 */
	public function test__GetHead()
	{
		$this->assertThat(
			$this->object->objects->head,
			$this->isInstanceOf('JGooglecloudstorageObjectsHead')
		);
	}
}
