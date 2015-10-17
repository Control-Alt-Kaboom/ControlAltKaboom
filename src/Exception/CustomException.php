<?php
/* -------------------------------------------------------------------------------------------------
 * File:    ControlAltKaboom\Exception\CustomException.php
 * Version: 1.0
 * Desc:    Default Custom Exception Handler
 * -------------------------------------------------------------------------------------------------
*/

namespace ControlAltKaboom\Exception;

class CustomException extends \Exception {


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



  function errorMessage() {
    include "tpl/error.tpl.php";

  }

} #END.class

