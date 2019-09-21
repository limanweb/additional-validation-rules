# limanweb/validation-rules-extensions

## Additional rules list

Packasges includes validation rules for national person and company identifiers.

- **RUS** - Russian identifiers
  - rus_inn,
  - rus_person_inn,
  - rus_ogrn,
  - rus_ogrnip,
  - rus_snils
- **BLR** - Belarus identifiers 
  - blr_unp,
  - blr_person_unp

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
php artisan vendor:publish --provider=Limanweb\ValidationRulesExt\Providers\ValidationRulesServiceProvider
```

### 3. Configurate validation rule's packages

Edit if you need `config/validation_rules_ext.php`.

By default all validation rule packages will by added.

## Using

...in work...
