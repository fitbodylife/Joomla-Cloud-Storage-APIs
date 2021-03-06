<?php
/**
 * @package     Joomla.Cloud
 * @subpackage  AmazonS3
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * Defines the DELETE operations on buckets
 *
 * @since  1.0
 */
class JAmazons3OperationsBucketsDelete extends JAmazons3OperationsBuckets
{
	/**
	 * Deletes the bucket named in the URI
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return  SimpleXMLElement|string  The response body
	 *
	 * @since   1.0
	 */
	public function deleteBucket($bucket)
	{
		$url = 'https://' . $bucket . '.' . $this->options->get('api.url') . '/';

		// Send the request and process the response
		return $this->commonDeleteOperations($url);
	}

	/**
	 * Deletes the cors configuration information set for the bucket.
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return  SimpleXMLElement|string  The response body
	 *
	 * @since   1.0
	 */
	public function deleteBucketCors($bucket)
	{
		$url = 'https://' . $bucket . '.' . $this->options->get('api.url') . '/?cors';

		// Send the request and process the response
		return $this->commonDeleteOperations($url);
	}

	/**
	 * Deletes the lifecycle configuration from the specified bucket
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return  SimpleXMLElement|string  The response body
	 *
	 * @since   1.0
	 */
	public function deleteBucketLifecycle($bucket)
	{
		$url = 'https://' . $bucket . '.' . $this->options->get('api.url') . '/?lifecycle';

		// Send the request and process the response
		return $this->commonDeleteOperations($url);
	}

	/**
	 * This implementation of the DELETE operation uses the policy subresource
	 * to delete the policy on a specified bucket.
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return  SimpleXMLElement|string  The response body
	 *
	 * @since   1.0
	 */
	public function deleteBucketPolicy($bucket)
	{
		$url = 'https://' . $bucket . '.' . $this->options->get('api.url') . '/?policy';

		// Send the request and process the response
		return $this->commonDeleteOperations($url);
	}

	/**
	 * This implementation of the DELETE operation uses the tagging
	 * subresource to remove a tag set from the specified bucket.
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return  SimpleXMLElement|string  The response body
	 *
	 * @since   1.0
	 */
	public function deleteBucketTagging($bucket)
	{
		$url = 'https://' . $bucket . '.' . $this->options->get('api.url') . '/?tagging';

		// Send the request and process the response
		return $this->commonDeleteOperations($url);
	}

	/**
	 * This operation removes the website configuration for a bucket.
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return  SimpleXMLElement|string  The response body
	 *
	 * @since   1.0
	 */
	public function deleteBucketWebsite($bucket)
	{
		$url = 'https://' . $bucket . '.' . $this->options->get('api.url') . '/?website';

		// Send the request and process the response
		return $this->commonDeleteOperations($url);
	}
}
