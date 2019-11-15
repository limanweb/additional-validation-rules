<?php

namespace Limanweb\ValidationRulesExt\Providers;

use Illuminate\Support\ServiceProvider;

class ValidationRulesServiceProvider extends ServiceProvider
{
    
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->publishes([
            __DIR__.'/../config/validation_rules_ext.php' => config_path('validation_rules_ext.php'),
        ]);
        
        $packages = config('validation_rules_ext.packages') ?? [];
        
        foreach ($packages as $key => $value) {
            if (is_string($key)) {
                app()->make($key, ['rules' => $value]);
            } else {
                app()->make($value);
            }
        }
        
    }
    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}