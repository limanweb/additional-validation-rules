<?php

namespace Limanweb\ValidationRulesExt\Providers;

use Illuminate\Support\ServiceProvider;

class ValidationRulesServiceProvider extends ServiceProvider
{
    
    protected $packages = [
        \Limanweb\ValidationRulesExt\ValidationRules\RUS_IdentifierRules::class,
        \Limanweb\ValidationRulesExt\ValidationRules\BLR_IdentifierRules::class,
    ];
    
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang/', 'validation-rules-ext');

        $this->publishes([
            __DIR__.'/../resources/lang/' => resource_path('lang/vendor/validation-rules-ext'),
            __DIR__.'/../config/validation_rules_ext.php' => config_path('validation_rules_ext.php'),
        ]);
        
        $packages = config('validation_rules_ext.packages') ?? [];
        
        foreach ($packages as $value) {
            app()->make($value);
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