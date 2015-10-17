<?php
# --------------------------------------------------------------------------------------------------
# File: ExceptionExistsTest.php
# Desc: PHPUNIT Test for the \ControlAltKaboom\Exception classes
#   - simply tests if the custom exception classes exist at this time.
#   - really need to put some time into figuring out how to get better coverage with this.
# --------------------------------------------------------------------------------------------------


class ExceptionAndErrorTest extends PHPUnit_Framework_TestCase {

  /**
    * provider - an exception list 
  */
  public function providerExceptionList() {
    
    return array(
      array("ControlAltKaboom\Exception\CustomErrorException"),
      array("ControlAltKaboom\Exception\CustomException"),
    );      

  }

  /** 
    * @dataProvider providerExceptionList
  */
  public function testExceptionExists($testableException) {

    $expectedException = ltrim((string) $testableException, '\\');
    if ( !class_exists($expectedException) && !interface_exists($expectedException) ):
      $this->fail( sprintf('An exception of type "%s" does not exist.', $expectedException) );
    endif;

  }

}