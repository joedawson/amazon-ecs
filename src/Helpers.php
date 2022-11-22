<?php

namespace Dawson\AmazonECS;

trait Helpers {

	/**
	 * Generate the endpoint URL
	 *
	 * @return string
	 */
	function endpoint()
	{
		return $this->baseUrl . '.' . $this->locale;
	}

	/**
	 * Build the string, ready for signing.
	 *
	 * @param  string $params
	 * @param  string $prefix
	 * @return string
	 */
	function buildString($params, $prefix = 'GET')
	{
		return $prefix . "\n"
			 . $this->endpoint() . "\n"
			 . "/onca/xml\n"
			 . $params;
	}

	/**
	 * Return the signed URL.
	 *
	 * @param  string $params
	 * @param  string $signature
	 * @return string
	 */
	function url($params, $signature)
	{
		return 'http://' . $this->endpoint() . '/onca/xml?' . $params . '&Signature=' . $signature;
	}

	/**
	 * Build up the URL Params.
	 *
	 * @param  array  $optionalParams Optional paramters for the request.
	 * @param  string $operation      The operation.
	 * @return string                 Encoded string for signing.
	 */
	function params($optionalParams = [], $operation = 'ItemSearch')
	{
		$params = [
			'AWSAccessKeyId' => $this->access_key,
			'AssociateTag'	 => $this->associate_tag,
			'Operation'		 => $operation,
			'Version'		 => '2013-08-01',
			'Service'		 => 'AWSECommerceService',
			'Timestamp'		 => gmdate("Y-m-d\TH:i:s\Z")
		];

		$params = array_unique(array_merge($params, $optionalParams));
		$params = str_replace(',', '%2C', $params);
		$params = str_replace(':', '%3A', $params);

		ksort($params);

		return implode('&', array_map(function ($v, $k) { return $k . '=' . $v; }, $params, array_keys($params)));
	}

	/**
	 * Return the signature for the given string.
	 *
	 * @param  string $string
	 * @return string
	 */
	function signString($string)
	{
		return rawurlencode(base64_encode(hash_hmac('sha256', $string, $this->secret_key, true)));
	}
}