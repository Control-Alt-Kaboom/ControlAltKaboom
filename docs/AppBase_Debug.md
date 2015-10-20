# AppBase - Debug

A set of debugging methods used for displaying variable information. Can output to the screen, a log file, or through the chrome-debugger. It can be instantiated or called as a static method. For the purpose of this document, examples will be given in the instantiated form.

You can leave '::debug' commands in your code, and when the debugMode property is set to 'false', it will exit silently. You can also set any valid css to the debugStyle, so the output boxes render nicely for you.


## Usage

Simply instantiate the object or as a singleton and call as needed.

```php
use ControlAltKaoom\AppBase\Debug

// Object Mode
$debug = new Debug();

$testArray = array('foo' => 'bar');
$debug->dump( $testArray );
// shows 'print_r' output of $testArray

Debug::intance()->dump( $testArray );
// shows 'print_r' output of $testArray

```

## Methods

The following methods are included as part of this class.

### AppBase\Debug::instance( )
**Description:** *Singleton method - returns an instance of the Debug Object*    
**return:** *object $instance*  
```php

$debug = Debug::intance();
// returns a singleton Debug object intance
```

### AppBase\Debug::setDebugMode( $debugMode )
**Description:** *Sets the debug mode property. When disabled, calls to '::debug()' will exit silently*    
**param:** *boolean $debugMode*  
**return:** *object $instance - allows for chaining*  
```php
Debug::intance()->setDebugMode( true );
// enables debugMode
```

### AppBase\Debug::getDebugMode()
**Description:** *Gets the current debug mode property.*    
**return:** *booleab $debugMode*  
```php
Debug::instance()->setDebugMode( $mode );
print Debug::intance()->getDebugMode();
// prints (boolean) true
```

### AppBase\Debug::setDebugStyle( $key, [$value=NULL])
**Description:** *Sets a css style that is used when rendering a debug-box*    
**param:** *string $key - the css property to set*  
**param:** *string $value - the value of the property. When NULL, it clears the property.* 
**return:** *object $instance - allows for chaining*  
```php
Debug::intance()->setDebugStyle( "background-color", "white");
// sets the style to "background-color:white;"

Debug::intance()->setDebugStyle( "border", "1px solid black;");
// adds the style to "border:1px solid black;"
// would contain both background and border properties now

Debug::intance()->setDebugStyle( "border", NULL);
// removes the property "border"
// would contain only background properties now
```

### AppBase\Debug::getDebugStyle( [$key=NULL], [$mode='string'] )
**Description:** *Gets the css style in the supplied format. When a key is passed, it returns only that property*
**Modes:**  
* - 'string' (default) - returns the formatted css properties and values in inline format.*  
* - 'raw' - returns the raw data-storage ( array/string ).*  
* - 'value' - returns the value only.*  
**param:** *string $key - when passed, only return this property*  
**return:** *mixed result*  
```php
Debug::intance()->setDebugStyle( "background-color", "white");
Debug::intance()->setDebugStyle( "border", "1px solid black;");

Debug::intance()->getDebugStyle( );
// background-color:white;border:1px solid black;

Debug::intance()->getDebugStyle( "border" );
// border:1px solid black;

Debug::intance()->getDebugStyle( "border", "value" );
// 1px solid black;

Debug::intance()->getDebugStyle( null, "raw" );
// array("background-color" => "white", "border" => "1px solid black")

```

### AppBase\Debug::debug( (mixed)$var, [$strMode=false])
**Description:** *Generates debug output for the data passed. Can be called in string-mode ( which allows for storage as a string. If debugMode is not enabled, it will exit silently*    
**param:** *mixed $var - the variable to debug*  
**param:** *boolean $strMode - if 'true', format the result for string-storage* 
**return:** *string $output*  
```php

$testArray = array("foo" => "bar");

Debug::instance()->setDebugMode( true );
Debug::instance()->debug( $testArray );
// prints "<div style=''><pre>" .print_r($testArray). "</pre></div>"

Debug::instance()->setDebugMode( false );
Debug::instance()->debug( $testArray );
// exists silently

Debug::instance()->setDebugMode( true );
$ret = Debug::instance()->debug( $testArray, true );
print $ret;
// prints "<div style=''><pre>" .print_r($testArray). "</pre></div>"

```

### AppBase\Debug::dump( (mixed)$var, [$strMode=false])
**Description:** *Generates debug output for the data passed. Can be called in string-mode ( which allows for storage as a string*    
**param:** *mixed $var - the variable to debug*  
**param:** *boolean $strMode - if 'true', format the result for string-storage* 
**return:** *string $output*  
```php

$testArray = array("foo" => "bar");
Debug::instance()->dump( $testArray );
// shows 'print_r' output of $testArray

print Debug::instance()->dump( $testArray, true );
// string-formatted 'print_r' output of $testArray
```

### AppBase\Debug::_die( (mixed)$var, [$strMode=false])
**Description:** *Generates debug output for the data passed and then aborts script execution*    
**param:** *mixed $var - the variable to debug*  
```php

$testArray = array("foo" => "bar");
Debug::instance()->_die( $testArray );
// shows 'print_r' output of $testArray then aborts all script execution

```


## Testing

The current testts do not have complete coverage of the AppBase\Debug object. Some of the tests would require output-comparison, and the _die method aborts script execution. While code coverage is important, these are low-level functions that can be easily verified and tested without automation. I just couldn't justify spending the time generating these more complex tests for something so trivial and easily tested the old-school way.


There are tests, however, for the basic usage components, and they can be found [here](../../tests/AppBase/DebugTest.php)

