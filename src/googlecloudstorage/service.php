<?php
/**
 * @package     Joomla.Cloud
 * @subpackage  Googlecloudstorage
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * Common items for operations on the service
 *
 * @package     Joomla.Cloud
 * @subpackage  Googlecloudstorage
 * @since       1.0
 */
class JGooglecloudstorageService extends JGooglecloudstorageObject
{
	/**
	 * @var    JGooglecloudstorageServiceGet  Googlecloudstorage API object for
	 *                                        GET operations on the service.
	 * @since  1.0
	 */
	protected $get;

	/**
	 * Magic method to lazily create API objects
	 *
	 * @param   string  $name  Name of property to retrieve.
	 *
	 * @return  JGooglecloudstorageObject  Googlecloudstorage API object
	 *
	 * @since   1.0
	 * @throws  InvalidArgumentException
	 */
	public function __get($name)
	{
		$class = 'JGooglecloudstorageService' . ucfirst($name);

		if (class_exists($class))
		{
			if (false == isset($this->$name))
			{
				$this->$name = new $class($this->options, $this->client);
			}

			return $this->$name;
		}

		throw new InvalidArgumentException(
			sprintf('Argument %s produced an invalid class name: %s', $name, $class)
		);
	}
}
