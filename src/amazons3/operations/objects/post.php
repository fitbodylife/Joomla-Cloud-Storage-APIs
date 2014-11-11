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
 * Defines the POST operations on objects
 *
 * @since  1.0
 */
class JAmazons3OperationsObjectsPost extends JAmazons3OperationsObjects
{
	/**
	 * Deletes multiple objects from a bucket
	 *
	 * @param   string  $bucket     The bucket name
	 * @param   array   $objects    An array of objects to be deleted
	 * @param   array   $quiet      In quiet mode the response includes only keys
	 *                              where the delete operation encountered an error
	 * @param   string  $serialNr   The serial number is generated using either a hardware or
	 *                              a virtual MFA device. Required for MfaDelete
	 * @param   string  $tokenCode  Also required for MfaDelete
	 *
	 * @return  SimpleXMLElement|string  The response body
	 *
	 * @since   1.0
	 */
	public function deleteMultipleObjects($bucket, $objects, $quiet = false, $serialNr = null, $tokenCode = null)
	{
		$url = "https://" . $bucket . "." . $this->options->get("api.url") . "/?delete";
		$content = "";
		$headers = array(
			"Date" => date("D, d M Y H:i:s O"),
		);

		if (is_array($objects))
		{
			$content = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"
				. "<Delete>\n";

			if ($quiet)
			{
				$content .= "<Quiet>true</Quiet>\n";
			}

			foreach ($objects as $object)
			{
				$content .= "<Object>\n";

				foreach ($object as $key => $value)
				{
					$content .= "<" . $key . ">"
						. $value
						. "</" . $key . ">\n";
				}

				$content .= "</Object>\n";
			}

			$content .= "</Delete>";
		}

		if (! is_null($serialNr))
		{
			$headers["x-amz-mfa"] = $serialNr . " " . $tokenCode;
		}

		// Set the content related headers
		$headers["Content-type"] = "application/x-www-form-urlencoded; charset=utf-8";
		$headers["Content-Length"] = strlen($content);
		$headers["Content-MD5"] = base64_encode(md5($content, true));
		$authorization = $this->createAuthorization("POST", $url, $headers);
		$headers["Authorization"] = $authorization;
		unset($headers["Content-type"]);

		// Send the http request
		$response = $this->client->post($url, $content, $headers);

		// Process the response
		return $this->processResponse($response);
	}

	/**
	 * The POST operation adds an object to a specified bucket using HTML forms
	 *
	 * @param   string  $bucket  The bucket name
	 * @param   array   $fields  An array of objects to be deleted
	 *
	 * @return  SimpleXMLElement|string  The response body
	 *
	 * @since   1.0
	 */
	public function postObject($bucket, $fields)
	{
		$url = 'https://' . $bucket . '.' . $this->options->get('api.url') . '/';
		$content = '';
		$headers = array(
			'Date' => date('D, d M Y H:i:s O'),
		);

		if (is_array($fields))
		{
			$url .= $fields['key'];
			$content = $fields['file'];
		}

		// Set the content related headers
		$headers['Content-type'] = 'application/x-www-form-urlencoded; charset=utf-8';
		$headers['Content-Length'] = strlen($content);
		$authorization = $this->createAuthorization('POST', $url, $headers);
		$headers['Authorization'] = $authorization;
		unset($headers['Content-type']);

		// Send the http request
		$response = $this->client->post($url, $content, $headers);

		// Process the response
		return $this->processResponse($response);
	}

	/**
	 * Restores a temporary copy of an archived object. In the request, you
	 * specify the number of days that you want the restored copy to exist.
	 *
	 * @param   string  $bucket  The bucket name
	 * @param   string  $object  The name of the object to be restored
	 * @param   string  $days    The number of days that you want the restored copy to exist
	 *
	 * @return  SimpleXMLElement|string  The response body
	 *
	 * @since   1.0
	 */
	public function postObjectRestore($bucket, $object, $days)
	{
		$url = 'https://' . $bucket . '.' . $this->options->get('api.url') . '/'
			. $object . '?restore';

		$content = "<RestoreRequest xmlns=\"http://s3.amazonaws.com/doc/2006-3-01\">\n"
			. "<Days>" . $days . "</Days>\n"
			. "</RestoreRequest>\n";

		$headers = array(
			'Date' => date('D, d M Y H:i:s O'),
		);

		// Set the content related headers
		$headers['Content-type'] = 'application/x-www-form-urlencoded; charset=utf-8';
		$headers['Content-Length'] = strlen($content);
		$headers['Content-MD5'] = base64_encode(md5($content, true));
		$authorization = $this->createAuthorization('POST', $url, $headers);
		$headers['Authorization'] = $authorization;
		unset($headers['Content-type']);

		// Send the http request
		$response = $this->client->post($url, $content, $headers);

		// Process the response
		return $this->processResponse($response);
	}
}
