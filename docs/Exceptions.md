# ControlAltKaboom - Exceptions

This package includes a set of custom error and exception handlers, and is easily customized to include, exclude and display almost all error types. Currently only the E_PARSE error is not being caught.


## Process and Registration 

The basic process is to catch all errors, and forward to custom exceptions. This allows for individual customization of each of the error types if required.

The [bootstrap file](../src/Exception/bootstrap.exception.php) script registers the error and exception handlers through PHP's [set_error_handler](http://www.php.ca/set_error_handler), [set_exception_handler](http://www.php.ca/set_exception_handler) and [register_shutdown_function](http://www.php.ca/register_shutdown_function). The later allows for catching of fatal errors, and could be removed without effecting the other error and exception handling methods.


## Templating and Custom Reporting

All exception reports are passed to a simple [set of templates](../src/Exception/tpl) that can easily be customized to suit any requirements. If different output is required for different errors simply extend the [CustomErrorException](../src/Exception/CustomErrorException.php) class with a new class specific for the error type, and override the template-call in the _toString() method. Its not recommended that you update the base classes themselves, as they can likely change with package updates.


## Creating Custom exceptions

Custom Application-Specific exceptions can be easily created by just extending one of the base classes. A small library of generic custom-exceptions, such as MySQL, FileSystem, Socket and Framework - are available for use in the source directory. Some of these are already being used by other components of this package.


## Testing with PHPUnit 

Currently the Unit Tests for this component are limited to simple checking if the exception classes exist. While there could be some better/more-clever ways to test this, for the most part the critical components of the exception library lie within the registration of the handlers themselves, and they are primarily either modified by PHPUnit, or not able to be validated or reflected.


## To-Do

* The templates have a hard coded path in them, this should be adjusted to use a namespaced constant?







