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

** description: ** Returns the plural version of the word provided 
** param1: ** string (the word to be pluralized) 
** return: ** string (the pluralized word) 
```php
print $inflector->pluralize("document");
// prints "documents"
```

### AppBase\Inflector::singularize()
Returns the singular version of the word provided
```php
print $inflector->singularize("documents");
// prints "document"
```

### AppBase\Inflector::condition()
Returns the singular version of the word provided
```php
print $inflector->singularize("documents");
// prints "document"
```






