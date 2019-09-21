<?php 

namespace Limanweb\ValidationRulesExt\ValidationRules;

use \Illuminate\Support\Str;

abstract class ValidationRulesPackage 
{
    
    /**
     * List of packege validation rules
     * 
     * @var array
     */
    protected $rules = [
        //
    ];
    
    /**
     * 
     */
    public function __construct()
    {
        $this->boot();
    }
    
    /**
     * Boot package validation rules
     */
    protected function boot()
    {

        foreach ($this->rules as $ruleName) {

            // Boot rule
            $extend = Str::camel('validate_'.$ruleName);
            if (method_exists($this, $extend)) {
                
                \Validator::extend($ruleName, function (...$params) use ($extend) {
                    return get_class($this)::$extend(...$params);
                });
                
                // Boot rule replacer
                $replacer = Str::camel('replace_'.$ruleName);
                if (method_exists($this, $replacer)) {
                    
                    // Custom rule replacer
                    \Validator::replacer($ruleName, function (...$params) use ($replacer)  {
                        return get_class($this)::$replacer(...$params);
                    });
                    
                } else {
                    
                    // Default rule replacer
                    \Validator::replacer($ruleName, function ($message, $attribute, $rule, $parameters, $validator) {
                        return trans(
                            'validation-rules-ext::validation.'.$rule,
                             ['attribute' => $attribute]
                        );
                    });
                    
                }
            }
        }
    }
    
}