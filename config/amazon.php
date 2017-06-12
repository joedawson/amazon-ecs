<?php

return [

	/**
	 * Your access key.
	 */
	'access_key' => env('AMAZON_ACCESS_KEY', ''),

	/**
	 * Your secret key.
	 */
	'secret_key' => env('AMAZON_SECRET_KEY', ''),

	/**
	 * Your affiliate associate tag.
	 */
	'associate_tag' => env('AMAZON_ASSOCIATE_TAG', ''),

	/**
	 * Preferred locale
	 */
	'locale' => env('AMAZON_LOCALE', 'co.uk'),

	/**
	 * Preferred response group
	 */
	'response_group' => env('AMAZON_RESPONSE_GROUP', 'Images,ItemAttributes'),

        /**
         * Preferred search index
         */
	'search_index' => env('AMAZON_SEARCH_INDEX', 'All'),


];
