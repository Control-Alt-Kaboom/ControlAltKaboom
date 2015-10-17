# AppBase - Inflector

A simple inflection class, used when you want singularize or pluralize english-language words. It can be instantiated or called as a static method. For the purpose of this document, examples will be given in the instantiated form.


## Usage

Simply instantiate the object and call as needed

```php
use ControlAltKaoom\AppBase\Inflector

$inflector = new Inflector();

print $inflector->pluralize("document");
// prints "documents"

print $inflector->singularize("documents");
// prints "document"

print $infletor->pluralize("woman");
// prints "women"

```

## Methods

The following methods are included as part of this class.

### AppBase\Inflector::pluralize()
**Description:** *Return the pluralized version of the singular english-language word provided.*  
**param:** *string $word - an english-language singularized word*  
**return:** *string $word- the pluralized version of the provided word*  
```php
$word = "document";
print $inflector->pluralize($word);
// prints "documents"
```

### AppBase\Inflector::singularize()
**Description:** *Return the singularized version of the plural english-language word provided.*  
**param:** *string $word - an english-language pluralized word*  
**return:** *string $word- the singularized version of the provided word*  
```php
$word = "documents";
print $inflector->singularize( $word );
// prints "document"
```

### AppBase\Inflector::condition()
**Description:** *Returns the singular or plural version of the word provided based on the condition passed.*  
**param:** *string $word - the word to be formatted*  
**param:** *integer $condition - when greater than 1, it will pluralize, else it will singularize*  
**return:** *string $word- the conditionally formatted word.*  
```php
$word = "document";
$condition = count( array("foo","bar") );
print $inflector->condition( $word, $condition);
// prints "documents"
```

### AppBase\Inflector::camelize()
**Description:** *Generates a camel-cased phrase from a human or underscore-formatted string.*  
**param:** *string $phrase - a human or underscore formatted string*  
**return:** *string $phrase - a camel-cased string*  
```php
$phrase= "converted to camel case";
print $inflector->camelize( $phrase );
// prints "ConvertedToCamelCase"

$phrase= "converted_to_camel_case";
print $inflector->camelize( $phrase );
// prints "ConvertedToCamelCase"
```

### AppBase\Inflector::humanize()
**Description:** *Generates a human-formatted phrase from a camel-cased or underscore-formatted string.*  
**param:** *string $phrase - a camel-cased or underscore formatted string*  
**return:** *string $phrase - a human-formatted string*  
```php
$phrase= "converted_to_human_format";
print $inflector->humanize( $phrase );
// prints "Converted To Human Format"

$phrase= "ConvertedToHumanFormat";
print $inflector->humanize( $phrase );
// prints "Converted To Human Format"
```

### AppBase\Inflector::underscoreFromHuman()
**Description:** *Generates an underscore-formatted phrase from a human-formatted string.*  
**param:** *string $phrase - a human-formatted string*  
**return:** *string $phrase - an underscore-formatted string*  
```php
$phrase= "Converted From Human Format";
print $inflector->underscoreFromHuman( $phrase );
// prints "converted_from_human_format"
```

### AppBase\Inflector::underscoreFromCamel()
**Description:** *Generates an underscore-formatted phrase from a camel-cased string.*  
**param:** *string $phrase - a camel-cased formatted string*  
**return:** *string $phrase - an underscore-formatted string*  
```php
$phrase= "ConvertedFromCamelCase";
print $inflector->underscoreFromCamel( $phrase );
// prints "converted_from_camel_case"
```





