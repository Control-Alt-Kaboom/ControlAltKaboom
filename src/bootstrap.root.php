<?php
# --------------------------------------------------------------------------------------------------
# File:  bootstrap.root.php
# Desc:  initializes and configures the ControlAltKaboom Package(s)
# --------------------------------------------------------------------------------------------------

namespace ControlAltKaboom;

/* 
  Importing Local Configuration Files
    
  This file lists all the required configuration and constant/variable definitions, but its 
  recommended that you use a local configuration file. At the very least, keep your authentication 
  info out of this file.
  
*/

include_once __DIR__."/../local.cfg/config.local.php";

# Define Packgage Constants
define(__NAMESPACE__."\DIR_PKG",     __DIR__);                # Package Root Path
define(__NAMESPACE__."\DIR_TESTS",   __DIR__."/../tests");    # Package Root Path
define(__NAMESPACE__."\DIR_VENDOR",  __DIR__."/../vendor");   # Vendor Root Path

# [Debugging]
define(__NAMESPACE__."\DEBUG_MODE",     true);

# [AutoLoader Configuration]

require_once constant(__NAMESPACE__."\DIR_VENDOR")."/autoload.php";

define(__NAMESPACE__."\CLASS_SUFFIX_LIST", serialize(array(
  "class", 
  "model", 
  "controller"
)));

# [Database Configuration]
if( !defined( __NAMESPACE__."\DB_HOST" ) ) define(__NAMESPACE__."\DB_HOST",   "DB_HOST_NAME");
if( !defined( __NAMESPACE__."\DB_USER" ) ) define(__NAMESPACE__."\DB_USER",   "DB_USERNAME");
if( !defined( __NAMESPACE__."\DB_PASS" ) ) define(__NAMESPACE__."\DB_PASS",   "DB_PASSWORD");
if( !defined( __NAMESPACE__."\DB_NAME" ) ) define(__NAMESPACE__."\DB_NAME",   "DB_NAME");
# [Session Configuration]
if( !defined( __NAMESPACE__."\DB_SESSION_HOST" ) ) define(__NAMESPACE__."\DB_SESSION_HOST",   "DB_SESSION_HOSTNAME");
if( !defined( __NAMESPACE__."\DB_SESSION_USER" ) ) define(__NAMESPACE__."\DB_SESSION_USER",   "DB_SESSION_USERNAME");
if( !defined( __NAMESPACE__."\DB_SESSION_PASS" ) ) define(__NAMESPACE__."\DB_SESSION_PASS",   "DB_SESSION_PASSWORD");
if( !defined( __NAMESPACE__."\DB_SESSION_NAME" ) ) define(__NAMESPACE__."\DB_SESSION_NAME",   "DB_SESSION_NAME");
if( !defined( __NAMESPACE__."\DB_SESSION_TABLE" ) ) define(__NAMESPACE__."\DB_SESSION_TABLE",  "DB_SESSION_TABLE");


# --------------------------------------------------------------------------------------------------
# Helper Methods ala Lambda
# --------------------------------------------------------------------------------------------------
$GLOBALS['c']     = function($c) { return (defined($c)) ? constant($c) : "";};
$GLOBALS['const'] = function($c) { return (defined($c)) ? constant($c) : "";};
$GLOBALS['disp']  = function($c) { return (trim($c) != '') ? trim($c) : "N/A";};
$GLOBALS['CUF']   = function($func, $arg=false) {return call_user_func($func, $arg);};
$GLOBALS['CUFA']  = function($func, $arg=false) {return call_user_func_array($func, $arg);};



# --------------------------------------------------------------------------------------------------
# Initialize Packages (via package bootstraps)
# --------------------------------------------------------------------------------------------------

// Exception and Error handling should be first, to allow for reporting of errors durring init(s).
require_once constant(__NAMESPACE__."\DIR_PKG")."/Exception/bootstrap.exception.php";





#include_once constant("\ControlAltKaboom\DIR_VENDOR")."/test.php";

# Initialize the packages by including each of their bootstraps




# 

