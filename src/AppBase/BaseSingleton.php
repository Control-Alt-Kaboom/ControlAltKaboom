<?php
/* -------------------------------------------------------------------------------------------------
 * File:    AppBase/BaseSingleton.php
 * Version: 1.0
 * Desc:    Parent class extended by other singleton objects.
 * Notes:   Any child class requires the trait/ instance method defined as the following: 
 
  /**
    * Singleton method - required for all child singleton objects 
    * @return object - ControlAltKaboom\AppBase\CHILD_CLASS_NAME
  * /    
   public static function instance() {
    
    static $instance;
    $className = __CLASS__;

    if( !($instance instanceof $className) ):
      $instance = new $className;
    endif;   
    return $instance;
  } // end.instance()
 
 * -------------------------------------------------------------------------------------------------
*/

namespace ControlAltKaboom\AppBase;

class BaseSingleton {    

  /** 
    * var $config - array of config settings as set by the child class
  */
  public $config;

  /**
   * sets a config variable 
   * @param  string $key - should only be a string, multidimensional storage not enabled
   * @param  mixed  $val - if an array, children cannot be selected via key.
   * @return object $this - returns self, chainable
   */
  public function setConfig( $key, $val ) {
    $this->config[$key] = $val;
    return $this; 
  } // end.setConfig()
  
  /**
   * gets a config variable 
   * @param  mixed  $key - the storage-id/key
   * @return mixed  - the data matched by the key passed
   */
  public function getConfig( $key ) {
    return ( array_key_exists( $key, $this->config ) )
      ? $this->config[$key]
      : NULL;
      
  } // end.getConfig()


} // end BaseSingleton

