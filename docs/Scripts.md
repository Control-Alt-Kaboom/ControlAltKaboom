# ControlAltKaboom - Scripts

The scripts included in this package are intended to run outside of the package scope, such as the backup script. It should be stated that this is a simple backup script, and while functional, is not intended for production/enterprise usage.

> With that said, there should be an understanding of liability and support - There is none.

## Backups

### AppBase\Inflector::underscoreFromHuman()
**Description:** *Generates an underscore-formatted string from human-format*  
**param1:** *string $phrase - a human-formatted string*  
**returns:** *string $phrase - an underscore-formatted string*  
```php
$phrase= "Converted From Human Format";
print $inflector->underscoreFromHuman( $phrase );
// prints "converted_from_human_format"
```

### AppBase\Inflector::underscoreFromHuman()
| Item | Type | Details |
|:-----|:-----|:--------|
|**Description**| *Generates an underscore-formatted string from human-format*|
|**param:**|*string*| *A human-formatted string*|  
|**return:**|*string*| *An underscore-formatted string*|
```php
$phrase= "Converted From Human Format";
print $inflector->underscoreFromHuman( $phrase );
// prints "converted_from_human_format"
```



