<?php
/* -------------------------------------------------------------------------------------------------
 * File:    ControlAltKaboom\Exception\CustomErrorException.php
 * Version: 1.0
 * Desc:    Default Custom Exception Handler for Internal Errors
 * -------------------------------------------------------------------------------------------------
*/

namespace ControlAltKaboom\Exception;

class CustomErrorException extends \ErrorException {


  function getParams() {
  
   // Prepare base params...
   $base = array(
     'file' => $this->getFile(),
     'line' => $this->getLine()
   ); // array
  
   // Get additional params...
   $additional = $this->getAdditionalParams();
  
   // And return (join if we have additional params)
   return is_array($additional) ? array_merge($base, $additional) : $base;
  
  } // getParams
  
  function getAdditionalParams() {
    return null;
  } // getAdditionalParams


  function __toString() {
    include "tpl/error.tpl.php";
    return NULL;
  } // _toString

  function errorMessage() {
    return $this->__toString();
  }

} #END.class

