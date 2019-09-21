# limanweb/validation-rules-extensions

## Additional rules list

- **RUS**
  - rus_inn,
  - rus_person_inn,
  - rus_ogrn,
  - rus_ogrnip,
  - rus_snils
- **BLR**  
  - blr_unp,
  - blr_person_unp

## Using

Add into `boot()` method of `AppServiceProvider` next lines

```,php
$this->app->make(\Limanweb\ValidationRulesExt\RUS\IdentifierRules::class);
$this->app->make(\Limanweb\ValidationRulesExt\BLR\IdentifierRules::class);
```        
Now you can use extended validation rules.
