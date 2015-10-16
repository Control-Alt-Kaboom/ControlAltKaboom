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
Returns the plural version of the word provided. Expects a string.
```php
$word = "document";
print $inflector->pluralize($word);
// prints "documents"
```

### AppBase\Inflector::singularize()
Returns the singular version of the word provided. Expects a string.
```php
$word = "documents";
print $inflector->singularize( $word );
// prints "document"
```

### AppBase\Inflector::condition()
Returns the singular or plural version of the word provided based on the condition passed. For example, if the condition evaluates to a number greater than one, then it will pluralize, otherwise it will singularize
```php
$word = "document";
$condition = count( array("foo","bar") );
print $inflector->condition( $word, $condition);
// prints "documents"
```

### AppBase\Inflector::camelize()
Returns a camel-cased string when passed a phrase with the words delimited by either spaces or underscores.
```php
$phrase= "converted to camel case";
print $inflector->camelize( $phrase );
// prints "ConvertedToCamelCase"

$phrase= "converted_to_camel_case";
print $inflector->camelize( $phrase );
// prints "ConvertedToCamelCase"
```

### AppBase\Inflector::humanize()
Returns a human-formatted string when passed a phrase that is undercored or camel-cased
```php
$phrase= "converted_to_human_format";
print $inflector->humanize( $phrase );
// prints "Converted To Human Format"

$phrase= "ConvertedToHumanFormat";
print $inflector->humanize( $phrase );
// prints "Converted To Human Format"
```

### AppBase\Inflector::underscoreFromHuman()
Returns an underscored string when passed a phrase that is in human-format
```php
$phrase= "Converted From Human Format";
print $inflector->underscoreFromHuman( $phrase );
// prints "converted_from_human_format"
```

### AppBase\Inflector::underscoreFromCamel()
Returns an camel-cased string when passed a phrase that is underscored
```php
$phrase= "ConvertedFromCamelCase";
print $inflector->underscoreFromCamel( $phrase );
// prints "converted_from_camel_case"
```





