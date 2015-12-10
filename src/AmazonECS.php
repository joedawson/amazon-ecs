<?php

namespace Dawson\AmazonECS;

use InvalidArgumentException;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class AmazonECS
{
	use Helpers;

	/**
	 * Base API URL
	 * 
	 * @var string
	 */
	protected $baseUrl = 'webservices.amazon';

	/**
	 * Available Locales
	 * 
	 * @var array
	 */
	protected $locales = [
		'co.uk', 'com', 'ca', 'br', 'de', 'es', 'fr', 'in', 'it', 'co.jp', 'com.mx'
	];

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->validConfig();

		$this->access_key 		= config('amazon.access_key');
		$this->secret_key 		= config('amazon.secret_key');
		$this->associate_tag	= config('amazon.associate_tag');
		$this->locale			= config('amazon.locale');
		$this->client 			= new Client;
	}

	/**
	 * Amazon Product Advertisting API - ItemSearch
	 * 
	 * @param  string $query
	 * @return response
	 */
	public function search($query)
	{
		$params 	= $this->params(['Keywords' => $query, 'SearchIndex' => 'All', 'ResponseGroup' => 'Images,ItemAttributes']);
		$string 	= $this->buildString($params);
		$signature 	= $this->signString($string);
		$url 		= $this->url($params, $signature);

		try {
			return $this->client->request('GET', $url);
		} catch(ClientException $e) {
			return $e->getResponse();
		}
	}

	/**
	 * Amazon Product Advertisting API - ItemLookup
	 * 
	 * @param  string $id
	 * @return response
	 */
	public function lookup($id)
	{
		$params 	= $this->params(['ItemId' => $id], 'ItemLookup');
		$string 	= $this->buildString($params);
		$signature 	= $this->signString($string);
		$url 		= $this->url($params, $signature);

		try {
			return $this->client->request('GET', $url);
		} catch(ClientException $e) {
			return $e->getResponse();
		}
	}

	/**
	 * Determines if the configuration was valid.
	 * 
	 * @return InvalidException
	 */
	private function validConfig()
	{
		if(empty(config('amazon.access_key')) || empty(config('amazon.secret_key')))
		{
			throw new InvalidArgumentException('No Access Key or Secret Key has been set.');
		}

		if(!in_array(config('amazon.locale'), $this->locales))
		{
			throw new InvalidArgumentException(
				sprintf(
					'You have configured an invalid locale "%s". Possible locales are: %s',
					config('amazon.locale'),
					implode(', ', $this->locales)
				)
			);
		}
	}
}