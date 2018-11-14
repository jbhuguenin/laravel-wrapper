<?php
/**
 * Created by PhpStorm.
 * User: jean-baptiste
 * Date: 28/06/2018
 * Time: 13:42
 */

namespace App\Classes\ApiWrapper;

use Illuminate\Support\ServiceProvider;

/**
 * Class ApiWrapperServiceProvider
 * @package App\Classes\ApiWrapper
 */
class ApiWrapperServiceProvider extends ServiceProvider
{

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		foreach($this->app['config']->get('apiwrapper') as $serviceName => $config) {

			$this->app->bindShared(sprintf('apiwrapper.%s', $serviceName), function($app) use($config)
			{
				return new ApiWrapper($config);
			});
		}
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}
}
