<?php
/* -------------------------------------------------------------------------------------------------
 * File:    AppBase/Debug.class.php
 * Version: 1.0
 * Desc:    A set of debugging methods. Can be called as a singleton, ex: Debug::instance()->dump()
 * -------------------------------------------------------------------------------------------------
*/
namespace ControlAltKaboom\AppBase;

class Debug {

  public $debugMode;
  public $style;
 
  public function __construct() {
    
    $this->setDebugMode(true);
    $this->setDebugStyle("background-color", "white")
         ->setDebugStyle("text-align", "left");
  }
  
  /**
    * Singleton method - required for all child singleton objects 
    * @return object - ControlAltKaboom\AppBase\CHILD_CLASS_NAME
  */    
   public static function instance() {
    
    static $instance;
    $className = __CLASS__;

    if( !($instance instanceof $className) ):
      $instance = new $className;
    endif;   
    return $instance;
  } // end.instance()

  /**
    * When debugMode is enabled, it dumps the data passed to it - Otherwise it exists quietly.
    * @param mixed $d 
    * @return string - print_r output of the input data
  */
  public function debug( $d ) {
    if( $this->getDebugMode() ) self::dump($d);
  } 
  
  /**
    * Performs a dump and terminates
    * @param mixed $d 
    * @return string - print_r output of the input data - terminates execution
  */
  public function _die( $d ) {
    $this->dump($d);die();
  } 
  
  /**
    * Performs a dump of the input data
    * @param mixed $d - the data to be dumped
    * @param mixed $strMode - if enabled, it wraps the output in a styled container.
    * @return string - print_r output of the input data in the strMode provided
  */
  public function dump($var, $strMode=false) { 
    
    $style = $this->getDebugStyle();  
    $str = "<div style='{$style}'><pre>" .print_r($var, true) . "</pre></div>";
    if($strMode == true) return $str;
    
    print $str;
      
  } 

 /**
    * Sets or Unsets a debug style setting
    * @param string $key - the valid css key to be set
    * @param string $style - the value being set. if null, it will clear the key.
    * @return object- $this - allows for chaining
  */
  public function setDebugStyle( $key, $style=NULL ) {
    
    // if the style is empty/null
    if ( empty($style) ): 
      unset($this->style[$key]);      // clear the setting
    else: 
      $this->style[$key] = rtrim($style, ";");  // otherwise set/overwrite it
    endif;
    // return self for chaining
    return $this;

  }

 /**
    * Gets the/a debug style setting
    * @param string $key - if passed, select only this key, otherwise return everything.
    * @param string $mode - determins the output type, either value, or raw ( array )
    * @return mixed $ret - when raw, it returns the array, otherwise its the inline-css string.
  */
  public function getDebugStyle( $key=false, $mode=false) {

    $ret = NULL;

    switch($mode):
      case "value": 
        $ret = ($key !== false && array_key_exists($key, $this->style))
          ? rtrim($this->style[$key], ";") . ";" 
          : "";     
        break;
      case "raw":
        $ret = ($key !== false && array_key_exists($key, $this->style))
          ? $this->style[$key]
          : $this->style;
        break;     
      case "string":
      default:
      
        if ( $key != false && array_key_exists($key, $this->style)):
          $ret = "{$key}:" . rtrim($this->style[$key], ";") . ";";
        else:
          print "NO KEY";
          foreach( $this->style AS $key => $v):
            print "k:{$key}";
            $ret .= "{$key}:" . rtrim($this->style[$key], ";") . ";";
          endforeach;          
        endif;
        break;
    endswitch;

    return $ret;
  
  } // end.getDebugStyle()

 /**
    * Sets the debugMode setting
    * @param boolean $set
    * @return object- $this - allows for chaining
  */
  public function setDebugMode( $set ) {
    $this->debugMode = $set;  
    return $this;
  } // end.setDebug()

 /**
    * Gets the debugMode setting
    * @return boolean - the current debugMode value
  */
  public function getDebugMode() {
    return $this->debugMode;
  } // end.getDebug()


        
  public function initLogger() {}
  public function log($msg, $data) {}
  public function getLog() {}
  public function chrome( $m, $d=false ) {
    #\ChromePhp\ChromePhp::log($m, $d);
  }




}