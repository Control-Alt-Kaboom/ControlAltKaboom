<?php
# --------------------------------------------------------------------------------------------------
# File: DebugTest.php
# Desc: PHPUNIT Test for the \ControlAltKaboom\AppBase\Debug class
# --------------------------------------------------------------------------------------------------

use ControlAltKaboom\AppBase\Debug;


class DebugTest extends PHPUnit_Framework_TestCase {

	protected $obj = NULL;
	
	protected function setUp() {

		$this->obj = new ControlAltKaboom\AppBase\Debug;

    // clear existing debug styles
    $this->obj->style = array();

	}


  /** 
    * provider for debugMode - generates debugMode data-sets
  */
  public function providerDebugmode() {
    return array(
      array(true, true),
      array(false,false)
    );
  }

  /**
    * @dataProvider providerDebugMode 
  */
  public function testCanSetDebugMode($setTo, $expects) {

    $this->obj->setDebugMode($setTo);
    $result = $this->obj->debugMode;
    $this->assertEquals($expects, $result);

  }


  /** 
    * provider for debugStyleValue - generates debugStyle value data-sets
    * param-1: key
    * param-2: value
    * param-3: expected result
  */
  public function providerDebugValues() {
    return array(
      array("background-color", "green", "green;"),
      array("background-color", "green;","green;"),
      array("background-color", "white", "white;"),
      array("text-align", "left", "left;"),
      array("font-size", "20px", "20px;"),
      array("background-color", "white", "white;"),
    );
  }


  /**
    * @dataProvider providerDebugValues
  */
  public function testCanSetDebugStyleValues($key, $value, $expects) {

    $this->obj->setDebugStyle($key, $value);
    $this->assertArrayHasKey( $key, $this->obj->style);

    $result = $this->obj->style[$key];
    $expects = trim($expects,";"); // the raw value should have been cleaned when set
    $this->assertEquals($expects, $result);

  }


  /**
    * @dataProvider providerDebugValues
  */
  public function testCanClearDebugStyleValues($key, $value, $expects) {

    $this->obj->setDebugStyle($key);
    $this->assertArrayNotHasKey( $key, $this->obj->style);

  }

  /**
    * @dataProvider providerDebugValues
  */
  public function testCanGetDebugStyleValues($key, $value, $expects) {

    $this->obj->setDebugStyle($key, $value);
    $this->assertArrayHasKey( $key, $this->obj->style);

    $result = $this->obj->getDebugStyle($key, "value");
    $this->assertEquals($expects, $result);

  }




  /** 
    * provider for debugStyleString - generates debugStyle string data-sets
    * param-1: key
    * param-2: value
    * param-3: expected result
  */
  public function providerDebugStrings() {
    return array(
      array("background-color", "green", "background-color:green;"),
      array("background-color", "green;","background-color:green;"),
      array("background-color", "white", "background-color:white;"),
      array("text-align", "left", "text-align:left;"),
    );
  }


  /**
    * @dataProvider providerDebugStrings
  */
  public function testCanGetDebugStyleStrings($key, $value, $expects) {

    $this->obj->setDebugStyle($key, $value);
 
    $result = ( $key == NULL)   
        ? $this->obj->getDebugStyle()
        : $this->obj->getDebugStyle($key, "string");
        
    $this->assertEquals($expects, $result);

  }


  /** 
    * provider for debugStyleStringMulti - generates debugStyle string mulit-data-sets
    * param-1: key
    * param-2: value
    * param-3: expected result
  */
  public function providerDebugStringMulti() {
    return array(
      array("background-color", "green", "text-align", "left;", "background-color:green;text-align:left;"),
      array("background-color", "green", "text-align", "left;", "background-color:green;text-align:left;"),
      array("background-color", "white", "text-align", "left;", "background-color:white;text-align:left;"),
      array(false, false, "text-align", "left;", "text-align:left;"),
      array("background-color", "white", "text-align", "left;", "background-color:white;text-align:left;"),
    );
  }


  /**
    * @dataProvider providerDebugStringMulti
  */
  public function testCanGetDebugStyleStringMulti($key1, $value1, $key2, $value2, $expects) {

    $this->obj->setDebugStyle($key1, $value1);
    $this->obj->setDebugStyle($key2, $value2);
 
    $result = $this->obj->getDebugStyle();
        
    $this->assertEquals($expects, $result);

  }

}