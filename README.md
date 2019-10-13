# limanweb/validation-rules-extensions

## Additional rules list

Validation rules for international numbers and identifiers.

- **International identifiers**
  - bank_card_number,
  - isin

Validation rules for national person and company identifiers.

- **RUS** - Russian identifiers
  - rus_inn,
  - rus_person_inn,
  - rus_kpp,
  - rus_ogrn,
  - rus_ogrnip,
  - rus_snils
- **BLR** - Belarus identifiers 
  - blr_unp,
  - blr_person_unp
- **KAZ** - Kazakhstan identifiers 
  - kaz_iin,
  - kaz_bin

## Installing and configuring

### 1. Register provider 

Add provider class
```
Limanweb\ValidationRulesExt\Providers\ValidationRulesServiceProvider::class
``` 
into `providers` section of `config\app.php`.

### 2. Publish config and translations

Run command

```,bash
php artisan vendor:publish
```

and input number of line with `Limanweb\ValidationRulesExt\Providers\ValidationRulesServiceProvider`

### 3. Configurate validation rule's packages

Edit if you need `config/validation_rules_ext.php`.

By default all validation rule packages will by added. You can configure packages and rules that will be added into project.

For example:

```
return [
    'packages' => [
        // Only one rule of this package will be added into project
        \Limanweb\ValidationRulesExt\ValidationRules\RUS_IdentifierRules::class => [
            'rus_inn',  
        ],
        // All rules of this package will be added into project
        \Limanweb\ValidationRulesExt\ValidationRules\BLR_IdentifierRules::class => null,
    ],
];
```

## Using

Use additional rules like as standard laravel validation rules.

```
validator([
	'iin' => '760720302830'
], 
[
	'iin' => [
		'required', 
		'kaz_iin'
	]
])->validate();

```
