<?php 

namespace Limanweb\ValidationRulesExt;

use \Illuminate\Support\Str;

abstract class ValidationRulesExtensionPackage 
{
    protected $rules = [
        // List of rules
    ];
    
    /**
     * 
     */
    public function __construct()
    {
        $this->boot();
    }
    
    /**
     * 
     */
    protected function boot()
    {
        // Registering additional rules in \Validator 
        foreach ($this->rules as $rule) {
            $ruleFunction = Str::camel('validate_'.$rule);
            if (method_exists($this, $ruleFunction)) {
                \Validator::extend($rule, get_class($this).'::'.$ruleFunction);
            }
        }
    }
}