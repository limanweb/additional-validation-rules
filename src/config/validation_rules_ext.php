<?php 

return [
    'packages' => [
        /**
         * Define witch packages and rules will be added.
         * 
         * If value is NULL, then all rules of package will be added,
         * if value is array, then will be added rules listed in array
         */ 
        \Limanweb\ValidationRulesExt\ValidationRules\RUS_IdentifierRules::class => null,
        \Limanweb\ValidationRulesExt\ValidationRules\BLR_IdentifierRules::class => null,
        \Limanweb\ValidationRulesExt\ValidationRules\KAZ_IdentifierRules::class => null,
        \Limanweb\ValidationRulesExt\ValidationRules\InternationalIdentifierRules::class => null,
    ],
];