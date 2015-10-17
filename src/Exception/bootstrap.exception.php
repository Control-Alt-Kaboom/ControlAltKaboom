<?php
/* -------------------------------------------------------------------------------------------------
 * File:    ControlAltKaboom\Exception\bootstrap.exception.php
 * Version: 1.0
 * Desc:    sets up the custom error and exception handlers and output
 * -------------------------------------------------------------------------------------------------
*/

namespace ControlAltKaboom;
use ControlAltKaboom\Exception\CustomErrorException;
use ControlAltKaboom\Exception\CustomException;


/** 
  * Anonymous function used to throw a viewable exception when a fatal error is cought.
  * Note: Still doesn't catch a parse error. Likely a good thing.
*/  
$fatal_handler = function() {
  $errfile = "unknown file";
  $errstr  = "shutdown";
  $errno   = E_CORE_ERROR;
  $errline = 0;

  $error = error_get_last();
 
  //die("<pre>" . print_r($error,true) . "</pre>");
  # only throw on fatals 
  if( $error !== NULL && in_array($error['type'], array(1,64)) ) {
    throw new ErrorException($error['message'], 0, $error['type'], $error['file'], $error['line']);
  }
};

# Register the closure
register_shutdown_function( $fatal_handler );


# Set the error handler
set_error_handler(function ($err_severity, $err_msg, $err_file, $err_line, array $err_context)
{
    // error was suppressed with the @-operator
    if (0 === error_reporting()) { return false;}
    switch($err_severity)
    {
        case E_ERROR:               throw new ErrorException            ($err_msg, 0, $err_severity, $err_file, $err_line);
        #case E_WARNING:             throw new WarningException          ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_PARSE:               throw new ParseException            ($err_msg, 0, $err_severity, $err_file, $err_line);
        #case E_NOTICE:              throw new NoticeException           ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_CORE_ERROR:          throw new CoreErrorException        ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_CORE_WARNING:        throw new CoreWarningException      ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_COMPILE_ERROR:       throw new CompileErrorException     ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_COMPILE_WARNING:     throw new CoreWarningException      ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_USER_ERROR:          throw new UserErrorException        ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_USER_WARNING:        throw new UserWarningException      ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_USER_NOTICE:         throw new UserNoticeException       ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_STRICT:              throw new StrictException           ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_RECOVERABLE_ERROR:   throw new RecoverableErrorException ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_DEPRECATED:          throw new DeprecatedException       ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_USER_DEPRECATED:     throw new UserDeprecatedException   ($err_msg, 0, $err_severity, $err_file, $err_line);
    }
});


# Re-Map the existing errors to custom exceptions
class ErrorException                extends CustomErrorException {}
class WarningException              extends CustomErrorException {}
class ParseException                extends CustomErrorException {}
class NoticeException               extends CustomErrorException {}
class CoreErrorException            extends CustomErrorException {}
class CoreWarningException          extends CustomErrorException {}
class CompileErrorException         extends CustomErrorException {}
class CompileWarningException       extends CustomErrorException {}
class UserErrorException            extends CustomErrorException {}
class UserWarningException          extends CustomErrorException {}
class UserNoticeException           extends CustomErrorException {}
class StrictException               extends CustomErrorException {}
class RecoverableErrorException     extends CustomErrorException {}
class DeprecatedException           extends CustomErrorException {}
class UserDeprecatedException       extends CustomErrorException {}

# Register
set_exception_handler(function($e) {
  $e = new CustomException($e->getMessage() );
  echo $e->errorMessage();
});

