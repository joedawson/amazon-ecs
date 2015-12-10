<?php

namespace Dawson\AmazonECS;

use Illuminate\Support\Facades\Facade;

class AmazonECSFacade extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'amazon-ecs';
	}
}