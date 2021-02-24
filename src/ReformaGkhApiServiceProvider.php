<?php
namespace Serokuz\ReformaGkhApi;

use Illuminate\Support\ServiceProvider;

class ReformaGkhApiServiceProvider  extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../config/reforma-gkh.php';
        $this->publishes([
            $configPath => config_path('reforma-gkh.php'),
        ],
            'config'
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__ . '/../config/reforma-gkh.php';
        $this->mergeConfigFrom($configPath, 'reforma-gkh');
    }
}
