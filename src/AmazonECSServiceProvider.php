<?php

namespace Dawson\AmazonECS;

use Illuminate\Support\ServiceProvider;

class AmazonECSServiceProvider extends ServiceProvider
{
	/**
	* Perform post-registration booting of services.
	*
	* @return void
	*/
	public function boot()
	{
		$this->publishes([
			__DIR__.'/../config/amazon.php' => config_path('amazon.php'),
		], 'config');
	}
	
	/**
	* Register bindings in the container.
	*
	* @return void
	*/
	public function register()
	{
		$this->app->singleton(AmazonECS::class);
	}
}