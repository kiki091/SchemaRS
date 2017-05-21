<?php namespace App\Providers;

	use Illuminate\Support\ServiceProvider;

	class ConfigServiceProvider extends ServiceProvider {
		public function register()
		{
			config([
				'laravellocalization.supportedLocales' => [
					'id' => array( 'name' => 'Indonesian', 'script' => 'Latn', 'native' => 'Bahasa Indonesia' ),
					'en'  => array( 'name' => 'English', 'script' => 'Latn', 'native' => 'English' ),
				],

				'laravellocalization.useAcceptLanguageHeader' => true,

				'laravellocalization.hideDefaultLocaleInURL' => true
			]);
		}

	}